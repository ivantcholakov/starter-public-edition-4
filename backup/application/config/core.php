<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Config File
 */

// Site Details
$config['site_version']          = "1.1.5";
$config['root_folder']           = "";    // set to whatever your webroot is (htdocs, public_html, etc.) - MAKE SURE you physically rename the /htdocs folder if you change this value!
$config['public_theme']          = "default";   // folder containing your public theme
$config['private_theme']         = "private";   // folder containing your public theme
$config['admin_theme']           = "modular";     // folder containing your admin theme

// Pagination
$config['num_links']             = 8;
$config['full_tag_open']         = "<div class=\"pagination\">";
$config['full_tag_close']        = "</div>";

// Login Attempts
$config['login_max_time']        = 10;          // in seconds
$config['login_max_attempts']    = 3;

// Miscellaneous
$config['profiler']              = FALSE;
$config['error_delimeter_left']  = "";
$config['error_delimeter_right'] = "<br />";
