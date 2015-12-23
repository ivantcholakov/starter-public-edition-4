<?php defined('BASEPATH') or exit('No direct script access allowed');

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

    protected function _function_not_found($name) {

        return 'The function '.$name.'() has not been found or it is not allowed.';
    }

    public function __call($name, $args) {

        if (function_exists($name) && in_array($name, $this->parser_allowed_functions)) {

            $attributes = $this->get_attributes();

            return call_user_func_array($name, $attributes);
        }

        return $this->_function_not_found($name);
    }

    public function _func_empty() {

        $name = 'empty';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attribute_values();

        return empty($attributes[0]);
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

    public function config() {

        $item = $this->get_attribute('item');

        return config_item($item);
    }

    public function date() {

        $this->load->helper('date');

        $format = $this->get_attribute('format');
        $timestamp = $this->get_attribute('timestamp', time());

        return format_date($timestamp, $format);
    }

    public function timespan() {

        $timespan = date($this->get_attribute('timestamp', now()));

        return timespan($timespan, time());
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

    public function ltrim() {

        $name = 'ltrim';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $name), $attributes)
            : call_user_func_array($name, $attributes);
    }

    public function rtrim() {

        $name = 'rtrim';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $name), $attributes)
            : call_user_func_array($name, $attributes);
    }

    public function preg_match() {

        $name = 'preg_match';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        if (count($attributes) >= 3) {

            $i = 0;

            foreach ($attributes as $key => $matches_attr) {

                if ($i == 2) {
                    break;
                }

                $i++;
            }

            if (!str_to_bool($matches_attr) || str_to_bool($matches_attr, true)) {

                $matches = array();
                $attributes[$key] = & $matches;

            } else {

                $this->parser_instance->parser_data[$matches_attr] = array();
                $attributes[$key] = & $this->parser_instance->parser_data[$matches_attr];
            }
        }

        return call_user_func_array($name, $attributes);
    }

    public function preg_match_all() {

        $name = 'preg_match_all';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        if (count($attributes) >= 3) {

            $i = 0;

            foreach ($attributes as $key => $matches_attr) {

                if ($i == 2) {
                    break;
                }

                $i++;
            }

            if (!str_to_bool($matches_attr) || str_to_bool($matches_attr, true)) {

                $matches = array();
                $attributes[$key] = & $matches;

            } else {

                $this->parser_instance->parser_data[$matches_attr] = array();
                $attributes[$key] = & $this->parser_instance->parser_data[$matches_attr];
            }
        }

        return call_user_func_array($name, $attributes);
    }

    public function preg_replace() {

        $name = 'preg_replace';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        if (count($attributes) >= 5) {

            $i = 0;

            foreach ($attributes as $key => $count_attr) {

                if ($i == 4) {
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

    // Shows a variable value. This helper is needed for displaying changed/created
    // by callbacks variables during the template parsing.
    // Generally, variables are parsed first, callbacks are parsed later.
    // Debugging preview modes are allowed.
    public function _func_var() {

        $attributes = $this->get_attributes();

        $var = null;
        $mode = '';

        if (!empty($attributes)) {

            $i = 0;

            foreach ($attributes as $attr) {

                if ($i == 0 && isset($this->parser_instance->parser_data[$attr])) {
                    $var = $this->parser_instance->parser_data[$attr];
                }

                if ($i == 1) {
                    $mode = $attr;
                }

                $i++;
            }
        }

        switch ($mode) {

            case 'var_dump':

                ob_start();
                var_dump($var);
                $result = ob_get_clean();
                $var = $result;
                break;

            case 'var_export':

                $var = var_export($var, true);
                break;

            case 'print_r':

                $var = print_r($var, true);
                break;

            case 'print_d':

                $var = print_d($var, true);
                break;
        }

        return $var;
    }

    public function trim() {

        $name = 'trim';

        if (!in_array($name, $this->parser_allowed_functions)) {
            return $this->_function_not_found($name);
        }

        $attributes = $this->get_attributes();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', $name), $attributes)
            : call_user_func_array($name, $attributes);
    }

}
