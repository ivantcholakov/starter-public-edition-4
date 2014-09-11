<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$config['custom_user_photo_base_url'] = DEFAULT_BASE_URL.'userphotos/';
$config['custom_user_photo_base_path'] = PLATFORM_UPLOAD_PATH.'userphotos/';
$config['custom_user_photo_image_size'] = 80;               // px
$config['custom_user_photo_default_image'] = '';            // '', '404', 'mm', 'blank'.
$config['custom_user_photo_force_default_image'] = false;

$config['custom_user_photo_upload_types'] = 'png|jpg|jpeg|gif';
$config['custom_user_photo_upload_max_file_size'] = 512;    // KB
$config['custom_user_photo_upload_max_px_size'] = 500;      // px, max width and max weight
