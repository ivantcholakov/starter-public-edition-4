<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Theme {

    public static function theme_name() {

        $ci = & get_instance();

        $ci->load->library('template');

        return $ci->template->get_theme();
    }

}
