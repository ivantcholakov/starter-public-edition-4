<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Debug {

    public static function print_r($value) {

        return print_r($value, true);
    }

    public static function var_export($value) {

        return var_export($value, true);
    }

}
