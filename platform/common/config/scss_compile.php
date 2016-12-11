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

    // php cli.php scss compile sweetalert sweetalert-min sweetalert-facebook sweetalert-facebook-min sweetalert-google sweetalert-google-min sweetalert-twitter sweetalert-twitter-min

    // php cli.php scss compile sweetalert sweetalert-min

    array(
        'name' => 'sweetalert',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.css',
        'formatter' => 'expanded'
    ),
    array(
        'name' => 'sweetalert-min',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.min.css',
        'formatter' => 'compressed'
    ),

    // php cli.php scss compile sweetalert-facebook sweetalert-facebook-min

    array(
        'name' => 'sweetalert-facebook',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.css',
        'formatter' => 'expanded'
    ),
    array(
        'name' => 'sweetalert-facebook-min',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.min.css',
        'formatter' => 'compressed'
    ),

    // php cli.php scss compile sweetalert-google sweetalert-google-min

    array(
        'name' => 'sweetalert-google',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.css',
        'formatter' => 'expanded'
    ),
    array(
        'name' => 'sweetalert-google-min',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.min.css',
        'formatter' => 'compressed'
    ),

    // php cli.php scss compile sweetalert-twitter sweetalert-twitter-min

    array(
        'name' => 'sweetalert-twitter',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.css',
        'formatter' => 'expanded'
    ),
    array(
        'name' => 'sweetalert-twitter-min',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.min.css',
        'formatter' => 'compressed'
    ),

);
