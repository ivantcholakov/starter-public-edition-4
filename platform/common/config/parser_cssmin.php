<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Which CSS minifier is to be used:
// 'yui_css_compressor' - https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port
// 'cssnano'            - http://cssnano.co
$config['implementation'] = 'yui_css_compressor';

// Options for 'yui_css_compressor':

$config['raise_php_limits'] = TRUE;
$config['memory_limit'] = '128M';
$config['max_execution_time'] = 60;
$config['pcre_backtrack_limit'] = 1000 * 1000;
$config['pcre_recursion_limit'] = 500 * 1000;

// Options for 'cssnano':

// The compiler's executable path.
// Install cssnano and postcss-cli globally, for example on Ubuntu:
// sudo npm install --global postcss-cli cssnano
$config['postcss_path'] = 'postcss';

// A directory for storing temporary files.
$config['tmp_dir'] = TMP_PATH;

// Set this to true to disable advanced optimisations that are not always safe.
$config['safe'] = TRUE;
