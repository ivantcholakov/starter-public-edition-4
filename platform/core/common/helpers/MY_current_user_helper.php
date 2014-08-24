<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('user_id_getter_for_models')) {

    // This function is used by 'User' model observes 'created_by' and 'updated_by'.
    // Don't reuse it for other purposes except for model observers!
    function user_id_getter_for_models() {

        return (int) get_instance()->current_user->id();
    }

}

if (!function_exists('user_authorization_check_at_login')) {

    // This function is used by Current_user model.
    // Adapt this function here or re-implement it according to your authorization system.
    // The authorization rules for the public site and for the administration panel
    // obviously are to be different.
    // The input parameter contains as an array data about the user that tries to login.
    // For authorized users this function should return TRUE, otherwise - FALSE.
    //
    // Example for the admin panel:
    //
    //function user_authorization_check_at_login($user) {
    //
    //    $group_id = (int) $user['group_id'];
    //
    //    // 1 == Administrators.
    //    if ($group_id == 1) {
    //        return true;
    //    }
    //
    //    return false;
    //}
    //
    // Example for the front/public site:
    //
    //function user_authorization_check_at_login($user) {
    //
    //    return true;
    //}

    function user_authorization_check_at_login($user) {

        return false;
    }

}
