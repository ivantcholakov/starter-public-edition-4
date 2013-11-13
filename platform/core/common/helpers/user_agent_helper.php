<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * User Agent Helper Functions
 * Based on CodeIgniter's User_agent library.
 * These helpers have been made for the sake of convenience.
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */


// Common functions
//------------------------------------------------------------------------------

if (!function_exists('user_agent')) {

    /**
     * Returns all static user agent data.
     * @return  array
     */
    function user_agent() {

        static $result = null;

        if (!is_array($result)) {

            $ci = get_instance();
            $ci->load->library('user_agent');
            $agent = $ci->agent;

            $result['agent_string'] = $agent->agent_string();
            $result['platform'] = $agent->platform();
            $result['browser'] = $agent->browser();
            $result['version'] = $agent->version();
            $result['robot'] = $agent->robot();
            $result['mobile'] = $agent->mobile();
            $result['referrer'] = $agent->referrer();
            $result['is_referral'] = $agent->is_referral();
            $result['languages'] = $agent->languages();
            $result['charsets'] = $agent->charsets();
        }

        return $result;
    }

}

if (!function_exists('user_agent_is_browser')) {

    /**
     * Is it a browser of a particular type?
     * @param   string  $key
     * @return  bool
     */
    function user_agent_is_browser($key = NULL) {

        $ci = get_instance();
        $ci->load->library('user_agent');

        return $ci->agent->is_browser($key);
    }

}

if (!function_exists('user_agent_is_robot')) {

    /**
     * Is it a robot of a particular type?
     * @param   string  $key
     * @return  bool
     */
    function user_agent_is_robot($key = NULL) {

        $ci = get_instance();
        $ci->load->library('user_agent');

        return $ci->agent->is_robot($key);
    }

}

if (!function_exists('user_agent_is_mobile')) {

    /**
     * Is it a mobile device of a particular type?
     * @param   string  $key
     * @return  bool
     */
    function user_agent_is_mobile($key = NULL) {

        $ci = get_instance();
        $ci->load->library('user_agent');

        return $ci->agent->is_mobile($key);
    }

}

if (!function_exists('user_agent_accepts_language')) {

    /**
     * Tests for a particular language.
     * @param   string  $lang
     * @return  bool
     */
    function user_agent_accepts_language($lang = 'en') {

        $ci = get_instance();
        $ci->load->library('user_agent');

        return $ci->agent->accept_lang($lang);
    }

}

if (!function_exists('user_agent_accepts_charset')) {

    /**
     * Tests for a particular character set.
     * @param   string  $lang
     * @return  bool
     */
    function user_agent_accepts_charset($charset = 'utf-8') {

        $ci = get_instance();
        $ci->load->library('user_agent');

        return $ci->agent->accept_charset($charset);
    }

}


// Fuctions for targeting particular user agents
//------------------------------------------------------------------------------

if (!function_exists('user_agent_ie')) {

    /**
     * Retreives data about Internet Explorer.
     * This function is covenient about supporting old browsers (IE < 9),
     * for making adaptive html boilerplate.
     * @return  array
     */
    function user_agent_ie() {

        static $result = null;

        if (!is_array($result)) {

            $result = array(
                'is_ie' => false,
                'ie_version' => null,
                'is_ie_mobile' => false,
                'ie_mobile_version' => null,
            );

            $data = user_agent();

            $result['is_ie'] = $data['browser'] == 'Internet Explorer';

            if ($result['is_ie']) {

                $result['ie_version'] = (int) $data['version'];
                $result['is_ie_mobile'] = $data['mobile'] != '';

                if ($result['is_ie_mobile']) {

                    $result['ie_mobile_version'] = (int) $data['version'];

                    if ($result['ie_mobile_version'] == 7) {
                        $result['ie_version'] == 8;
                    }
                }
            }
        }

        return $result;
    }

}

if (!function_exists('user_agent_ios')) {

    /**
     * Detects iOS-native browsers.
     * This function is covenient for making adaptive html boilerplate.
     * @return  array
     */
    function user_agent_ios() {

        static $result = null;

        if (!is_array($result)) {

            $result = array(
                'is_ios' => false,
            );

            $data = user_agent();

            $result['is_ios'] = $data['platform'] == 'iOS';
        }

        return $result;
    }

}
