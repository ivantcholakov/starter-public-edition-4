<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Lex_extensions {

    public function __construct() {

        $this->ci = & get_instance();

        $this->ci->load->library('lex_extender');
        $this->extender = $this->ci->lex_extender;
    }

    public function locate($name, $attributes, $content) {

        $scope_glue = $this->extender->get_scope_glue();

        if (strpos($name, $scope_glue) === false) {
            return false;
        }

    }

}
