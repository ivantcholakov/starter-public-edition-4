<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Helper extends Parser_Lex_Extension {

    public static $_counter_increment = true;
    protected $parser_allowed_functions;

    public function __construct() {

        parent::__construct();

        $this->parser_allowed_functions =
            isset($this->extension_config['allowed_functions'])
                ? $this->extension_config['allowed_functions']
                : array();

    }

    public function __call($name, $args) {

        if (function_exists($name) && in_array($name, $this->parser_allowed_functions)) {

            $attributes = $this->get_attributes();

            return call_user_func_array($name, $attributes);
        }

        return $this->_function_not_found($name);
    }

    protected function _function_not_found($name) {

        return 'The function '.$name.'() has not been found or it is not allowed.';
    }

    protected function _set_type(& $value, $type) {

        // "boolean" (or, since PHP 4.2.0, "bool")
        // "integer" (or, since PHP 4.2.0, "int")
        // "float" (only possible since PHP 4.2.0, for older versions use the deprecated variant "double")
        // "string"
        // "array"
        // "object"
        // "null" (since PHP 4.2.0)
        $type = isset($type) ? (trim(strtolower(@ (string) $type))) : null;

        if ($type === null) {
            return true;
        }

        switch ($type) {

            case 'bool':

                $type = 'boolean';
                break;

            case 'int':

                $type = 'integer';
                break;

            case 'double':

                $type = 'float';
                break;
        }

        return @ settype($value, $type);
    }

    protected function _set_display(& $value, $mode) {

        // "print_d"
        // "print_r"
        // "var_dump"
        // "var_export"
        $mode = isset($mode) ? (strtolower(@ (string) $mode)) : null;

        switch ($mode) {

            case 'print_d':

                $value = print_d($value, true);
                break;

            case 'print_r':

                $value = print_r($value, true);
                break;

            case 'var_dump':

                ob_start();
                var_dump($value);
                $result = ob_get_clean();
                $value = $result;
                break;

            case 'var_export':

                $value = var_export($value, true);
                break;
        }
    }

    protected function _type($type) {

        $attributes = $this->get_attribute_values();

        $value = isset($attributes[0]) ? $attributes[0] : null;
        $display = isset($attributes[1]) ? $attributes[1] : null;

        $this->_set_type($value, $type);
        $this->_set_display($value, $display);

        return $value;
    }

    protected function _display($display) {

        $attributes = $this->get_attribute_values();

        $value = isset($attributes[0]) ? $attributes[0] : null;

        $this->_set_display($value, $display);

        return $value;
    }

    protected function _utf8($function) {

        if (!in_array($function, $this->parser_allowed_functions)) {
            return $this->_function_not_found($function);
        }

        $attributes = $this->get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $function), $attributes)
            : call_user_func_array($function, $attributes);
    }

    //--------------------------------------------------------------------------

    public function _func_array() {

        return $this->_type('array');
    }

    public function bool() {

        return $this->_type('boolean');
    }

    public function boolean() {

        return $this->_type('boolean');
    }

    public function config() {

        $item = $this->get_attribute('item');

        return config_item($item);
    }

    public function counter() {

        static $count = array();

        $key = $this->get_attribute('identifier', 'default');

        if (!isset($count[$key])) {
            $count[$key] = $this->get_attribute('start', 1);
        } elseif (self::$_counter_increment) {
            ($this->get_attribute('mode') == 'subtract') ? $count[$key]-- : $count[$key]++;
        }

        self::$_counter_increment = true;

        return (str_to_bool($this->get_attribute('return', true))) ? $count[$key] : null;
    }

    public function show_counter() {

        self::$_counter_increment = false;

        return self::counter();
    }

    public function date() {

        $this->load->helper('date');

        $format = $this->get_attribute('format');
        $timestamp = $this->get_attribute('timestamp', time());

        return format_date($timestamp, $format);
    }

    public function double() {

        return $this->_type('float');
    }

    public function _func_empty() {

        $name = 'empty';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attribute_values();

        return empty($attributes[0]);
    }

    public function float() {

        return $this->_type('float');
    }

    public function get() {

        $attributes = $this->get_attribute_values();

        $name = isset($attributes[0]) ? (trim(@ (string) $attributes[0])) : null;
        $value = null;

        if (isset($name)) {

            $no_value = new Parser_Lex_No_Value;

            $var = $this->parser_instance->getVariable(
                $name,
                $this->parser_instance->parser_data,
                $no_value
            );

            if ($var !== $no_value) {
                $value = $var;
            }
        }

        return $value;
    }

    public function gravatar() {

        $this->load->library('gravatar');

        $email = $this->get_attribute('email', '');
        $size = $this->get_attribute('size', '50');
        $rating = $this->get_attribute('rating', 'g');
        $url_only = str_to_bool($this->get_attribute('url-only', false));

        $gravatar_url = $this->gravatar->get($email, $size, null, null, $rating);

        if ($url_only) {
            return $gravatar_url;
        }

        return '<img src="'.$gravatar_url.'" alt="Gravatar" class="gravatar" />';
    }

    public function int() {

        return $this->_type('integer');
    }

    public function integer() {

        return $this->_type('integer');
    }

    public function _func_isset() {

        $name = 'isset';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        if (!empty($attributes)) {

            foreach ($attributes as $value) {

                if (!isset($value)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    public function lang() {

        $line = $this->get_attribute('line');

        return $this->lang->line($line);
    }

    public function ltrim() {

        return $this->_utf8(__FUNCTION__);
    }

    // Image Processing Demo.
    // Rework this method or create a similar one according to the
    // concrete image processing implementation.
    public function my_image_url() {

        $attributes = $this->get_attribute_values();

        $src = (isset($attributes[0]) && $attributes[0] != '') ? $attributes[0] : image_url('lib/blank.png');
        $width = (isset($attributes[1]) && $attributes[1] != '') ? $attributes[1] : null;
        $height = (isset($attributes[2]) && $attributes[2] != '') ? $attributes[2] : null;
        $no_crop = (isset($attributes[3]) && $attributes[3] != '') ? str_to_bool($attributes[3]) : null;
        $keep_canvas_size = (isset($attributes[4]) && $attributes[4] != '') ? str_to_bool($attributes[4]) : null;

        return http_build_url(
            site_url('playground/image-process'),
            array('query' => http_build_query(array(
                'src' => $src,
                'w' => $width,
                'h' => $height,
                'no_crop' => $no_crop,
                'keep_canvas_size' => $keep_canvas_size
            ))),
            HTTP_URL_JOIN_QUERY
        );
    }

    public function _func_null() {

        return $this->_type('null');
    }

    public function object() {

        return $this->_type('object');
    }

    public function preg_match() {

        $name = 'preg_match';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attribute_values();

        if (count($attributes) >= 3) {

            $matches_attr = trim(@ (string) $attributes[2]);

            if (!str_to_bool($matches_attr) || str_to_bool($matches_attr, true)) {

                $matches = array();
                $attributes[2] = & $matches;

            } else {

                $attributes[2] = & $this->parser_instance->getVariableRef($matches_attr, $this->parser_instance->parser_data);
                $attributes[2] = array();
            }
        }

        return call_user_func_array($name, $attributes);
    }

    public function preg_match_all() {

        $name = 'preg_match_all';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attribute_values();

        if (count($attributes) >= 3) {

            $matches_attr = trim(@ (string) $attributes[2]);

            if (!str_to_bool($matches_attr) || str_to_bool($matches_attr, true)) {

                $matches = array();
                $attributes[2] = & $matches;

            } else {

                $attributes[2] = & $this->parser_instance->getVariableRef($matches_attr, $this->parser_instance->parser_data);
                $attributes[2] = array();
            }
        }

        return call_user_func_array($name, $attributes);
    }

    public function preg_replace() {

        $name = 'preg_replace';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attribute_values();

        if (count($attributes) >= 5) {

            $count_attr = trim(@ (string) $attributes[4]);

            if (!str_to_bool($count_attr) || str_to_bool($count_attr, true)) {

                $count = 0;
                $attributes[4] = & $count;

            } else {

                $attributes[4] = & $this->parser_instance->getVariableRef($count_attr, $this->parser_instance->parser_data);
                $attributes[4] = 0;
            }
        }

        return call_user_func_array($name, $attributes);
    }

    public function print_d() {

        $name = 'print_d';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        return $this->_display($name);
    }

    public function print_r() {

        $name = 'print_r';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        return $this->_display($name);
    }

    public function rand_string() {

        $name = 'rand_string';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attribute_values();

        $length = isset($attributes[0]) ? $attributes[0] : 10;

        return rand_string($length);
    }

    public function rtrim() {

        return $this->_utf8(__FUNCTION__);
    }

    public function set() {

        $attributes = $this->get_attribute_values();

        if (count($attributes) < 1) {
            return;
        }

        $name = @ (string) $attributes[0];
        $value = isset($attributes[1]) ? $attributes[1] : null;
        $type = isset($attributes[2]) ? ($attributes[2]) : null;

        $success = $this->_set_type($value, $type);

        $this->parser_instance->setVariable($name, $value, $this->parser_instance->parser_data);
    }

    public function str_replace() {

        $name = 'str_replace';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        if (count($attributes) >= 4) {

            $i = 0;

            foreach ($attributes as $key => $count_attr) {

                if ($i == 3) {
                    break;
                }

                $i++;
            }

            if (!str_to_bool($count_attr) || str_to_bool($count_attr, true)) {

                $count = 0;
                $attributes[$key] = & $count;

            } else {

                $this->parser_instance->parser_data[$count_attr] = 0;
                $attributes[$key] = & $this->parser_instance->parser_data[$count_attr];
            }
        }

        return call_user_func_array($name, $attributes);
    }

    public function string() {

        return $this->_type('string');
    }

    public function stripos() {

        return $this->_utf8(__FUNCTION__);
    }

    public function strlen() {

        return $this->_utf8(__FUNCTION__);
    }

    public function strpos() {

        return $this->_utf8(__FUNCTION__);
    }

    public function strtolower() {

        return $this->_utf8(__FUNCTION__);
    }

    public function strtoupper() {

        return $this->_utf8(__FUNCTION__);
    }

    public function substr() {

        return $this->_utf8(__FUNCTION__);
    }

    public function timespan() {

        $timespan = date($this->get_attribute('timestamp', now()));

        return timespan($timespan, time());
    }

    public function trim() {

        return $this->_utf8(__FUNCTION__);
    }

    public function var_export() {

        $name = 'var_export';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        return $this->_display($name);
    }

    public function var_dump() {

        $name = 'var_dump';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        return $this->_display($name);
    }

    public function ucfirst() {

        return $this->_utf8(__FUNCTION__);
    }

    public function ucwords() {

        return $this->_utf8(__FUNCTION__);
    }

    public function wordwrap() {

        return $this->_utf8(__FUNCTION__);
    }

}
