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

}
