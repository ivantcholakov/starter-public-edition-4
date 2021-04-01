<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Javascript LESS compiler is to be used, called internaly through CLI.
// 'less.js'  - https://github.com/less/less.js
//              Install less.js globally, for example on Ubuntu:
//              sudo npm install -g less

// See http://lesscss.org/usage/#command-line-usage

// For less.js - the compiler's executable path.
$config['lessc_path'] = 'lessc';

// A directory for storing temporary files.
$config['tmp_dir'] = TMP_PATH;

// Turning off attempts to guess at the output unit when maths is to be done.
// When this option is on, the following example would be treated as an error:
// .class {
//   property: 1px * 2px; /* This is an area? There is no such feature in CSS. */
        //   /* On $config['strict_units'] = FALSE the property would be evaluated to 2px. */
// }
$config['strict_units'] = false;

// Allows you to add a path to every generated import and url in your css.
// This does not affect Less import statements that are processed,
// just ones that are left in the output css.
$config['rootpath'] = '';

// Indentation characters for the output css content, if it is not to be compressed.
$config['indentation'] = '  ';

// If the file in an @import rule does not exist at that exact location, Less will
// look for it at the location(s) passed to this option. You might use this for instance
// to specify a path to a library which you want to be referenced simply and relatively
// in the Less files.
$config['include_path'] = [];

// By default URLs are kept as-is (off), so if you import a file in a sub-directory
// that references an image, exactly the same URL will be output in the css.
// This option allows you to rewrite URLs in imported files so that the URL is always
// relative to the base file that has been passed to Less.
$config['rewrite_urls'] = 'off';

// The for options available for math are:
// - always (current default) - Less eagerly does math
// - parens-division (future default) - No division is performed outside of parens
// using / operator (but can be "forced" outside of parens with ./ operator)
// - parens | strict - A more intuitive form of legacy strictMath: true
// - strict-legacy (deprecated) - As named, operates exactly like current strictMath:
// true, with the exception that width: -(1); (single dimension values in parens)
// will now output width: -1; vs previous behavior of width: -(1)
$config['math'] = 'always';

// This option defines a variable that can be referenced by the file. Effectively
// the declaration is put at the top of your base Less file, meaning it can be used
// but it also can be overridden if this variable is defined in the file.
$config['global_var'] = '';

// As opposed to the global variable option, this puts the declaration at the end
// of your base file, meaning it will override anything defined in your Less file.
$config['modify_var'] = '';

// This option allows you to specify a argument to go on to every URL. This may be
// used for cache-busting for instance.
$config['url_args'] = '';

// Be verbose.
$config['verbose'] = false;

// Enable inline JavaScript.
$config['javascript_enabled'] = false;
