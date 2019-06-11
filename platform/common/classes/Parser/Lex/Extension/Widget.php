<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Widget extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function show() {

        $args = $this->get_attribute_values();

        ob_start();

        echo call_user_func_array(array('Modules', 'run'), $args);

        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    public function run() {

        $args = $this->get_attribute_values();

        // Return data directly.
        return call_user_func_array(array('Modules', 'run'), $args);
    }

}
