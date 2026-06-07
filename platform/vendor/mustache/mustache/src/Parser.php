<?php

/*
 * This file is part of Mustache.php.
 *
 * (c) 2010-2026 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mustache;

use Mustache\Exception\SyntaxException;

/**
 * Mustache Parser class.
 *
 * This class is responsible for turning a set of Mustache tokens into a parse tree.
 */
class Parser
{
    private $lineNum;
    private $lineTokens;
    private $pragmas;
    private $defaultPragmas = [];

    // Optional Mustache specs
    private $dynamicNames = true;
    private $inheritance = true;

    private $pragmaFilters;

    /**
     * Process an array of Mustache tokens and convert them into a parse tree.
     *
     * @param array $tokens Set of Mustache tokens
     *
     * @return array Mustache token parse tree
     */
    public function parse(array $tokens = [])
    {
        $this->lineNum    = -1;
        $this->lineTokens = 0;
        $this->pragmas    = $this->defaultPragmas;

        $this->pragmaFilters = isset($this->pragmas[Engine::PRAGMA_FILTERS]);

        return $this->buildTree($tokens);
    }

    /**
     * Disable optional Mustache specs.
     *
     * @internal Users should set options in Mustache\Engine, not here :)
     *
     * @param bool[] $options
     */
    public function setOptions(array $options)
    {
        if (isset($options['dynamic_names'])) {
            $this->dynamicNames = $options['dynamic_names'] !== false;
        }

        if (isset($options['inheritance'])) {
            $this->inheritance = $options['inheritance'] !== false;
        }
    }

    /**
     * Enable pragmas across all templates, regardless of the presence of pragma
     * tags in the individual templates.
     *
     * @internal Users should set global pragmas in Mustache\Engine, not here :)
     *
     * @param string[] $pragmas
     */
    public function setPragmas(array $pragmas)
    {
        $this->pragmas = [];
        foreach ($pragmas as $pragma) {
            $this->enablePragma($pragma);
        }
        $this->defaultPragmas = $this->pragmas;
    }

    /**
     * Helper method for recursively building a parse tree.
     *
     * @throws SyntaxException when nesting errors or mismatched section tags are encountered
     *
     * @param array &$tokens Set of Mustache tokens
     * @param array $parent  Parent token (default: null)
     *
     * @return array Mustache Token parse tree
     */
    private function buildTree(array &$tokens, $parent = null)
    {
        $nodes = [];

        while (!empty($tokens)) {
            $token = array_shift($tokens);

            if ($token[Tokenizer::LINE] === $this->lineNum) {
                $this->lineTokens++;
            } else {
                $this->lineNum    = $token[Tokenizer::LINE];
                $this->lineTokens = 0;
            }

            if ($token[Tokenizer::TYPE] !== Tokenizer::T_COMMENT) {
                if (isset($token[Tokenizer::NAME])) {
                    list($name, $isDynamic) = $this->getDynamicName($token);
                    if ($isDynamic) {
                        $token[Tokenizer::NAME]    = $name;
                        $token[Tokenizer::DYNAMIC] = true;
                    }
                }

                if ($this->pragmaFilters && isset($token[Tokenizer::NAME])) {
                    list($name, $filters) = $this->getNameAndFilters($token[Tokenizer::NAME]);
                    if (!empty($filters)) {
                        $token[Tokenizer::NAME]    = $name;
                        $token[Tokenizer::FILTERS] = $filters;
                    }
                }
            }

            switch ($token[Tokenizer::TYPE]) {
                case Tokenizer::T_DELIM_CHANGE:
                    $this->checkIfTokenIsAllowedInParent($parent, $token);
                    $this->clearStandaloneLines($nodes, $tokens);
                    break;

                case Tokenizer::T_SECTION:
                case Tokenizer::T_INVERTED:
                    $this->checkIfTokenIsAllowedInParent($parent, $token);
                    $this->clearStandaloneLines($nodes, $tokens);
                    $nodes[] = $this->buildTree($tokens, $token);
                    break;

                case Tokenizer::T_END_SECTION:
                    if (!isset($parent)) {
                        $msg = sprintf(
                            'Unexpected closing tag: /%s on line %d',
                            $token[Tokenizer::NAME],
                            $token[Tokenizer::LINE]
                        );
                        throw new SyntaxException($msg, $token);
                    }

                    $sameName = $token[Tokenizer::NAME] !== $parent[Tokenizer::NAME];
                    $tokenDynamic = isset($token[Tokenizer::DYNAMIC]) && $token[Tokenizer::DYNAMIC];
                    $parentDynamic = isset($parent[Tokenizer::DYNAMIC]) && $parent[Tokenizer::DYNAMIC];

                    if ($sameName || ($tokenDynamic !== $parentDynamic)) {
                        $msg = sprintf(
                            'Nesting error: %s%s (on line %d) vs. %s%s (on line %d)',
                            $parentDynamic ? '*' : '',
                            $parent[Tokenizer::NAME],
                            $parent[Tokenizer::LINE],
                            $tokenDynamic ? '*' : '',
                            $token[Tokenizer::NAME],
                            $token[Tokenizer::LINE]
                        );
                        throw new SyntaxException($msg, $token);
                    }

                    $this->clearStandaloneLines($nodes, $tokens);
                    $parent[Tokenizer::END]   = $token[Tokenizer::INDEX];
                    $parent[Tokenizer::NODES] = $nodes;

                    return $parent;

                case Tokenizer::T_PARTIAL:
                    $this->checkIfTokenIsAllowedInParent($parent, $token);
                    //store the whitespace prefix for laters!
                    if (($indent = $this->clearStandaloneLines($nodes, $tokens)) !== null) {
                        $token[Tokenizer::INDENT] = $indent[Tokenizer::VALUE];
                    }
                    $nodes[] = $token;
                    break;

                case Tokenizer::T_PARENT:
                    $this->checkIfTokenIsAllowedInParent($parent, $token);
                    $standaloneCandidate = false;
                    if (($indent = $this->clearStandaloneEmptySectionLines($nodes, $tokens, $token)) === null) {
                        $indent = $this->clearStandaloneLines($nodes, $tokens);
                    }
                    if ($indent !== null) {
                        $token[Tokenizer::INDENT] = $indent[Tokenizer::VALUE];
                        $token[Tokenizer::STANDALONE] = true;
                    } elseif ($this->sectionStartsLine($nodes)) {
                        $standaloneCandidate = true;
                    }
                    $node = $this->buildTree($tokens, $token);
                    if (isset($node[Tokenizer::STANDALONE]) || ($standaloneCandidate && $this->parentHasStandaloneBody($node))) {
                        $this->clearStandaloneSectionClose($tokens, $node);
                    }
                    $nodes[] = $node;
                    break;

                case Tokenizer::T_BLOCK_VAR:
                    if ($this->inheritance) {
                        if (isset($parent) && $parent[Tokenizer::TYPE] === Tokenizer::T_PARENT) {
                            $token[Tokenizer::TYPE] = Tokenizer::T_BLOCK_ARG;
                        }
                        if (($indent = $this->clearStandaloneEmptySectionLines($nodes, $tokens, $token)) === null) {
                            $indent = $this->clearStandaloneLines($nodes, $tokens);
                        }
                        if ($indent !== null) {
                            $token[Tokenizer::INDENT] = $indent[Tokenizer::VALUE];
                            $token[Tokenizer::STANDALONE] = true;
                        }
                        $nodes[] = $this->buildTree($tokens, $token);
                    } else {
                        // pretend this was just a normal "escaped" token...
                        $token[Tokenizer::TYPE] = Tokenizer::T_ESCAPED;
                        // TODO: figure out how to figure out if there was a space after this dollar:
                        $token[Tokenizer::NAME] = '$' . $token[Tokenizer::NAME];
                        $nodes[] = $token;
                    }
                    break;

                case Tokenizer::T_PRAGMA:
                    $this->enablePragma($token[Tokenizer::NAME]);
                    // no break

                case Tokenizer::T_COMMENT:
                    $this->clearStandaloneLines($nodes, $tokens);
                    $nodes[] = $token;
                    break;

                default:
                    $nodes[] = $token;
                    break;
            }
        }

        if (isset($parent)) {
            $msg = sprintf(
                'Missing closing tag: %s opened on line %d',
                $parent[Tokenizer::NAME],
                $parent[Tokenizer::LINE]
            );
            throw new SyntaxException($msg, $parent);
        }

        return $nodes;
    }

    /**
     * Clear standalone line tokens.
     *
     * Returns a whitespace token for indenting partials, if applicable.
     *
     * @param array $nodes  Parsed nodes
     * @param array $tokens Tokens to be parsed
     *
     * @return array|null Resulting indent token, if any
     */
    private function clearStandaloneLines(array &$nodes, array &$tokens)
    {
        if ($this->lineTokens > 1) {
            // this is the third or later node on this line, so it can't be standalone
            return;
        }

        $prev = null;
        if ($this->lineTokens === 1) {
            // this is the second node on this line, so it can't be standalone
            // unless the previous node is whitespace.
            if ($prev = end($nodes)) {
                if (!$this->tokenIsWhitespace($prev)) {
                    return;
                }
            }
        }

        if ($next = reset($tokens)) {
            // If we're on a new line, bail.
            if ($next[Tokenizer::LINE] !== $this->lineNum) {
                return;
            }

            // If the next token isn't whitespace, bail.
            if (!$this->tokenIsWhitespace($next)) {
                return;
            }

            if (count($tokens) !== 1) {
                // Unless it's the last token in the template, the next token
                // must end in newline for this to be standalone.
                if (substr($next[Tokenizer::VALUE], -1) !== "\n") {
                    return;
                }
            }

            // Discard the whitespace suffix
            array_shift($tokens);
        }

        if ($prev) {
            // Return the whitespace prefix, if any
            return array_pop($nodes);
        }

        return $this->emptyIndentToken();
    }

    /**
     * Clear standalone wrapper lines when an empty section closes on the same line.
     *
     * This handles tags like `{{<parent}}{{/parent}}` and `{{$block}}{{/block}}`,
     * which are standalone as a pair even though the opening tag is not followed
     * immediately by whitespace.
     *
     * @param array $nodes  Parsed nodes
     * @param array $tokens Tokens to be parsed
     * @param array $token  Opening token
     *
     * @return array|null Resulting indent token, if any
     */
    private function clearStandaloneEmptySectionLines(array &$nodes, array &$tokens, array $token)
    {
        if ($this->lineTokens > 1 || !$this->sectionStartsLine($nodes)) {
            return;
        }

        if (count($tokens) < 2) {
            return;
        }

        $end = $tokens[0];
        $next = $tokens[1];

        if (!$this->tokenClosesSection($token, $end) || $next[Tokenizer::LINE] !== $this->lineNum || !$this->tokenIsWhitespace($next)) {
            return;
        }

        if (count($tokens) !== 2 && substr($next[Tokenizer::VALUE], -1) !== "\n") {
            return;
        }

        if ($token[Tokenizer::TYPE] === Tokenizer::T_PARENT) {
            array_splice($tokens, 1, 1);
        }

        return $this->clearStandalonePrefix($nodes);
    }

    /**
     * Clear a standalone section's closing line suffix.
     *
     * @param array $tokens Tokens to be parsed
     * @param array $token  Section token
     */
    private function clearStandaloneSectionClose(array &$tokens, array $token)
    {
        if (empty($tokens) || !isset($token[Tokenizer::END])) {
            return;
        }

        $next = $tokens[0];
        if ($next[Tokenizer::LINE] !== $this->lineNum || !$this->tokenIsWhitespace($next)) {
            return;
        }

        if (count($tokens) !== 1 && substr($next[Tokenizer::VALUE], -1) !== "\n") {
            return;
        }

        array_shift($tokens);
    }

    /**
     * Check whether the current section begins a standalone line.
     *
     * @param array $nodes Parsed nodes
     *
     * @return bool True if the current section starts a standalone line
     */
    private function sectionStartsLine(array $nodes)
    {
        if ($this->lineTokens === 0) {
            return true;
        }

        if ($this->lineTokens !== 1) {
            return false;
        }

        $prev = end($nodes);

        return $prev && $this->tokenIsWhitespace($prev);
    }

    /**
     * Clear a standalone section's leading whitespace.
     *
     * @param array $nodes Parsed nodes
     *
     * @return array Resulting indent token
     */
    private function clearStandalonePrefix(array &$nodes)
    {
        if ($this->lineTokens === 1) {
            return array_pop($nodes);
        }

        return $this->emptyIndentToken();
    }

    /**
     * Check whether a parent tag body can be treated as standalone.
     *
     * Parent bodies may contain ignored text, but ignored inline content should
     * not make the parent consume the line after its closing tag.
     *
     * @param array $node Parent node
     *
     * @return bool True if the parent body only contains standalone block args
     */
    private function parentHasStandaloneBody(array $node)
    {
        foreach ($node[Tokenizer::NODES] as $child) {
            if ($child[Tokenizer::TYPE] === Tokenizer::T_TEXT) {
                if (!$this->tokenIsWhitespace($child)) {
                    return false;
                }

                continue;
            }

            if ($child[Tokenizer::TYPE] !== Tokenizer::T_BLOCK_ARG || !isset($child[Tokenizer::STANDALONE])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Build an empty indent token for the current line.
     *
     * @return array Empty whitespace token
     */
    private function emptyIndentToken()
    {
        return [
            Tokenizer::TYPE  => Tokenizer::T_TEXT,
            Tokenizer::LINE  => $this->lineNum,
            Tokenizer::VALUE => '',
        ];
    }

    /**
     * Check whether a token closes the given section token.
     *
     * @param array $open Opening token
     * @param array $end  Potential closing token
     *
     * @return bool True if $end closes $open
     */
    private function tokenClosesSection(array $open, array $end)
    {
        if ($end[Tokenizer::TYPE] !== Tokenizer::T_END_SECTION || $end[Tokenizer::LINE] !== $this->lineNum) {
            return false;
        }

        $sameName = $end[Tokenizer::NAME] === $open[Tokenizer::NAME];
        $endDynamic = isset($end[Tokenizer::DYNAMIC]) && $end[Tokenizer::DYNAMIC];
        $openDynamic = isset($open[Tokenizer::DYNAMIC]) && $open[Tokenizer::DYNAMIC];

        return $sameName && $endDynamic === $openDynamic;
    }

    /**
     * Check whether token is a whitespace token.
     *
     * True if token type is T_TEXT and value is all whitespace characters.
     *
     * @return bool True if token is a whitespace token
     */
    private function tokenIsWhitespace(array $token)
    {
        if ($token[Tokenizer::TYPE] === Tokenizer::T_TEXT) {
            return preg_match('/^\s*$/', $token[Tokenizer::VALUE]);
        }

        return false;
    }

    /**
     * Check whether a token is allowed inside a parent tag.
     *
     * @throws SyntaxException if an invalid token is found inside a parent tag
     *
     * @param array|null $parent
     */
    private function checkIfTokenIsAllowedInParent($parent, array $token)
    {
        if (isset($parent) && $parent[Tokenizer::TYPE] === Tokenizer::T_PARENT) {
            throw new SyntaxException('Illegal content in < parent tag', $token);
        }
    }

    /**
     * Parse dynamic names.
     *
     * @throws SyntaxException when a tag does not allow *
     * @throws SyntaxException on multiple *s, or dots or filters with *
     */
    private function getDynamicName(array $token)
    {
        $name = $token[Tokenizer::NAME];
        $isDynamic = false;

        if ($this->dynamicNames && preg_match('/^\s*\*\s*/', $name)) {
            $this->ensureTagAllowsDynamicNames($token);
            $name = preg_replace('/^\s*\*\s*/', '', $name);
            $isDynamic = true;
        }

        return [$name, $isDynamic];
    }

    /**
     * Check whether the given token supports dynamic tag names.
     *
     * @throws SyntaxException when a tag does not allow *
     */
    private function ensureTagAllowsDynamicNames(array $token)
    {
        switch ($token[Tokenizer::TYPE]) {
            case Tokenizer::T_PARTIAL:
            case Tokenizer::T_PARENT:
            case Tokenizer::T_END_SECTION:
                return;
        }

        $msg = sprintf(
            'Invalid dynamic name: %s in %s tag',
            $token[Tokenizer::NAME],
            Tokenizer::getTagName($token[Tokenizer::TYPE])
        );

        throw new SyntaxException($msg, $token);
    }

    /**
     * Split a tag name into name and filters.
     *
     * @param string $name
     *
     * @return array [Tag name, Array of filters]
     */
    private function getNameAndFilters($name)
    {
        $filters = array_map('trim', explode('|', $name));
        $name    = array_shift($filters);

        return [$name, $filters];
    }

    /**
     * Enable a pragma.
     *
     * @param string $name
     */
    private function enablePragma($name)
    {
        $this->pragmas[$name] = true;

        switch ($name) {
            case Engine::PRAGMA_FILTERS:
                $this->pragmaFilters = true;
                break;
        }
    }
}
