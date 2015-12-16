<?php

/**
 * The old API of the Lex Template Parser.
 *
 * Adapted by:
 * @author     Ivan Tcholakov
 * @license    MIT License
 * @copyright  2015 Ivan Tcholakov
 *
 * Based on:
 * @author     Dan Horrigan
 * @license    MIT License
 * @copyright  2011 Dan Horrigan
 */

class LexParsingException extends Exception { }

class Lex_Parser extends Lex\Parser
{
    /**
     * The main Lex parser method. Essentially acts as dispatcher to
     * all of the helper parser methods.
     *
     * @param   string        $text      Text to parse
     * @param   array|object  $data      Array or object to use
     * @param   mixed         $callback  Callback to use for Callback Tags
     * @return  string
     */
    public function parse($text, $data = array(), $callback = false, $allow_php = false) {

        return parent::parse($text, $data, $callback, $allow_php);
    }

    /**
     * Removes all of the comments from the text.
     *
     * @param   string  $text  Text to remove comments from
     * @return  string
     */
    public function parse_comments($text) {

        return $this->parseComments($text);
    }

    /**
     * Recursivly parses all of the variables in the given text and
     * returns the parsed text.
     *
     * @param   string        $text  Text to parse
     * @param   array|object  $data  Array or object to use
     * @return  string
     */
    public function parse_variables($text, $data, $callback = null) {

        return $this->parseVariables($text, $data, $callback);
    }

    /**
     * Parses all Callback tags, and sends them through the given $callback.
     *
     * @param   string  $text            Text to parse
     * @param   mixed   $callback        Callback to apply to each tag
     * ??? @param   bool    $in_conditional  Whether we are in a conditional tag
     * @return  string
     */
    public function parse_callback_tags($text, $data, $callback) {

        return $this->parseCallbackTags($text, $data, $callback);
    }

    /**
     * Parses all conditionals, then executes the conditionals.
     *
     * @param   string  $text      Text to parse
     * @param   mixed   $data      Data to use when executing conditionals
     * @param   mixed   $callback  The callback to be used for tags
     * @return  string
     */
    public function parse_conditionals($text, $data, $callback) {

        return $this->parseConditionals($text, $data, $callback);
    }

    /**
     * Goes recursively through a callback tag with a passed child array.
     *
     * @param string  $text - The replaced text after a callback.
     * @param string  $orig_text - The original text, before a callback is called.
     * @param mixed   $callback
     * @return string $text
     */
    public function parse_recursives($text, $orig_text, $callback) {

        return $this->parseRecursives($text, $orig_text, $callback);
    }

    /**
     * Gets or sets the Scope Glue
     *
     * @param   string|null  $glue  The Scope Glue
     * @return  string
     */
    public function scope_glue($glue = null) {

        return $this->scopeGlue($glue);
    }

    /**
     * Sets the noparse style. Immediate or cumulative.
     *
     * @param   bool $mode
     * @return  void
     */
    public function cumulative_noparse($mode) {

        return $this->cumulativeNoparse($mode);
    }

    /**
     * Injects noparse extractions.
     *
     * This is so that multiple parses can store noparse
     * extractions and all noparse can then be injected right
     * before data is displayed.
     *
     * @param   string    $text    Text to inject into
     * @return  string
     */
    public static function inject_noparse($text) {

        return parent::injectNoparse($text);
    }

    /**
     * This is used as a callback for the conditional parser.  It takes a variable
     * and returns the value of it, properly formatted.
     *
     * @param   array  $match  A match from preg_replace_callback
     * @return  string
     */
    protected function process_condition_var($match) {

        return $this->processConditionVar($match);
    }

    /**
     * This is used as a callback for the conditional parser.  It takes a variable
     * and returns the value of it, properly formatted.
     *
     * @param   array  $match  A match from preg_replace_callback
     * @return  string
     */
    protected function process_param_var($match) {

        return $this->processParamVar($match);
    }

    /**
     * Takes a value and returns the literal value for it for use in a tag.
     *
     * @param   string  $value  Value to convert
     * @return  string
     */
    protected function value_to_literal($value) {

        return $this->valueToLiteral($value);
    }

    /**
     * Sets up all the global regex to use the correct Scope Glue.
     *
     * @return  void
     */
    protected function setup_regex() {

        return $this->setupRegex();
    }

    /**
     * Extracts the noparse text so that it is not parsed.
     *
     * @param   string  $text  The text to extract from
     * @return  string
     */
    protected function extract_noparse($text) {

        return $this->extractNoparse($text);
    }

    /**
     * Extracts the looped tags so that we can parse conditionals then re-inject.
     *
     * @param   string  $text  The text to extract from
     * @return  string
     */
    protected function extract_looped_tags($text, $data = array(), $callback = null) {

        return $this->extractLoopedTags($text, $data, $callback);
    }

    /**
     * Extracts text out of the given text and replaces it with a hash which
     * can be used to inject the extractions replacement later.
     *
     * @param   string  $type         Type of extraction
     * @param   string  $extraction   The text to extract
     * @param   string  $replacement  Text that will replace the extraction when re-injected
     * @param   string  $text         Text to extract out of
     * @return  string
     */
    protected function create_extraction($type, $extraction, $replacement, $text) {

        return $this->createExtraction($type, $extraction, $replacement, $text);
    }

    /**
     * Injects all of the extractions.
     *
     * @param   string  $text  Text to inject into
     * @return  string
     */
    protected function inject_extractions($text, $type = null) {

        return $this->injectExtractions($text, $type);
    }

    /**
     * Takes a dot-notated key and finds the value for it in the given
     * array or object.
     *
     * @param   string        $key  Dot-notated key to find
     * @param   array|object  $data  Array or object to search
     * @param   mixed         $default  Default value to use if not found
     * @return  mixed
     */
    protected function get_variable($key, $data, $default = null) {

        return $this->getVariable($key, $data, $default);
    }

    /**
     * Evaluates the PHP in the given string.
     *
     * @param   string  $text  Text to evaluate
     * @return  string
     */
    protected function parse_php($text) {

        try {
            return $this->parsePhp($text);
        }
        catch (Exception $e) {
            throw new LexParsingException($e->getMessage());
        }
    }

    /**
     * Parses a parameter string into an array
     *
     * @param    string    The string of parameters
     * @return    array
     */
    protected function parse_parameters($parameters, $data, $callback) {

        return $this->parseParameters($parameters, $data, $callback);
    }

}
