<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Php {

    public static function money_format($number, $format) {

        return money_format($format, $number);
    }

    public static function ltrim() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'ltrim'), $args)
            : call_user_func_array('ltrim', $args);
    }

    public static function rtrim() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'rtrim'), $args)
            : call_user_func_array('rtrim', $args);
    }

}
