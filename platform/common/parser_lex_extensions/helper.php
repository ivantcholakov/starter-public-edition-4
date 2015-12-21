<?php defined('BASEPATH') or exit('No direct script access allowed');

class Parser_Lex_Extension_Helper extends Parser_Lex_Extension {

    public static $_counter_increment = true;
    protected $parser_lex_allowed_functions;

    public function __construct() {

        parent::__construct();

        $this->parser_lex_allowed_functions =
            isset($this->parser_lex_config['allowed_functions'])
                ? $this->parser_lex_config['allowed_functions']
                : array();

    }

    protected function _function_not_found($name) {

        return 'The function '.$name.'() has not been found or it is not allowed.';
    }

    public function __call($name, $args) {

        if (function_exists($name) && in_array($name, $this->parser_lex_allowed_functions)) {

            $attributes = $this->_get_attributes();

            return call_user_func_array($name, $attributes);
        }

        return $this->_function_not_found($name);
    }

    public function _func_empty() {

        $name = 'empty';

        if (!in_array($name, $this->parser_lex_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->_get_attributes();

        if (!empty($attributes)) {

            foreach ($attributes as $value) {
                return empty($value);
            }
        }

        return true;
    }

    public function _func_isset() {

        $name = 'isset';

        if (!in_array($name, $this->parser_lex_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->_get_attributes();

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

        $line = $this->_get_attribute('line');

        return $this->lang->line($line);
    }

    public function config() {

        $item = $this->_get_attribute('item');

        return config_item($item);
    }

    public function date() {

        $this->load->helper('date');

        $format = $this->_get_attribute('format');
        $timestamp = $this->_get_attribute('timestamp', time());

        return format_date($timestamp, $format);
    }

    public function timespan() {

        $timespan = date($this->_get_attribute('timestamp', now()));

        return timespan($timespan, time());
    }

    public function counter() {

        static $count = array();

        $key = $this->_get_attribute('identifier', 'default');

        if (!isset($count[$key])) {
            $count[$key] = $this->_get_attribute('start', 1);
        } elseif (self::$_counter_increment) {
            ($this->_get_attribute('mode') == 'subtract') ? $count[$key]-- : $count[$key]++;
        }

        self::$_counter_increment = true;

        return (str_to_bool($this->_get_attribute('return', true))) ? $count[$key] : null;
    }

    public function show_counter() {

        self::$_counter_increment = false;

        return self::counter();
    }

    public function ltrim() {

        $name = 'ltrim';

        if (!in_array($name, $this->parser_lex_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->_get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $name), $attributes)
            : call_user_func_array($name, $attributes);
    }

    public function rtrim() {

        $name = 'rtrim';

        if (!in_array($name, $this->parser_lex_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->_get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $name), $attributes)
            : call_user_func_array($name, $attributes);
    }

    public function trim() {

        $name = 'trim';

        if (!in_array($name, $this->parser_lex_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->_get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $name), $attributes)
            : call_user_func_array($name, $attributes);
    }

}
