<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

abstract class Parser_Lex_Extension {

    protected $attributes = array();
    protected $content = array();
    protected $parser_lex_config;
    protected $parser_lex_path;
    protected $parser_lex_class;
    protected $parser_lex_method;
    protected $parser_lex_extender;

    public function __construct() {

        $ci = & get_instance();

        $ci->load
            ->parser()
            ->library('parser_lex_extender');

        $this->parser_lex_extender = $ci->parser_lex_extender;

        if ($ci->config->load('parser_lex', TRUE, TRUE)) {
            $this->parser_lex_config = $ci->config->item('parser_lex');
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

    public function set_path($path) {

        $this->parser_lex_path = $path;
    }

    public function set_class($class) {

        $this->parser_lex_class = $class;
    }

    public function set_method($method) {

        $this->parser_lex_method = $method;
    }

    public function set_data($content, $attributes) {

        $content AND $this->content = $content;

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

            if ($parse_params) {

                foreach ($attributes as $key => $attr) {
                    $attributes[$key] = $this->parse_attribute($attr);
                }
            }

            $this->attributes = $attributes;
        }
    }

    public function content() {

        return $this->content;
    }

    public function attributes() {

        return $this->attributes;
    }

    public function attribute($attribute, $default = null) {

        return isset($this->attributes[$attribute]) ? $this->attributes[$attribute] : $default;
    }

    public function get_attribute($attribute, $default = null) {

        $attribute = $this->attribute($attribute, $default);

        return $this->parse_attribute($attribute);
    }

    public function parse_attribute($attribute) {

        // Parse variables, check for brackets.
        if (strpos($attribute, '[[') !== false) {

            $attribute = str_replace(array('[[', ']]'), array('{{', '}}'), $attribute);

            $ci = & get_instance();
;
            $parser = new \Lex\Parser;

            $parser->scopeGlue($ci->parser_lex_extender->options['scope_glue']);
            $parser->cumulativeNoparse($ci->parser_lex_extender->options['cumulative_noparse']);

            $attribute = $parser->parse($attribute,
                $ci->parser_lex_extender->options['data'],
                array($ci->parser_lex_extender, 'parser_callback'),
                $ci->parser_lex_extender->options['allow_php']
            );
        }

        return $attribute;
    }

    public function get_attributes($defaults = array()) {

        $attributes = $this->attributes();

        foreach ($attributes as $attribute => &$value) {

            $default = isset($defaults[$attribute]) ? $defaults[$attribute] : null;
            $value = $this->get_attribute($attribute);
        }

        return $attributes;
    }

    public function set_attribute($attribute, $value) {

        $this->attributes[$attribute] = $value;
    }

}
