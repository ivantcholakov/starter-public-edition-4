<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Whether or not to flush stacked links after each paragraph.
// 0 - after content;
// 1 - after each paragraph;
// 2 - in paragraph.
$config['linkPosition'] = 0;

// Whether or not to wrap the output to the given width.
$config['bodyWidth'] = FALSE;

// Whether to keep non markdownable HTML or to discard it.
$config['keepHTML'] = FALSE;
