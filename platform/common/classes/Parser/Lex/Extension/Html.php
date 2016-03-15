<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Html extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    // html_*() functions: html_attr(), html_attr_has(), etc.
    public function __call($name, $arguments) {

        $name = 'html_'.$name;

        if (function_exists($name)) {

            $attributes = $this->get_attributes();

            return call_user_func_array($name, $attributes);
        }

        return $this->_function_not_found($name);
    }

    public function escape() {

        return html_escape($this->get_attribute(0, $this->get_content()));
    }

    public function code() {

        return html_code($this->get_attribute(0, $this->get_content()));
    }

    public function xss_clean() {

        return $this->security->xss_clean($this->get_attribute(0, $this->get_content()));
    }

}
