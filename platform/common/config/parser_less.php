<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

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

// Indentation characters for the output css content, if it is not to be compressed.
$config['indentation'] = '  ';

// For the full list of possible options see https://github.com/oyejorge/less.php
// Probably most of them should not be defined here, globally.
