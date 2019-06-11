<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Load the html helper too.
if (!function_exists('img')) {
    load_class('Loader', 'core')->helper('html');
}

if (!function_exists('display_user')) {

    function display_user($user_id, $photo_size = null, $attributes = null, $show_names = true, $show_title = true) {

        $ci = get_instance();
        $ci->load->model('users');
        $ci->load->model('user_photo');

        $user_id = (int) $user_id;

        $user = $ci->users->with_deleted()->get($user_id);

        if (empty($user)) {
            return null;
        }

        if ($photo_size !== false) {

            $photo_size = (int) $photo_size;

            if ($photo_size <= 0) {
                $photo_size = 32;
            }

            $attributes = _stringify_attributes($attributes);

            if (!$show_names && $show_title) {
                $attributes .= ' title="'.html_escape($user['first_name'].' '.$user['last_name'].' ('.$user['username'].')').'"';
            }

            $result = img($ci->user_photo->get($user, $photo_size), false, $attributes);

            if ($show_names) {
                $result .= ' '.$user['first_name'].' '.$user['last_name'].' ('.$user['username'].')';
            }

        } else {

            $result = $user['first_name'].' '.$user['last_name'].' ('.$user['username'].')';
        }

        return $result;
    }

}

if (!function_exists('display_user_photo')) {

    function display_user_photo($user_id, $photo_size = null, $attributes = null, $show_title = true) {

        return display_user($user_id, $photo_size, $attributes, false, $show_title);
    }

}

if (!function_exists('display_user_names')) {

    function display_user_names($user_id) {

        return display_user($user_id, false, null, false, false);
    }

}
