<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

abstract class Parser_Lex_Extension {

    protected $parsed_attributes = array();
    protected $parsed_content = array();
    protected $parser_instance;
    protected $extension_config;
    protected $extension_path;
    protected $extension_class;
    protected $extension_method;

    public function __construct() {

        $this->extension_config = & Parser_Lex_Extensions::$parser_config;
    }

    public function __get($variable) {

        $ci = & get_instance();

        if (isset($ci->$variable)) {
            return $ci->$variable;
        }

        return null;
    }

    public function get_file_name() {

        $reflection = new ReflectionClass(get_class($this));
        return $reflection->getFileName();
    }

    public function get_file_path() {

        return rtrim(str_replace('\\', '/', realpath(dirname($this->get_file_name()))), '/').'/';
    }

    public function set_parser_instance($object) {

        $this->parser_instance = $object;
    }

    public function set_extension_path($path) {

        $this->extension_path = $path;
    }

    public function set_extension_class($class) {

        $this->extension_class = $class;
    }

    public function set_extension_method($method) {

        $this->extension_method = $method;
    }

    public function set_extension_data($content, $attributes) {

        $content AND $this->parsed_content = $content;

        $parse_content = false;

        switch ($this->extension_class) {

            case 'html':

                $parse_content = true;
                break;
        }

        if ($attributes) {

            $set = false;

            // Check for parsing the tag's content..
            // Parsing is enabled by default, it could be disabled
            // using a special parameter for that.
            foreach (array('parse_content', 'parse-content') as $attr) {

                if (isset($attributes[$attr]) && !$set) {

                    $parse_content = str_to_bool($attributes[$attr]);
                    $set = true;
                }
            }

            if (isset($attributes['parse_content'])) {
                unset($attributes['parse_content']);
            }

            if (isset($attributes['parse-content'])) {
                unset($attributes['parse-content']);
            }
        }

        if ($parse_content && is_scalar($this->parsed_content) && $this->parsed_content != '') {

            $parser = new Parser_Lex_Extensions;

            $parser->scopeGlue($this->parser_instance->parser_options['scope_glue']);
            $parser->cumulativeNoparse($this->parser_instance->parser_options['cumulative_noparse']);

            $this->parsed_content = $parser->parse(
                $this->parsed_content,
                $this->parser_instance->parser_data,
                array($this->parser_instance, 'parser_callback'),
                $this->parser_instance->parser_options['allow_php']
            );

            unset($parser);
        }

        if ($attributes) {

            $parse_params = true;
            $set = false;

            // Check for additional parsing of the parameters.
            // Additional parsing is enabled by default, it could be disabled
            // using a special parameter for that.
            foreach (array('parse_params', 'parse-params') as $attr) {

                if (isset($attributes[$attr]) && !$set) {

                    $parse_params = str_to_bool($attributes[$attr]);
                    $set = true;
                }
            }

            if (isset($attributes['parse_params'])) {
                unset($attributes['parse_params']);
            }

            if (isset($attributes['parse-params'])) {
                unset($attributes['parse-params']);
            }

            $no_value = new Parser_Lex_No_Value;

            foreach ($attributes as $key => $attr) {

                if (is_string($attr)) {

                    if ($this->parser_instance->is_serialized(trim($attr), $value)) {

                        $attributes[$key] = $value;

                    } elseif (
                        preg_match('/^\s*\[\[(.*)\]\]\s*$/ms', $attr, $matches)
                        &&
                        (
                            ($value = $this->parser_instance->getVariable(
                                trim($matches[1]),
                                $this->parser_instance->parser_data,
                                $no_value))
                            !== $no_value
                        )
                    ) {

                        $attributes[$key] = $value;

                    } elseif (
                        $parse_params
                        &&
                        strpos($attr, '[[') !== false && strpos($attr, ']]') !== false
                    ) {

                        if (preg_match('/^\s*\[\[(.*)\]\]\s*$/ms', $attr, $matches)) {
                            $a = trim(str_replace(array('[[', ']]'), array('{{', '}}'), $attr));
                        } else {
                            $a = '{{'.$attr.'}}';
                        }

                        $parser = new Parser_Lex_Extensions;

                        $parser->is_attribute_being_parsed = true;
                        $parser->scopeGlue($this->parser_instance->parser_options['scope_glue']);
                        $parser->cumulativeNoparse($this->parser_instance->parser_options['cumulative_noparse']);

                        $value = $parser->parse(
                            $a,
                            $this->parser_instance->parser_data,
                            array($this->parser_instance, 'parser_callback'),
                            $this->parser_instance->parser_options['allow_php']
                        );

                        unset($parser);

                        $attributes[$key] = $this->parser_instance->is_serialized(trim($value), $result)
                            ? $result
                            : $value;
                    }
                }
            }
        }

        $this->parsed_attributes = $attributes;
    }

    public function get_content() {

        return $this->parsed_content;
    }

    public function get_attributes() {

        return $this->parsed_attributes;
    }

    public function get_attribute_values() {

        if (empty($this->parsed_attributes) || !is_array($this->parsed_attributes)) {
            return array();
        }

        return array_values($this->parsed_attributes);
    }

    public function get_attribute($attribute, $default = null) {

        $index = filter_var($attribute, FILTER_VALIDATE_INT);

        if ($index !== false) {

            $attributes = $this->get_attribute_values();

            return array_key_exists($index, $attributes) ? $attributes[$index] : $default;
        }

        return array_key_exists($attribute, $this->parsed_attributes) ? $this->parsed_attributes[$attribute] : $default;
    }

    public function set_attribute($attribute, $value) {

        $this->parsed_attributes[$attribute] = $value;
    }

    public function detect_boolean_attributes($attr_list) {

        if (empty($this->parsed_attributes) || !is_array($this->parsed_attributes)) {
            return;
        }

        if (!is_array($attr_list)) {
            $attr_list = (array) $attr_list;
        }

        if (empty($attr_list)) {
            return;
        }

        foreach ($attr_list as $key => $value) {

            $index = filter_var($value, FILTER_VALIDATE_INT);

            if ($index !== false) {
                $attr_list[$key] = $index;
            }
        }

        $i = 0;

        foreach ($this->parsed_attributes as $key => $value) {

            if (in_array($i, $attr_list, true) || in_array($key, $attr_list, true)) {
                $this->parsed_attributes[$key] = str_to_bool($value);
            }

            $i++;
        }
    }

    protected function _is_function_allowed($name, & $message = null) {

        static $whitelist = null;

        if (!is_array($whitelist)) {

            $whitelist =
                isset($this->extension_config['allowed_functions'])
                    ? $this->extension_config['allowed_functions']
                    : array();

            if (!is_array($whitelist)) {
                $whitelist = array();
            }
        }

        if ($name != '' && in_array($name, $whitelist)) {
            return true;
        }

        $message = $this->_function_not_found($name);

        return false;
    }

    protected function _function_not_found($name) {

        return 'The function '.$name.'() has not been found or it is not allowed.';
    }

    protected function _is_global_allowed($name) {

        static $whitelist = null;

        if (!is_array($whitelist)) {

            $whitelist =
                isset($this->extension_config['allowed_globals'])
                    ? (is_array($this->extension_config['allowed_globals'])
                        ? array_map('strtolower', $this->extension_config['allowed_globals'])
                        : array()
                    )
                    : array();
        }

        if ($name != '' && in_array(strtolower($name), $whitelist)) {
            return true;
        }

        return false;
    }

    protected function is_blacklisted_config_setting($item_name) {

        static $blacklist = null;

        if (!is_array($blacklist)) {

            $blacklist = isset($this->extension_config['disabled_config_settings'])
                ? $this->extension_config['disabled_config_settings']
                : array();

            if (!is_array($blacklist)) {
                $blacklist = array();
            }

            if (!empty($blacklist)) {

                $list = array_chunk($blacklist, 50);

                foreach ($list as $key => $items) {
                    $list[$key] = implode('|', array_map('preg_quote', $items));
                }

                $blacklist = $list;
            }

        } else {

            $blacklist = array();
        }

        if ($item_name == '') {
            return true;
        }

        if (empty($blacklist)) {
            return false;
        }

        foreach ($blacklist as $items) {

            if (preg_match('/('.$items.')/', $item_name)) {
                return true;
            }
        }

        return false;
    }

}
