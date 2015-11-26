<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/**
 * How to recompile these SCSS-sources:
 *
 * Open a terminal at the folder platform/www/ and write the following command:
 *
 * php cli.php scss compile
 *
 * If you want to compile only chosen sources, then write a command like this:
 *
 * php cli.php scss compile material-design-icons material-design-icons-min
 *
 * For all of the SCSS parser options ('formatter', etc.) see https://github.com/leafo/scssphp
 */

$config['scss_compile'] = array(

    // php cli.php scss compile material-design-icons material-design-icons-min

    array(
        'name' => 'material-design-icons',
        'source' => DEFAULTFCPATH.'assets/scss/lib/material-design-icons/material-icons.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-design-icons/material-icons.css',
        'formatter' => 'expanded'
    ),
    array(
        'name' => 'material-design-icons-min',
        'source' => DEFAULTFCPATH.'assets/scss/lib/material-design-icons/material-icons.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-design-icons/material-icons.min.css',
        'formatter' => 'compressed'
    ),
);
