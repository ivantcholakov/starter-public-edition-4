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

use Mustache\Exception\InvalidArgumentException;
use Mustache\Exception\UnknownVariableException;

/**
 * Mustache Template rendering Context.
 */
class Context
{
    private $strictTags       = Engine::STRICT_NONE;
    private $stack            = [];
    private $stackSize        = 0;
    private $blockScopes      = [[]];
    private $blockScopeIndex  = 0;
    private $renderingStack   = [];
    private $renderingStackSize = 0;
    private static $publicMethods = [];

    private $buggyPropertyShadowing = false;

    /**
     * Mustache rendering Context constructor.
     *
     * @param mixed $context                Default rendering context (default: null)
     * @param bool  $buggyPropertyShadowing See Engine::getBuggyPropertyShadowing (default: false)
     * @param int   $strictTags             Strict tag bitmask (default: Engine::STRICT_NONE)
     */
    public function __construct($context = null, $buggyPropertyShadowing = false, $strictTags = Engine::STRICT_NONE)
    {
        if ($context !== null) {
            $this->stack = [$context];
            $this->stackSize = 1;
        }

        $this->buggyPropertyShadowing = $buggyPropertyShadowing;
        $this->strictTags = $strictTags;
    }

    /**
     * Push a new Context frame onto the stack.
     *
     * @param mixed $value Object or array to use for context
     */
    public function push($value)
    {
        $this->stack[$this->stackSize++] = $value;
    }

    /**
     * Push a new Context frame onto the block context stack.
     *
     * @param mixed $value Object or array to use for block context
     */
    public function pushBlockContext($value)
    {
        $this->blockScopes[$this->blockScopeIndex][] = $value;
    }

    /**
     * Pop the last Context frame from the stack.
     *
     * @return mixed Last Context frame (object or array)
     */
    public function pop()
    {
        if ($this->stackSize === 0) {
            return null;
        }

        $index = --$this->stackSize;
        $value = $this->stack[$index];
        unset($this->stack[$index]);

        return $value;
    }

    /**
     * Pop the last block Context frame from the stack.
     *
     * @return mixed Last block Context frame (object or array)
     */
    public function popBlockContext()
    {
        return array_pop($this->blockScopes[$this->blockScopeIndex]);
    }

    /**
     * Push a rendering debug frame onto the stack.
     *
     * This is used by debug-compiled templates to preserve the current Mustache
     * tag context if rendering fails.
     */
    public function pushRenderingFrame(array $frame)
    {
        $this->renderingStack[$this->renderingStackSize++] = $frame;
    }

    /**
     * Pop the last rendering debug frame from the stack.
     */
    public function popRenderingFrame()
    {
        if ($this->renderingStackSize === 0) {
            return null;
        }

        $index = --$this->renderingStackSize;
        $value = $this->renderingStack[$index];
        unset($this->renderingStack[$index]);

        return $value;
    }

    /**
     * Get the current rendering debug stack.
     *
     * @return array
     */
    public function getRenderingStack()
    {
        return $this->renderingStack;
    }

    /**
     * Clear the rendering debug stack.
     */
    public function clearRenderingStack()
    {
        $this->renderingStack = [];
        $this->renderingStackSize = 0;
    }

    /**
     * Get the last Context frame.
     *
     * @return mixed Last Context frame (object or array)
     */
    public function last()
    {
        return $this->stackSize === 0 ? false : $this->stack[$this->stackSize - 1];
    }

    /**
     * Find a variable in the Context stack.
     *
     * Starting with the last Context frame (the context of the innermost section), and working back to the top-level
     * rendering context, look for a variable with the given name:
     *
     *  * If the Context frame is an associative array which contains the key $id, returns the value of that element.
     *  * If the Context frame is an object, this will check first for a public method, then a public property named
     *    $id. Failing both of these, it will try `__isset` and `__get` magic methods.
     *  * If a value named $id is not found in any Context frame, returns an empty string (or throws an
     *    UnknownVariableException if the relevant strict tag is enabled).
     *
     * @param string $id        Variable name
     * @param int    $strictTag Strict tag responsible for this lookup (default: Engine::STRICT_INTERPOLATION)
     *
     * @return mixed Variable value, or '' if not found
     *
     * @throws UnknownVariableException if the relevant strict tag is enabled and the variable is not found
     */
    public function find($id, $strictTag = Engine::STRICT_INTERPOLATION)
    {
        return $this->findVariableInStack($id, $this->stack, $this->stackSize, $strictTag);
    }

    /**
     * Find a 'dot notation' variable in the Context stack.
     *
     * Note that dot notation traversal bubbles through scope differently than the regular find method. After finding
     * the initial chunk of the dotted name, each subsequent chunk is searched for only within the value of the previous
     * result. For example, given the following context stack:
     *
     *     $data = [
     *         'name' => 'Fred',
     *         'child' => [
     *             'name' => 'Bob'
     *         ],
     *     ];
     *
     * ... and the Mustache following template:
     *
     *     {{ child.name }}
     *
     * ... the `name` value is only searched for within the `child` value of the global Context, not within parent
     * Context frames.
     *
     * @param string $id              Dotted variable selector
     * @param bool   $strictCallables (default: false)
     * @param int    $strictTag       Strict tag responsible for this lookup (default: Engine::STRICT_INTERPOLATION)
     *
     * @return mixed Variable value, or '' if not found
     *
     * @throws UnknownVariableException if the relevant strict tag is enabled and the variable is not found
     */
    public function findDot($id, $strictCallables = false, $strictTag = Engine::STRICT_INTERPOLATION)
    {
        $chunks = explode('.', $id);
        $chunkCount = count($chunks);
        $value = $this->findVariableInStack($chunks[0], $this->stack, $this->stackSize, $strictTag);

        // This wasn't really a dotted name, so we can just return the value.
        if ($chunkCount === 1) {
            return $value;
        }

        for ($i = 1; $i < $chunkCount; $i++) {
            $isCallable = $strictCallables ? (is_object($value) && is_callable($value)) : (!is_string($value) && is_callable($value));

            if ($isCallable) {
                $value = $value();
            } elseif ($value === '') {
                return $value;
            }

            $value = $this->findVariableInStack($chunks[$i], [$value], 1, $strictTag);
        }

        return $value;
    }

    /**
     * Find an 'anchored dot notation' variable in the Context stack.
     *
     * This is the same as findDot(), except it looks in the top of the context
     * stack for the first value, rather than searching the whole context stack
     * and starting from there.
     *
     * @see Mustache\Context::findDot
     *
     * @throws InvalidArgumentException if given an invalid anchored dot $id
     *
     * @param string $id              Dotted variable selector
     * @param bool   $strictCallables (default: false)
     * @param int    $strictTag       Strict tag responsible for this lookup (default: Engine::STRICT_INTERPOLATION)
     *
     * @return mixed Variable value, or '' if not found
     *
     * @throws UnknownVariableException if the relevant strict tag is enabled and the variable is not found
     */
    public function findAnchoredDot($id, $strictCallables = false, $strictTag = Engine::STRICT_INTERPOLATION)
    {
        $chunks = explode('.', $id);
        if ($chunks[0] !== '') {
            throw new InvalidArgumentException(sprintf('Unexpected id for findAnchoredDot: %s', $id));
        }

        $value = $this->last();
        $chunkCount = count($chunks);

        for ($i = 1; $i < $chunkCount; $i++) {
            if ($value === '') {
                return $value;
            }

            $value = $this->findVariableInStack($chunks[$i], [$value], 1, $strictTag);
        }

        return $value;
    }

    /**
     * Find an argument in the block context stack.
     *
     * @param string $id
     *
     * @return mixed Variable value, or '' if not found
     */
    public function findInBlock($id)
    {
        foreach ($this->blockScopes[$this->blockScopeIndex] as $context) {
            if (array_key_exists($id, $context)) {
                return $context[$id];
            }
        }

        return '';
    }

    /**
     * Get the block override names visible in the current block context scope,
     * keyed by name for cheap lookup.
     *
     * @return bool[]
     */
    public function getBlockContextNames()
    {
        $names = [];
        foreach ($this->blockScopes[$this->blockScopeIndex] as $context) {
            foreach ($context as $id => $value) {
                $names[$id] = true;
            }
        }

        return $names;
    }

    /**
     * Start an isolated block context scope.
     *
     * Block lookups inside a nested parent partial should not resolve against
     * block contexts pushed by the surrounding block argument.
     */
    public function pushBlockContextScope()
    {
        $this->blockScopes[++$this->blockScopeIndex] = [];
    }

    /**
     * End the current isolated block context scope, restoring visibility into
     * the surrounding block context scope.
     */
    public function popBlockContextScope()
    {
        // The root scope is always kept; popping it would leave findInBlock
        // with no scope to read.
        if ($this->blockScopeIndex === 0) {
            return;
        }

        unset($this->blockScopes[$this->blockScopeIndex]);
        $this->blockScopeIndex--;
    }

    /**
     * Helper function to find a variable in the Context stack.
     *
     * @see Mustache\Context::find
     *
     * @param string $id        Variable name
     * @param array  $stack     Context stack
     * @param int    $stackSize Number of frames in $stack
     * @param int    $strictTag Strict tag responsible for this lookup
     *
     * @return mixed Variable value, or '' if not found
     *
     * @throws UnknownVariableException if the relevant strict tag is enabled and the variable is not found
     */
    private function findVariableInStack($id, array $stack, $stackSize, $strictTag)
    {
        for ($i = $stackSize - 1; $i >= 0; $i--) {
            $frame = $stack[$i];

            if (is_array($frame)) {
                if (array_key_exists($id, $frame)) {
                    return $frame[$id];
                }

                continue;
            }

            if (!is_object($frame) || $frame instanceof \Closure) {
                continue;
            }

            if ($this->hasPublicMethod($frame, $id)) {
                return $frame->$id();
            }

            if (isset($frame->$id)) {
                return $frame->$id;
            }

            // Preserve backwards compatibility with a property shadowing bug in
            // Mustache.php <= 2.14.2
            // See https://github.com/bobthecow/mustache.php/pull/410
            if ($this->buggyPropertyShadowing) {
                if ($frame instanceof \ArrayAccess && isset($frame[$id])) {
                    return $frame[$id];
                }
            } else {
                if (property_exists($frame, $id)) {
                    $rp = new \ReflectionProperty($frame, $id);
                    if ($rp->isPublic()) {
                        return $frame->$id;
                    }
                }

                if ($frame instanceof \ArrayAccess && $frame->offsetExists($id)) {
                    return $frame[$id];
                }
            }
        }

        if (($this->strictTags & $strictTag) !== 0) {
            throw new UnknownVariableException($id);
        }

        return '';
    }

    /**
     * Check whether an object exposes a named public method.
     *
     * This intentionally uses get_class_methods() rather than is_callable() so
     * magic __call handlers do not change Mustache lookup semantics.
     *
     * @see https://github.com/bobthecow/mustache.php/wiki/Magic-Methods
     *
     * @param object $object
     * @param string $method
     *
     * @return bool
     */
    private function hasPublicMethod($object, $method)
    {
        $class = get_class($object);

        if (!isset(self::$publicMethods[$class])) {
            self::$publicMethods[$class] = array_fill_keys(array_map('strtolower', get_class_methods($object)), true);
        }

        return isset(self::$publicMethods[$class][strtolower($method)]);
    }
}
