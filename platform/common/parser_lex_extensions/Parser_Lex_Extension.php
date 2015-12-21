<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

abstract class Parser_Lex_Extension {

    protected $parser_lex_attributes = array();
    protected $parser_lex_content = array();
    protected $parser_lex_extensions;
    protected $parser_lex_config;
    protected $parser_lex_path;
    protected $parser_lex_class;
    protected $parser_lex_method;

    public function __construct() {

        if ($this->config->load('parser_lex', TRUE, TRUE)) {
            $this->parser_lex_config = $this->config->item('parser_lex');
        } else {
            $this->parser_lex_config = array();
        }
    }

    public function __get($variable) {

        $ci = & get_instance();

        if (isset($ci->$variable)) {
            return $ci->$variable;
        }

        return null;
    }

    public function _set_creator($object) {

        $this->parser_lex_extensions = $object;
    }

    public function _set_path($path) {

        $this->parser_lex_path = $path;
    }

    public function _set_class($class) {

        $this->parser_lex_class = $class;
    }

    public function _set_method($method) {

        $this->parser_lex_method = $method;
    }

    public function _set_data($content, $attributes) {

        $content AND $this->parser_lex_content = $content;

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

            foreach ($attributes as $key => $value) {

                $value = (string) $value;

                if (
                    (strpos($value, '{{') !== false && strpos($value, '}}') !== false)
                    ||
                    (strpos($value, '[[') !== false && strpos($value, ']]') !== false)
                ) {

                    if ($parse_params) {

                        $this->load->parser();

                        $attribute_test = $this->parser->parse_string(
                            $value,
                            $this->parser_lex_extensions->options['data'],
                            true,
                            array(
                                'lex' => array(
                                    'cumulative_noparse' => false,
                                    'scope_glue' => $this->parser_lex_extensions->options['scope_glue'],
                                    'allow_php' => $this->parser_lex_extensions->options['allow_php'],
                                )
                            )
                        );

                    } else {

                        $attribute_test = $value;
                    }

                    // Check whether the attribute is probaly a single non-scalar value.
                    if (preg_match('/^(\{\{|\[\[)(.+)(\}\}|\]\])$/m', trim($attribute_test))) {

                        $attribute_test = trim($attribute_test, "[]{} \t\n\r\0\x0B");

                        if (isset($this->parser_lex_extensions->options['data'][$attribute_test])) {

                            // Assign the raw variable value.
                            $attributes[$key] = $this->parser_lex_extensions->options['data'][$attribute_test];

                        } else {

                            // Give up, leave the attribute as it is.
                            $attributes[$key] = $value;
                        }

                    } else {

                        // The parsed attribute likely represents a scalar value, assign it.
                        $attributes[$key] = $attribute_test;
                    }
                }
            }
        }

        $this->parser_lex_attributes = $attributes;
    }

    public function _get_content() {

        return $this->parser_lex_content;
    }

    public function _get_attributes() {

        return $this->parser_lex_attributes;
    }

    public function _get_attribute($attribute, $default = null) {

        return isset($this->parser_lex_attributes[$attribute]) ? $this->parser_lex_attributes[$attribute] : $default;
    }

    public function _set_attribute($attribute, $value) {

        $this->parser_lex_attributes[$attribute] = $value;
    }

}
