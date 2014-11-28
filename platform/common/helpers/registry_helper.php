<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('registry')) {

    function registry($key) {

        $ci = get_instance();
        $ci->load->library('registry');

        return $ci->registry->get($key);
    }

}
