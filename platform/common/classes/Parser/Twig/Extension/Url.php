<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Url{

    public static function current_url() {

        return CURRENT_URL;
    }

    public static function current_uri() {

        return CURRENT_URI;
    }

    public static function uri_string() {

        return CURRENT_URI_STRING;
    }

    public static function query_string() {

        return CURRENT_QUERY_STRING;
    }

    public static function url_get($query_parameter = null) {

        $ci = & get_instance();

        return $ci->input->get($query_parameter);
    }

    public static function segment($index, $default = null) {

        $ci = & get_instance();

        return $ci->uri->segment($index, $default);
    }

    public static function segments() {

        $ci = & get_instance();

        return $ci->uri->segment_array();
    }

    public static function total_segments() {

        $ci = & get_instance();

        return $ci->uri->total_segments();
    }

    public static function rsegment($index, $default = null) {

        $ci = & get_instance();

        return $ci->uri->rsegment($index, $default);
    }

    public static function rsegments() {

        $ci = & get_instance();

        return $ci->uri->rsegment_array();
    }

    public static function total_rsegments() {

        $ci = & get_instance();

        return $ci->uri->total_rsegments();
    }

}
