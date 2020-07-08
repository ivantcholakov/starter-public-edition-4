<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Which CSS minifier is to be used:
// 'cssnano'            - http://cssnano.co
// 'minifycss'          - https://github.com/matthiasmullie/minify
$config['implementation'] = 'cssnano';

// Options for 'cssnano':

// The compiler's executable path.
// Install cssnano and postcss-cli globally, for example on Ubuntu:
// sudo npm install --global postcss-cli cssnano
$config['postcss_path'] = 'postcss';

// A directory for storing temporary files.
$config['tmp_dir'] = TMP_PATH;

// Set this to true to disable advanced optimisations that are not always safe.
$config['safe'] = TRUE;
