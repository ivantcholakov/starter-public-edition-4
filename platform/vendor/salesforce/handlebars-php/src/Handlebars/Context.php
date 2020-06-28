<?php
/**
 * Handlebars context
 * Context for a template
 *
 * @category  Xamin
 * @package   Handlebars
 * @author    fzerorubigd <fzerorubigd@gmail.com>
 * @author    Behrooz Shabani <everplays@gmail.com>
 * @author    Mardix <https://github.com/mardix>
 * @copyright 2012 (c) ParsPooyesh Co
 * @copyright 2013 (c) Behrooz Shabani
 * @copyright 2013 (c) Mardix
 * @license   MIT
 * @link      http://voodoophp.org/docs/handlebars
 */

namespace Handlebars;

use InvalidArgumentException;
use LogicException;

class Context
{
    const DATA_KEY = 'key';
    const DATA_INDEX = 'index';
    const DATA_FIRST = 'first';
    const DATA_LAST = 'last';

    /**
     * @var array stack for context only top stack is available
     */
    protected $stack = [];

    /**
     * @var array index stack for sections
     */
    protected $index = [];

    /**
     * @var array dataStack stack for data within sections
     */
    protected $dataStack = [];

    /**
     * @var array key stack for objects
     */
    protected $key = [];

    /**
     * @var bool enableDataVariables true if @data variables should be used.
     */
    protected $enableDataVariables = false;

    /**
     * Mustache rendering Context constructor.
     *
     * @param mixed $context Default rendering context (default: null)
     * @param array $options Options for the context. It may contain the following: (default: empty array)
     *                       enableDataVariables => Boolean, Enables @data variables (default: false)
     *
     * @throws InvalidArgumentException when calling this method when enableDataVariables is not a boolean.
     */
    public function __construct($context = null, $options = [])
    {
        if ($context !== null) {
            $this->stack = [$context];
        }

        if (isset($options[Handlebars::OPTION_ENABLE_DATA_VARIABLES])) {
            if (!is_bool($options[Handlebars::OPTION_ENABLE_DATA_VARIABLES])) {
                throw new InvalidArgumentException(
                    'Context Constructor "' . Handlebars::OPTION_ENABLE_DATA_VARIABLES . '" option must be a boolean'
                );
            }
            $this->enableDataVariables = $options[Handlebars::OPTION_ENABLE_DATA_VARIABLES];
        }
    }

    /**
     * Push a new Context frame onto the stack.
     *
     * @param mixed $value Object or array to use for context
     *
     * @return void
     */
    public function push($value)
    {
        array_push($this->stack, $value);
    }

    /**
     * Push an Index onto the index stack
     *
     * @param integer $index Index of the current section item.
     *
     * @return void
     */
    public function pushIndex($index)
    {
        array_push($this->index, $index);
    }

    /**
     * Pushes data variables onto the stack. This is used to support @data variables.
     * @param array $data Associative array where key is the name of the @data variable and value is the value.
     * @throws LogicException when calling this method without having enableDataVariables.
     */
    public function pushData($data)
    {
        if (!$this->enableDataVariables) {
            throw new LogicException('Data variables are not supported due to the enableDataVariables configuration. Remove the call to data variables or change the setting.');
        }
        array_push($this->dataStack, $data);
    }

    /**
     * Push a Key onto the key stack
     *
     * @param string $key Key of the current object property.
     *
     * @return void
     */
    public function pushKey($key)
    {
        array_push($this->key, $key);
    }

    /**
     * Pop the last Context frame from the stack.
     *
     * @return mixed Last Context frame (object or array)
     */
    public function pop()
    {
        return array_pop($this->stack);
    }

    /**
     * Pop the last index from the stack.
     *
     * @return int Last index
     */
    public function popIndex()
    {
        return array_pop($this->index);
    }

    /**
     * Pop the last section data from the stack.
     *
     * @return array Last data
     * @throws LogicException when calling this method without having enableDataVariables.
     */
    public function popData()
    {
        if (!$this->enableDataVariables) {
            throw new LogicException('Data variables are not supported due to the enableDataVariables configuration. Remove the call to data variables or change the setting.');
        }
        return array_pop($this->dataStack);
    }

    /**
     * Pop the last key from the stack.
     *
     * @return string Last key
     */
    public function popKey()
    {
        return array_pop($this->key);
    }

    /**
     * Get the last Context frame.
     *
     * @return mixed Last Context frame (object or array)
     */
    public function last()
    {
        return end($this->stack);
    }

    /**
     * Get the index of current section item.
     *
     * @return mixed Last index
     */
    public function lastIndex()
    {
        return end($this->index);
    }

    /**
     * Get the key of current object property.
     *
     * @return mixed Last key
     */
    public function lastKey()
    {
        return end($this->key);
    }

    /**
     * Change the current context to one of current context members
     *
     * @param string $variableName name of variable or a callable on current context
     *
     * @return mixed actual value
     */
    public function with($variableName)
    {
        $value = $this->get($variableName);
        $this->push($value);

        return $value;
    }

    /**
     * Get a avariable from current context
     * Supported types :
     * variable , ../variable , variable.variable , .
     *
     * @param string  $variableName variavle name to get from current context
     * @param boolean $strict       strict search? if not found then throw exception
     *
     * @throws InvalidArgumentException in strict mode and variable not found
     * @return mixed
     */
    public function get($variableName, $strict = false)
    {
        //Need to clean up
        $variableName = trim($variableName);

        //Handle data variables (@index, @first, @last, etc)
        if ($this->enableDataVariables && substr($variableName, 0, 1) == '@') {
            return $this->getDataVariable($variableName, $strict);
        }

        $level = 0;
        while (substr($variableName, 0, 3) == '../') {
            $variableName = trim(substr($variableName, 3));
            $level++;
        }
        if (count($this->stack) < $level) {
            if ($strict) {
                throw new InvalidArgumentException(
                    'can not find variable in context'
                );
            }

            return '';
        }
        end($this->stack);
        while ($level) {
            prev($this->stack);
            $level--;
        }
        $current = current($this->stack);
        if (!$variableName) {
            if ($strict) {
                throw new InvalidArgumentException(
                    'can not find variable in context'
                );
            }
            return '';
        } elseif ($variableName == '.' || $variableName == 'this') {
            return $current;
        } else {
            $chunks = explode('.', $variableName);
            foreach ($chunks as $chunk) {
                if (is_string($current) and $current == '') {
                    return $current;
                }
                $current = $this->findVariableInContext($current, $chunk, $strict);
            }
        }
        return $current;
    }

    /**
     * Given a data variable, retrieves the value associated.
     *
     * @param $variableName
     * @param bool $strict
     * @return mixed
     * @throws LogicException when calling this method without having enableDataVariables.
     */
    public function getDataVariable($variableName, $strict = false)
    {
        if (!$this->enableDataVariables) {
            throw new LogicException('Data variables are not supported due to the enableDataVariables configuration. Remove the call to data variables or change the setting.');
        }

        $variableName = trim($variableName);

        // make sure we get an at-symbol prefix
        if (substr($variableName, 0, 1) != '@') {
            if ($strict) {
                throw new InvalidArgumentException(
                    'Can not find variable in context'
                );
            }
            return '';
        }

        // Remove the at-symbol prefix
        $variableName = substr($variableName, 1);

        // determine the level of relative @data variables
        $level = 0;
        while (substr($variableName, 0, 3) == '../') {
            $variableName = trim(substr($variableName, 3));
            $level++;
        }

        // make sure the stack actually has the specified number of levels
        if (count($this->dataStack) < $level) {
            if ($strict) {
                throw new InvalidArgumentException(
                    'Can not find variable in context'
                );
            }

            return '';
        }

        // going from the top of the stack to the bottom, traverse the number of levels specified
        end($this->dataStack);
        while ($level) {
            prev($this->dataStack);
            $level--;
        }

        /** @var array $current */
        $current = current($this->dataStack);

        if (!array_key_exists($variableName, $current)) {
            if ($strict) {
                throw new InvalidArgumentException(
                    'Can not find variable in context'
                );
            }

            return '';
        }

        return $current[$variableName];
    }

    /**
     * Check if $variable->$inside is available
     *
     * @param mixed   $variable variable to check
     * @param string  $inside   property/method to check
     * @param boolean $strict   strict search? if not found then throw exception
     *
     * @throws \InvalidArgumentException in strict mode and variable not found
     * @return boolean true if exist
     */
    private function findVariableInContext($variable, $inside, $strict = false)
    {
        $value = '';
        if (($inside !== '0' && empty($inside)) || ($inside == 'this')) {
            return $variable;
        } elseif (is_array($variable)) {
            if (isset($variable[$inside])) {
                $value = $variable[$inside];
            }
        } elseif (is_object($variable)) {
            if (isset($variable->$inside)) {
                $value = $variable->$inside;
            } elseif (is_callable(array($variable, $inside))) {
                $value = call_user_func(array($variable, $inside));
            }
        } elseif ($inside === '.') {
            $value = $variable;
        } elseif ($strict) {
            throw new InvalidArgumentException('can not find variable in context');
        }
        return $value;
    }
}
