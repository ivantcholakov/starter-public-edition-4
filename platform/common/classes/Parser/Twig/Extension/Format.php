<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Format {

    public static function markdown($text) {

        $ci = & get_instance();

        return $ci->parser->parse_string(trim($text), null, true, 'markdown');
    }

    public static function textile($text) {

        $ci = & get_instance();

        return $ci->parser->parse_string(trim($text), null, true, 'textile');
    }

}
