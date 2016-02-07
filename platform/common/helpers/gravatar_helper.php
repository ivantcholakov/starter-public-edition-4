<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('gravatar')) {

    // This helper function has been added here for compatibility with PyroCMS.
    function gravatar($email = '', $size = 50, $rating = 'g', $url_only = false, $default = false) {

        $ci = & get_instance();
        $ci->load->library('gravatar');

        if (@ (string) $default == '') {
            $default = null;
        }

        $gravatar_url = $ci->gravatar->get($email, $size, $default, null, $rating);

        if ($url_only) {
            return $gravatar_url;
        }

        return '<img src="'.$gravatar_url.'" alt="Gravatar" class="gravatar" />';
    }

}
