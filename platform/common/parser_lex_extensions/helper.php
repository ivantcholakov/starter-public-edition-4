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

    public function set_data($content, $attributes) {

        $attributes['parse_params'] = false;

        return parent::set_data($content, $attributes);
    }

    protected function _prepare_attributes() {

        $attributes = $this->attributes();

        if (isset($attributes['parse_params'])) {
            unset($attributes['parse_params']);
        }

        if (isset($attributes['parse-params'])) {
            unset($attributes['parse-params']);
        }

        if (!empty($attributes)) {

            foreach ($attributes as $key => $value) {

                if (strpos($value, '{') !== false || strpos($value, '[') !== false ) {

                    $value = trim($value, "[]{} \t\n\r\0\x0B");

                    if (isset($this->parser_lex_extensions->options['data'][$value])) {
                        $attributes[$key] = $this->parser_lex_extensions->options['data'][$value];
                    } else {
                        $attributes[$key] = null;
                    }
                }
            }
        }

        return $attributes;
    }

    protected function _function_not_found($name) {

        return 'The function '.$name.'() has not been found or it is not allowed.';
    }

    public function __call($name, $args) {

        if (function_exists($name) && in_array($name, $this->parser_lex_allowed_functions)) {

            $attributes = $this->_prepare_attributes();

            return call_user_func_array($name, $attributes);
        }

        return $this->_function_not_found($name);
    }

    public function func_empty() {

        $attributes = $this->_prepare_attributes();

        if (!empty($attributes)) {

            foreach ($attributes as $value) {
                return empty($value);
            }
        }

        return true;
    }

    public function func_isset() {

        $attributes = $this->attributes();

        if (isset($attributes['parse_params'])) {
            unset($attributes['parse_params']);
        }

        if (isset($attributes['parse-params'])) {
            unset($attributes['parse-params']);
        }

        if (!empty($attributes)) {

            foreach ($attributes as $value) {

                if (strpos($value, '[') !== false || strpos($value, '{') !== false) {

                    $value = trim($value, "[]{} \t\n\r\0\x0B");

                    if (!isset(${$value})) {
                        return false;
                    }

                } else {

                    return false;
                }
            }

            return true;
        }

        return false;
    }

    public function lang() {

        $line = $this->attribute('line');

        return $this->lang->line($line);
    }

    public function config() {

        $item = $this->attribute('item');

        return config_item($item);
    }

    public function date() {

        $this->load->helper('date');

        $format = $this->attribute('format');
        $timestamp = $this->attribute('timestamp', time());

        return format_date($timestamp, $format);
    }

    public function timespan() {

        $timespan = date($this->attribute('timestamp', now()));

        return timespan($timespan, time());
    }

    public function counter() {

        static $count = array();

        $key = $this->attribute('identifier', 'default');

        if (!isset($count[$key])) {
            $count[$key] = $this->attribute('start', 1);
        } elseif (self::$_counter_increment) {
            ($this->attribute('mode') == 'subtract') ? $count[$key]-- : $count[$key]++;
        }

        self::$_counter_increment = true;

        return (str_to_bool($this->attribute('return', true))) ? $count[$key] : null;
    }

    public function show_counter() {

        self::$_counter_increment = false;

        return self::counter();
    }

}
