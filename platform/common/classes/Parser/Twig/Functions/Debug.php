<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Functions_Debug {

    public static function print_r($var) {

        return print_r($var, true);
    }

    public static function var_export($var) {

        return var_export($var, true);
    }

}
