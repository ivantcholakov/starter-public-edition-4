<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// See https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port

$config['raise_php_limits'] = TRUE;
$config['memory_limit'] = '128M';
$config['max_execution_time'] = 60;
$config['pcre_backtrack_limit'] = 1000 * 1000;
$config['pcre_recursion_limit'] = 500 * 1000;
