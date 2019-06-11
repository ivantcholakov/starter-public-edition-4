<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// The compiler's executable path.
// See https://github.com/postcss/autoprefixer
// Install it globally, for example on Ubuntu:
// sudo npm install --global postcss-cli autoprefixer
$config['postcss_path'] = 'postcss';

// A directory for storing temporary files.
$config['tmp_dir'] = TMP_PATH;

// Rules about selecting supported browsers.
// See https://github.com/ai/browserslist
// Examples:
// $config['browsers'] = array('last 2 versions', 'ie 6-8', 'Firefox > 20');
// $config['browsers'] = array('> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1')
$config['browsers'] = array('> 1%', 'last 2 versions', 'Firefox ESR');
