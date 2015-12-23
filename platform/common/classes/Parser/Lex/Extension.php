<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
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

        if ($this->config->load('parser_lex', TRUE, TRUE)) {
            $this->extension_config = $this->config->item('parser_lex');
        } else {
            $this->extension_config = array();
        }
    }

    public function __get($variable) {

        $ci = & get_instance();

        if (isset($ci->$variable)) {
            return $ci->$variable;
        }

        return null;
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

            foreach ($attributes as $key => $value) {

                $value = (string) $value;

                if (
                    (strpos($value, '[[') !== false && strpos($value, ']]') !== false)
                ) {

                    if ($parse_params) {

                        $parser = new Parser_Lex_Extensions;

                        $parser->scopeGlue($this->parser_instance->parser_options['scope_glue']);
                        $parser->cumulativeNoparse($this->parser_instance->parser_options['cumulative_noparse']);

                        $attribute_test = $parser->parse(
                            $value,
                            $this->parser_instance->parser_data,
                            array($this->parser_instance, 'parser_callback'),
                            $this->parser_instance->parser_options['allow_php']
                        );

                    } else {

                        $attribute_test = $value;
                    }

                    // Check whether the attribute is probaly a single non-scalar value.
                    if (preg_match('/^(\{\{|\[\[)(.+)(\}\}|\]\])$/ms', trim($attribute_test))) {

                        $attribute_test = trim($attribute_test, "[]{} \t\n\r\0\x0B");

                        if (isset($this->parser_instance->parser_data[$attribute_test])) {

                            // Assign the raw variable value.
                            $attributes[$key] = $this->parser_instance->parser_data[$attribute_test];

                        } else {

                            // Give up, set the attribute to NULL.
                            $attributes[$key] = null;
                        }

                    } else {

                        // The parsed attribute likely represents a scalar value, assign it.
                        $attributes[$key] = $attribute_test;
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

    public function get_attribute($attribute, $default = null) {

        return isset($this->parsed_attributes[$attribute]) ? $this->parsed_attributes[$attribute] : $default;
    }

    public function set_attribute($attribute, $value) {

        $this->parsed_attributes[$attribute] = $value;
    }

}
