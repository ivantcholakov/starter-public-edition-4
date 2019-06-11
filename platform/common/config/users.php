<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$config['username_min_length'] = 2;
$config['username_max_length'] = 24;
$config['username_validator'] = '/^[A-Za-z][A-Za-z0-9\-_\.]*$/';
$config['password_min_length'] = 6;

$config['logout_destroys_session'] = true;
$config['logout_page_enabled'] = true;
$config['registration_enabled'] = true;

// For secret key generation see https://www.grc.com/passwords.htm
// Change the secret keys below on every new project/site.

$config['account_verification_enabled'] = true; // Verification by email message.
// Do not reuse the verification secret key else where!
$config['account_verification_secret'] = 'mxzJIRZn3FgR6SLebV0OvBu0nMGb9UIrsy5b0LWvkSi9NZWGdYMglO3DQd4OFPq';
$config['account_verification_expiration_time'] = 2000; // In seconds.

// Do not reuse the password reset salt else where!
$config['password_reset_secret'] = '2wuAevO3oZ3vlFIhLLQFTld4yvAo5dO9FYX75DwqwJhSEIlwInOsHWZljMB1BcB';
$config['password_reset_expiration_time'] = 1000;   // In seconds.

$config['autologin_enabled'] = false;
$config['autologin_database_table_name'] = 'autologin';
$config['autologin_cookie_name'] = 'autologin';
$config['autologin_expiration_time'] = 5184000; // In seconds.
$config['autologin_hash_algorithm'] = 'sha256';
// Do not reuse the following encryption key else where!
$config['encryption_key_for_autologin'] = 'fo9r0Rq1w48ut6nleLtjYAf7A4sow4T6xelDK4Ta0hcfXjLoXWA6b8abfO34LAx';
// If you have setup a crontab script for cleaning expired autologins,
// set $config['autologin_automatic_purge'] to FALSE.
$config['autologin_automatic_purge'] = true;

// Names/keys of the session variables that support user authentication.
$config['current_user_id_session_key'] = '_current_user_id';
$config['session_persistence_test_session_key'] = '_current_user_session_persistence_test';
$config['is_fully_authenticated_session_key'] = '_current_user_is_fully_authenticated';
$config['authentication_method_session_key'] = '_current_user_authentication_method';
