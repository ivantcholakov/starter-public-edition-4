<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('country_flag')) {

    function country_flag($country_code) {

        static $cache = array();

        // Mostly a two letter ISO 3166-1 code is expected here.
        $country_code = (string) $country_code;

        if ($country_code == '') {
            return '_unknown';
        }

        if (strpos($country_code, '.') !== false) {
            return '_unknown';
        }

        if (isset($cache[$country_code])) {
            return $cache[$country_code] ? $country_code : '_unknown';
        }

        $cache[$country_code] = file_exists(DEFAULTFCPATH.'assets/img/lib/flags-iso/flat/32/'.$country_code.'.png');

        return $cache[$country_code] ? $country_code : '_unknown';
    }
}
