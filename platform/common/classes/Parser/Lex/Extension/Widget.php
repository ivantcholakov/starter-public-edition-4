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
        $name = array_shift($args);

        if ($name === null) {
            return null;
        }

        ob_start();

        echo Modules::run($name, $args);

        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    public function run() {

        $args = $this->get_attribute_values();
        $name = array_shift($args);

        if ($name === null) {
            return null;
        }

        // Return data directly.
        return Modules::run($name, $args);
    }

}
