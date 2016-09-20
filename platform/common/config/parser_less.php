<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Which compiler is to be used:
// 'less.php' - https://github.com/oyejorge/less.php
// 'less.js'  - https://github.com/less/less.js
//              Install less.js globally, for example on Ubuntu:
//              sudo npm install -g less
$config['implementation'] = 'less.php';

// For less.js - the compiler's executable path.
$config['lessc_path'] = 'lessc';

// A directory for storing temporary files.
$config['tmp_dir'] = TMP_PATH;

// Wether or not to compress the output css content.
$config['compress'] = FALSE;

// Turning off attempts to guess at the output unit when maths is to be done.
// When this option is on, the following example would be treated as an error:
// .class {
//   property: 1px * 2px; /* This is an area? There is no such feature in CSS. */
//   /* On $config['strictUnits'] = FALSE the property would be evaluated to 2px.
// }
$config['strictUnits'] = FALSE;

// URI root the be added as a suffix to relative URLs.
$config['uri_root'] = '';

// URI root the be added as a suffix to relative URLs.
$config['relativeUrls'] = TRUE;

// Indentation characters for the output css content, if it is not to be compressed.
$config['indentation'] = '  ';

// For the full list of possible options see https://github.com/oyejorge/less.php
// Probably most of them should not be defined here, globally.
