<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('user_authorization_check_at_login')) {

    // This function is used by Current_user model.
    // The input parameter contains as an array data about the user that tries to login.
    // For authorized users this function should return TRUE, otherwise - FALSE.
    function user_authorization_check_at_login($user) {

        $group_id = (int) $user['group_id'];

        // 1 == Administrators.
        if ($group_id == 1) {
            return true;
        }

        return false;
    }

}
