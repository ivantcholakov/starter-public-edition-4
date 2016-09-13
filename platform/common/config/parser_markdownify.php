<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Wether or not to flush stacked links after each paragraph.
// 0 - after content;
// 1 - after each paragraph;
// 2 - in paragraph.
$config['linkPosition'] = 0;

// Wether or not to wrap the output to the given width.
$config['bodyWidth'] = FALSE;

// Wether to keep non markdownable HTML or to discard it.
$config['keepHTML'] = FALSE;
