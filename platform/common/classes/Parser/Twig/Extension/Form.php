<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Form {

    public static function form_functions() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $name = array_shift($args);

        if (count($args) > 0) {

            foreach ($args as & $arg) {

                if (is_object($arg)) {
                    $arg = get_object_vars($arg);
                }
            }
        }

        return call_user_func_array('form_'.$name, $args);
    }

}
