<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Session {

    public static function session() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $ci = & get_instance();

        $name = $args[0];

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        if (count($args) == 1) {

            if ($ci->parser->is_blacklisted_session_variable($name)) {
                return;
            }

            return $ci->session->userdata($name);
        }

        if ($ci->parser->is_blacklisted_session_variable($name) || $ci->parser->is_read_only_session_variable($name)) {
            return;
        }

        $ci->session->set_userdata($name,  $args[1]);

        return;
    }

    public static function session_flash() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $ci = & get_instance();

        $name = $args[0];

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        if (count($args) == 1) {

            if ($ci->parser->is_blacklisted_session_variable($name)) {
                return;
            }

            return $ci->session->flashdata($name);
        }

        if ($ci->parser->is_blacklisted_session_variable($name) || $ci->parser->is_read_only_session_variable($name)) {
            return;
        }

        $ci->session->set_flashdata($name,  $args[1]);

        return;
    }

    public static function session_temp() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $ci = & get_instance();

        $name = $args[0];

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        if (count($args) == 1) {

            if ($ci->parser->is_blacklisted_session_variable($name)) {
                return;
            }

            return $ci->session->tempdata($name);
        }

        if ($ci->parser->is_blacklisted_session_variable($name) || $ci->parser->is_read_only_session_variable($name)) {
            return;
        }

        $ttl = isset($args[2]) ? ($args[2] != '' && is_numeric($args[2]) ? $args[2] : 300) : 300;

        $ci->session->set_tempdata($name,  $args[1], $ttl);

        return;
    }

}
