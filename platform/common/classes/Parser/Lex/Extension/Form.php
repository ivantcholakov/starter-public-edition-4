<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Form extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    // form_*() functions: form_open(), form_close(), etc.
    public function __call($name, $arguments) {

        if (!in_array($name, array(
            'has_validation_error',
            'build_validation_message',
            'validation_errors',
            'validation_errors_array',
            'set_value',
            'set_select',
            'set_checkbox',
            'set_radio',
        ))) {

            $name = 'form_'.$name;
        }

        if (function_exists($name)) {

            $attributes = $this->get_attributes();

            return call_user_func_array($name, $attributes);
        }

        return $this->_function_not_found($name);
    }

}
