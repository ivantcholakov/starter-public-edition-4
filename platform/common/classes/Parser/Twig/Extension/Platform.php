<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Platform {

    public static function captcha() {

        $ci = & get_instance();

        return $ci->captcha;
    }

    public static function current_user() {

        $ci = & get_instance();

        return $ci->current_user;
    }

    public static function registry() {

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

            return $ci->registry->get($name);
        }

        $ci->registry->set($name,  $args[1]);

        return;
    }

    public static function view($view, $data = array(), $options = array()) {

        if (is_object($options)) {
            $options = get_object_vars($options);
        }

        $load = class_exists('CI') ? CI::$APP->load : get_instance()->load;

        return $load->view($view, $data, true, $options);
    }

}
