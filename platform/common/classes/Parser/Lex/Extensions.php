<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extensions extends Lex\Parser {

    public static $parser_config;

    public $parser_options = array();
    public $parser_data = null;
    public $parser_callback_data = array();
    public $is_attribute_being_parsed = false;

    protected $ci;

    public $variableRegex = '';

    public function __construct() {

        $this->ci = & get_instance();

        if (!is_array(self::$parser_config)) {

            if ($this->ci->config->load('parser_lex', TRUE, TRUE)) {

                self::$parser_config = $this->ci->config->item('parser_lex');

                if (!is_array(self::$parser_config)) {
                    self::$parser_config = array();
                }

            } else {

                self::$parser_config = array();
            }
        }

        $this->parser_options['scope_glue'] = $this->scopeGlue;
        $this->parser_options['cumulative_noparse'] = $this->cumulativeNoparse;
        $this->parser_options['allow_php'] = false;
    }

    /**
     * A callback to be used by Lex template parser for parsing the so called "callback tags".
     *
     * @param string        $name           The name of the callback tag (it would be "template.partial" for example).
     * @param array         $attributes     An associative array of the attributes set.
     * @param string        $content        If it the tag is a block tag, it will be the content contained, otherwise a blank string
     * @return string|null                  Returns a string, which will replace the tag in the content.
     *
     * @link https://github.com/pyrocms/lex
     */
    public function parser_callback($name, $attributes, $content) {

        $data = false;

        $scope_glue = $this->parser_options['scope_glue'];

        if (strpos($name, $scope_glue) === false) {

            return $data;
        }

        list($class, $method) = explode($scope_glue, $name);

        $class = strtolower($class);
        $class_name = 'Parser_Lex_Extension_'.implode('_', array_map('ucfirst', explode('_', $class)));
        $path = null;

        if (class_exists($class_name, true)) {

            $extension = new $class_name;

            if (@ !is_a($extension, 'Parser_Lex_Extension')) {

                log_message('error', 'Class '.$class_name.' has not been derived from Parser_Lex_Extension class.');

                return $data;
            }

            $path = $extension->get_file_path();

            $extension->set_parser_instance($this);
            $extension->set_extension_path($path);
            $extension->set_extension_class($class);
            $extension->set_extension_method($method);
            $extension->set_extension_data($content, $attributes);

            if (
                    $class == 'helper'
                    &&
                    (
                        $method == 'empty'
                        ||
                        $method == 'isset'
                        ||
                        $method == 'var'
                        ||
                        $method == 'array'
                        ||
                        $method == 'null'
                    )
            ) {
                $method = '_func_'.$method;
            }

            if (!is_callable(array($extension, $method))) {

                //if (property_exists($extension, $method)) {
                //
                //    // Indicate that a property under the given name exists.
                //    return true;
                //}

                log_message('error', 'Method '.$method.'() does not exist on the class "'.$class_name.'".');

                return $data;
            }

            $data = call_user_func(array($extension, $method));

        } else {

            log_message('error', 'Class '.$class_name.' does not exist.');

            return $data;
        }

        if (is_array($data) && $data) {

        }

        return $data;
    }

    protected function is_multi_array($array) {

        return (count($array) != count($array, 1));
    }

    protected function make_multi_array($array, $i = 0) {

        $result = array();

        foreach ($array as $key => $value) {

            if (is_object($value)) {
                $result[$key] = (array) $value;
            } else {
                $result[$i][$key] = $value;
            }
        }

        return $result;
    }

    public function serialize($value) {

        return base64_encode(serialize($value));
    }

    public function is_serialized($value, & $result = null) {

        if (($value = base64_decode($value)) !== false) {
            return is_serialized($value, $result);
        }

        return false;
    }

    //--------------------------------------------------------------------------
    // Overriden Methods
    //--------------------------------------------------------------------------

    /**
     * The main Lex parser method.  Essentially acts as dispatcher to
     * all of the helper parser methods.
     *
     * @param  string       $text     Text to parse
     * @param  array|object $data     Array or object to use
     * @param  mixed        $callback Callback to use for Callback Tags
     * @return string
     */
    public function parse($text, $data = array(), $callback = false, $allowPhp = false)
    {

        $this->setupRegex();
        $this->allowPhp = $allowPhp;

        // Only convert objects to arrays
        if (is_object($data)) {
            $data = $this->toArray($data);
        }

        // Is this the first time parse() is called?
        if ($this->parser_data === null) {
            // Let's store the local data array for later use.
            $this->parser_data = $data;
        } else {
            // Let's merge the current data array with the local scope variables
            // So you can call local variables from within blocks.
            $data = array_merge($this->parser_data, $data);

            // Since this is not the first time parse() is called, it's most definately a callback,
            // let's store the current callback data with the the local data
            // so we can use it straight after a callback is called.
            $this->parser_callback_data = $data;
        }

        // The parseConditionals method executes any PHP in the text, so clean it up.
        if (! $allowPhp) {
            $text = str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $text);
        }

        $text = $this->parseComments($text);
        $text = $this->extractNoparse($text);
        $text = $this->extractLoopedTags($text, $data, $callback);

        // Order is important here.  We parse conditionals first as to avoid
        // unnecessary code from being parsed and executed.
        $text = $this->parseConditionals($text, $data, $callback);
        $text = $this->injectExtractions($text, 'looped_tags');
        $text = $this->parseVariables($text, $data, $callback);
        $text = $this->injectExtractions($text, 'callback_blocks');

        if ($callback) {
            $text = $this->parseCallbackTags($text, $data, $callback);
        }

        // To ensure that {{ noparse }} is never parsed even during consecutive parse calls
        // set $cumulativeNoparse to true and use self::injectNoparse($text); immediately
        // before the final output is sent to the browser
        if (! $this->cumulativeNoparse) {
            $text = $this->injectExtractions($text);
        }

        return $text;
    }

    /**
     * Recursivly parses all of the variables in the given text and
     * returns the parsed text.
     *
     * @param  string       $text Text to parse
     * @param  array|object $data Array or object to use
     * @return string
     */
    public function parseVariables($text, $data, $callback = null)
    {
        $this->setupRegex();

        /**
         * $data_matches[][0][0] is the raw data loop tag
         * $data_matches[][0][1] is the offset of raw data loop tag
         * $data_matches[][1][0] is the data variable (dot notated)
         * $data_matches[][1][1] is the offset of data variable
         * $data_matches[][2][0] is the content to be looped over
         * $data_matches[][2][1] is the offset of content to be looped over
         */
        if (preg_match_all($this->variableLoopRegex, $text, $data_matches, PREG_SET_ORDER + PREG_OFFSET_CAPTURE)) {
            foreach ($data_matches as $index => $match) {
                if ($loop_data = $this->getVariable($match[1][0], $data)) {
                    $looped_text = '';
                    if (is_array($loop_data) or ($loop_data instanceof \IteratorAggregate)) {
                        foreach ($loop_data as $item_data) {
                            $str = $this->extractLoopedTags($match[2][0], $item_data, $callback);
                            $str = $this->parseConditionals($str, $item_data, $callback);
                            $str = $this->injectExtractions($str, 'looped_tags');
                            $str = $this->parseVariables($str, $item_data, $callback);
                            if ($callback !== null) {
                                $str = $this->parseCallbackTags($str, $item_data, $callback);
                            }

                            $looped_text .= $str;
                        }
                    }
                    $text = preg_replace('/'.preg_quote($match[0][0], '/').'/m', addcslashes($looped_text, '\\$'), $text, 1);
                } else { // It's a callback block.
                    // Let's extract it so it doesn't conflict
                    // with the local scope variables in the next step.
                    $text = $this->createExtraction('callback_blocks', $match[0][0], $match[0][0], $text);
                }
            }
        }

        /**
         * $data_matches[0] is the raw data tag
         * $data_matches[1] is the data variable (dot notated)
         */
        if (preg_match_all($this->variableTagRegex, $text, $data_matches)) {
            // Modified by Ivan Tcholakov, 24-DEC-2015.
            //foreach ($data_matches[1] as $index => $var) {
            //    if (($val = $this->getVariable($var, $data, '__lex_no_value__')) !== '__lex_no_value__') {
            //        $text = str_replace($data_matches[0][$index], $val, $text);
            //    }
            //}
            $no_value = new Parser_Lex_No_Value;
            foreach ($data_matches[1] as $index => $var) {
                if (($val = $this->getVariable($var, $data, $no_value)) !== $no_value) {
                    if (is_null($val) || is_scalar($val)) {
                        $text = str_replace($data_matches[0][$index], $val, $text);
                    }
                }
            }
            //
        }

        return $text;
    }

    /**
     * Parses all Callback tags, and sends them through the given $callback.
     *
     * @param  string $text           Text to parse
     * @param  mixed  $callback       Callback to apply to each tag
     * @param  bool   $inConditional Whether we are in a conditional tag
     * @return string
     */
    public function parseCallbackTags($text, $data, $callback)
    {
        $this->setupRegex();
        $inCondition = $this->inCondition;

        if ($inCondition) {
            $regex = '/\{\s*('.$this->variableRegex.')(\s+.*?)?\s*\}/ms';
        } else {
            $regex = '/\{\{\s*('.$this->variableRegex.')(\s+.*?)?\s*(\/)?\}\}/ms';
        }
        /**
         * $match[0][0] is the raw tag
         * $match[0][1] is the offset of raw tag
         * $match[1][0] is the callback name
         * $match[1][1] is the offset of callback name
         * $match[2][0] is the parameters
         * $match[2][1] is the offset of parameters
         * $match[3][0] is the self closure
         * $match[3][1] is the offset of closure
         */
        while (preg_match($regex, $text, $match, PREG_OFFSET_CAPTURE)) {
            $selfClosed = false;
            $parameters = array();
            $tag = $match[0][0];
            $start = $match[0][1];
            $name = $match[1][0];
            if (isset($match[2])) {
                $cb_data = $data;
                if ( !empty($this->parser_callback_data)) {
                    $data = $this->toArray($data);
                    $cb_data = array_merge($this->parser_callback_data, $data);
                }
                $raw_params = $this->injectExtractions($match[2][0], '__cond_str');
                $parameters = $this->parseParameters($raw_params, $cb_data, $callback);
            }

            if (isset($match[3])) {
                $selfClosed = true;
            }
            $content = '';

            $temp_text = substr($text, $start + strlen($tag));
            if (preg_match('/\{\{\s*\/'.preg_quote($name, '/').'\s*\}\}/m', $temp_text, $match, PREG_OFFSET_CAPTURE) && ! $selfClosed) {

                $content = substr($temp_text, 0, $match[0][1]);
                $tag .= $content.$match[0][0];

                // Is there a nested block under this one existing with the same name?
                $nested_regex = '/\{\{\s*('.preg_quote($name, '/').')(\s.*?)\}\}(.*?)\{\{\s*\/\1\s*\}\}/ms';
                if (preg_match($nested_regex, $content.$match[0][0], $nested_matches)) {
                    $nested_content = preg_replace('/\{\{\s*\/'.preg_quote($name, '/').'\s*\}\}/m', '', $nested_matches[0]);
                    $content = $this->createExtraction('nested_looped_tags', $nested_content, $nested_content, $content);
                }
            }

            $replacement = call_user_func_array($callback, array($name, $parameters, $content));
            // Added by Ivan Tcholakov, 23-DEC-2015.
            if ($this->is_attribute_being_parsed && !$inCondition) {
                $replacement = $this->serialize($replacement);
            }
            //
            $replacement = $this->parseRecursives($replacement, $content, $callback);

            if ($inCondition) {
                $replacement = $this->valueToLiteral($replacement);
            }
            // Added by Ivan Tcholakov, 23-DEC-2015.
            else {
                $replacement = @ (string) $replacement;
            }
            //
            $text = preg_replace('/'.preg_quote($tag, '/').'/m', addcslashes($replacement, '\\$'), $text, 1);
            $text = $this->injectExtractions($text, 'nested_looped_tags');
        }

        return $text;
    }

    /**
     * Parses all conditionals, then executes the conditionals.
     *
     * @param  string $text     Text to parse
     * @param  mixed  $data     Data to use when executing conditionals
     * @param  mixed  $callback The callback to be used for tags
     * @return string
     */
    public function parseConditionals($text, $data, $callback)
    {
        $this->setupRegex();
        preg_match_all($this->conditionalRegex, $text, $matches, PREG_SET_ORDER);

        $this->conditionalData = $data;

        /**
         * $matches[][0] = Full Match
         * $matches[][1] = Either 'if', 'unless', 'elseif', 'elseunless'
         * $matches[][2] = Condition
         */
        foreach ($matches as $match) {
            $this->inCondition = true;

            $condition = $match[2];

            // Extract all literal string in the conditional to make it easier
            if (preg_match_all('/(["\']).*?(?<!\\\\)\1/', $condition, $str_matches)) {
                foreach ($str_matches[0] as $m) {
                    $condition = $this->createExtraction('__cond_str', $m, $m, $condition);
                }
            }
            $condition = preg_replace($this->conditionalNotRegex, '$1!$2', $condition);

            if (preg_match_all($this->conditionalExistsRegex, $condition, $existsMatches, PREG_SET_ORDER)) {
                foreach ($existsMatches as $m) {
                    $exists = 'true';
                    if ($this->getVariable($m[2], $data, '__doesnt_exist__') === '__doesnt_exist__') {
                        $exists = 'false';
                    }
                    $condition = $this->createExtraction('__cond_exists', $m[0], $m[1].$exists.$m[3], $condition);
                }
            }

            $condition = preg_replace_callback('/\b('.$this->variableRegex.')\b/', array($this, 'processConditionVar'), $condition);

            if ($callback) {
                $condition = preg_replace('/\b(?!\{\s*)('.$this->callbackNameRegex.')(?!\s+.*?\s*\})\b/', '{$1}', $condition);
                $condition = $this->parseCallbackTags($condition, $data, $callback);
            }

            // Re-extract the strings that have now been possibly added.
            if (preg_match_all('/(["\']).*?(?<!\\\\)\1/', $condition, $str_matches)) {
                foreach ($str_matches[0] as $m) {
                    $condition = $this->createExtraction('__cond_str', $m, $m, $condition);
                }
            }


            // Re-process for variables, we trick processConditionVar so that it will return null
            $this->inCondition = false;
            $condition = preg_replace_callback('/\b('.$this->variableRegex.')\b/', array($this, 'processConditionVar'), $condition);
            $this->inCondition = true;

            // Re-inject any strings we extracted
            $condition = $this->injectExtractions($condition, '__cond_str');
            $condition = $this->injectExtractions($condition, '__cond_exists');

            $conditional = '<?php ';

            if ($match[1] == 'unless') {
                $conditional .= 'if ( ! ('.$condition.'))';
            } elseif ($match[1] == 'elseunless') {
                $conditional .= 'elseif ( ! ('.$condition.'))';
            } else {
                $conditional .= $match[1].' ('.$condition.')';
            }

            $conditional .= ': ?>';

            $text = preg_replace('/'.preg_quote($match[0], '/').'/m', addcslashes($conditional, '\\$'), $text, 1);
        }

        $text = preg_replace($this->conditionalElseRegex, '<?php else: ?>', $text);
        $text = preg_replace($this->conditionalEndRegex, '<?php endif; ?>', $text);

        $text = $this->parsePhp($text);
        $this->inCondition = false;

        return $text;
    }

    /**
     * Goes recursively through a callback tag with a passed child array.
     *
     * @param  string $text      - The replaced text after a callback.
     * @param  string $orig_text - The original text, before a callback is called.
     * @param  mixed  $callback
     * @return string $text
     */
    public function parseRecursives($text, $orig_text, $callback)
    {
        // Is there a {{ *recursive [array_key]* }} tag here, let's loop through it.
        // Modified by Ivan Tcholakov, 20-DEC-2015.
        //if (preg_match($this->recursiveRegex, $text, $match)) {
        if (is_scalar($text) && preg_match($this->recursiveRegex, $text, $match)) {
        //
            $array_key = $match[1];
            $tag = $match[0];
            $next_tag = null;
            $children = $this->parser_callback_data[$array_key];
            $child_count = count($children);
            $count = 1;

            // Is the array not multi-dimensional? Let's make it multi-dimensional.
            if ($child_count == count($children, COUNT_RECURSIVE)) {
                $children = array($children);
                $child_count = 1;
            }

            foreach ($children as $child) {
                $has_children = true;

                // If this is a object let's convert it to an array.
                $child = $this->toArray($child);

                // Does this child not contain any children?
                // Let's set it as empty then to avoid any errors.
                if ( ! array_key_exists($array_key, $child)) {
                    $child[$array_key] = array();
                    $has_children = false;
                }

                $replacement = $this->parse($orig_text, $child, $callback, $this->allowPhp);

                // If this is the first loop we'll use $tag as reference, if not
                // we'll use the previous tag ($next_tag)
                $current_tag = ($next_tag !== null) ? $next_tag : $tag;

                // If this is the last loop set the next tag to be empty
                // otherwise hash it.
                $next_tag = ($count == $child_count) ? '' : md5($tag.$replacement);

                $text = str_replace($current_tag, $replacement.$next_tag, $text);

                if ($has_children) {
                    $text = $this->parseRecursives($text, $orig_text, $callback);
                }
                $count++;
            }
        }

        return $text;
    }

    /**
     * Gets or sets the Scope Glue
     *
     * @param  string|null $glue The Scope Glue
     * @return string
     */
    public function scopeGlue($glue = null)
    {
        if ($glue !== null) {
            $this->parser_options['scope_glue'] = $glue;
        }

        return parent::scopeGlue($glue);
    }

    /**
     * Sets the noparse style. Immediate or cumulative.
     *
     * @param  bool $mode
     * @return void
     */
    public function cumulativeNoparse($mode)
    {
        $this->parser_options['cumulative_noparse'] = $mode;

        return parent::cumulativeNoparse($mode);
    }

    /**
     * This is used as a callback for the conditional parser.  It takes a variable
     * and returns the value of it, properly formatted.
     *
     * @param  array  $match A match from preg_replace_callback
     * @return string
     */
    protected function processConditionVar($match)
    {
        $var = is_array($match) ? $match[0] : $match;
        if (in_array(strtolower($var), array('true', 'false', 'null', 'or', 'and')) or
            strpos($var, '__cond_str') === 0 or
            strpos($var, '__cond_exists') === 0 or
            is_numeric($var))
        {
            return $var;
        }

        $value = $this->getVariable($var, $this->conditionalData, '__processConditionVar__');

        if ($value === '__processConditionVar__') {
            return $this->inCondition ? $var : 'null';
        }

        return $this->valueToLiteral($value);
    }

    /**
     * Sets up all the global regex to use the correct Scope Glue.
     *
     * @return void
     */
    public function setupRegex()
    {
        return parent::setupRegex();
    }

    /**
     * Takes a dot-notated key and finds the value for it in the given
     * array or object.
     *
     * @param  string       $key     Dot-notated key to find
     * @param  array|object $data    Array or object to search
     * @param  mixed        $default Default value to use if not found
     * @return mixed
     */
    public function getVariable($key, $data, $default = null)
    {
        if (strpos($key, $this->scopeGlue) === false) {
            $parts = explode('.', $key);
        } else {
            $parts = explode($this->scopeGlue, $key);
        }
        foreach ($parts as $key_part) {
            if (is_array($data)) {

                // Modified by Ivan Tcholakov, 26-DEC-2015.
                //if ( ! array_key_exists($key_part, $data)) {
                //    return $default;
                //}
                $key_part_int = filter_var($key_part, FILTER_VALIDATE_INT);
                $key_part_is_int = $key_part_int !== false;

                if ($key_part_is_int && !array_key_exists($key_part, $data)) {
                    $key_part = $key_part_int;
                }

                if (!array_key_exists($key_part, $data)) {
                    return $default;
                }
                //

                $data = $data[$key_part];
            } elseif (is_object($data)) {
                if ( ! isset($data->{$key_part})) {
                    return $default;
                }

                $data = $data->{$key_part};
            } else {
                return $default;
            }
        }

        return $data;
    }

    //--------------------------------------------------------------------------

    // Added by Ivan Tcholakov, 26-DEC-2015.
    public function & getVariableRef($key, & $data) {

        if (strpos($key, $this->scopeGlue) === false) {
            $parts = explode('.', $key);
        } else {
            $parts = explode($this->scopeGlue, $key);
        }

        $i = 0;
        $count = count($parts);
        $d = & $data;

        while ($i < $count) {

            $key_part = $parts[$i];
            $key_part_int = filter_var($key_part, FILTER_VALIDATE_INT);
            $key_part_is_int = $key_part_int !== false;
            $get_ref = ($i + 1) == $count;

            if ($key_part_is_int && is_object($d)) {
                $d = (array) $d;
            }

            if (!is_array($d) && !is_object($d)) {
                $d = array();
            }

            if (is_array($d)) {

                if ($key_part_is_int && !array_key_exists($key_part, $d)) {
                    $key_part = $key_part_int;
                }

                if ($get_ref) {

                    if (!array_key_exists($key_part, $d)) {
                        $d[$key_part] = null;
                    }

                    return $d[$key_part];

                } else {

                    if (!isset($d[$key_part])) {
                        $d[$key_part] = array();
                    }

                    $d = & $d[$key_part];
                }

            } else {

                if ($get_ref) {

                    if (!property_exists($d, $key_part)) {
                        $d->{$key_part} = null;
                    }

                    return $d->{$key_part};

                } else {

                    if (!property_exists($d, $key_part)) {
                        $d->{$key_part} = array();
                    }

                    $d = & $d->{$key_part};
                }
            }

            $i++;
        }
    }

    // Added by Ivan Tcholakov, 26-DEC-2015.
    public function setVariable($key, $value, & $data) {

        if (strpos($key, $this->scopeGlue) === false) {
            $parts = explode('.', $key);
        } else {
            $parts = explode($this->scopeGlue, $key);
        }

        $i = 0;
        $count = count($parts);
        $d = & $data;

        while ($i < $count) {

            $key_part = $parts[$i];
            $key_part_int = filter_var($key_part, FILTER_VALIDATE_INT);
            $key_part_is_int = $key_part_int !== false;
            $set_value = ($i + 1) == $count;

            if ($key_part_is_int && is_object($d)) {
                $d = (array) $d;
            }

            if (!is_array($d) && !is_object($d)) {
                $d = array();
            }

            if (is_array($d)) {

                if ($key_part_is_int && !array_key_exists($key_part, $d)) {
                    $key_part = $key_part_int;
                }

                if ($set_value) {

                    $d[$key_part] = $value;

                } else {

                    if (!isset($d[$key_part])) {
                        $d[$key_part] = array();
                    }

                    $d = & $d[$key_part];
                }

            } else {

                if ($set_value) {

                    $d->{$key_part} = $value;

                } else {

                    if (!property_exists($d, $key_part)) {
                        $d->{$key_part} = array();
                    }

                    $d = & $d->{$key_part};
                }
            }

            $i++;
        }
    }

}
