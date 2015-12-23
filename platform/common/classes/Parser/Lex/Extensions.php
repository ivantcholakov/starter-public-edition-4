<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extensions extends Lex\Parser {

    public $parser_options = array();
    public $parser_data = null;
    public $parser_callback_data = array();

    protected $ci;
    protected static $loaded = array();  // Used for tracking loaded extension classes.

    public function __construct() {

        $this->ci = & get_instance();

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

        $data = $this->locate($name, $attributes, $content);

        if (is_array($data) && $data) {

        }

        return $data ? $data : null;
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

    public function locate($name, $attributes, $content) {

        $scope_glue = $this->parser_options['scope_glue'];

        if (strpos($name, $scope_glue) === false) {
            return false;
        }

        list($class, $method) = explode($scope_glue, $name);

        foreach (array(APPPATH, COMMONPATH) as $directory) {

            if (file_exists($path = $directory.'parser_lex_extensions/'.$class.'.php')) {
                return $this->process($path, $class, $method, $attributes, $content);
            }
        }
    }

    protected function process($path, $class, $method, $attributes, $content) {

        $class = strtolower($class);
        $class_name = 'Parser_Lex_Extension_'.ucfirst($class);

        if (!isset(self::$loaded[$class])) {

            include_once $path;
            self::$loaded[$class] = true;
        }

        if (!class_exists($class_name, false)) {

            log_message('error', 'Class '.$class_name.' does not exist.');
            return false;
        }

        $extension = new $class_name;

        if (@ !is_a($extension, 'Parser_Lex_Extension')) {

            log_message('error', 'Class '.$class_name.' has not been derived from Parser_Lex_Extension class.');
            return false;
        }

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
                )
        ) {
            $method = '_func_'.$method;
        }

        if (!is_callable(array($extension, $method))) {

            if (property_exists($extension, $method)) {
                return true;
            }

            log_message('error', 'Method '.$method.'() does not exist on the class "'.$class_name.'".');
            return false;
        }

        return call_user_func(array($extension, $method));
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
            foreach ($data_matches[1] as $index => $var) {
                if (($val = $this->getVariable($var, $data, '__lex_no_value__')) !== '__lex_no_value__') {
                    // Modified by Ivan Tcholakov, 20-DEC-2015.
                    //$text = str_replace($data_matches[0][$index], $val, $text);
                    // Don't try to parse array and object types.
                    // Interpretation of these types is to be done later.
                    if (is_scalar($val)) {
                        $text = str_replace($data_matches[0][$index], $val, $text);
                    }
                    //
                }
            }
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
            $this->regexSetup = false;
            $this->scopeGlue = $glue;
            $this->parser_options['scope_glue'] = $glue;
        }

        return $this->scopeGlue;
    }

    /**
     * Sets the noparse style. Immediate or cumulative.
     *
     * @param  bool $mode
     * @return void
     */
    public function cumulativeNoparse($mode)
    {
        $this->cumulativeNoparse = $mode;
        $this->parser_options['cumulative_noparse'] = $mode;
    }

}
