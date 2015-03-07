<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('settings')) {

    function settings($key) {

        $ci = get_instance();
        $ci->load->library('settings');

        return $ci->settings->get($key);
    }

}

if (!function_exists('settings_lang')) {

    function settings_lang($key, $language = null) {

        $ci = get_instance();
        $ci->load->library('settings');

        return $ci->settings->lang($key, $language);
    }

}
