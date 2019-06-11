<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Html {

    public static function xss_clean($value) {

        $ci = & get_instance();

        return $ci->security->xss_clean($value);
    }

    public static function html_attr_functions() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $name = array_shift($args);

        return call_user_func_array('html_attr_'.$name, $args);
    }

}
