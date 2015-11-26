<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
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
