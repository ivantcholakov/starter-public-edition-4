<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$config['less_compile'] = array(

    array(
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap.css',
        'compress' => false
    ),
    array(
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap.min.css',
        'compress' => true
    ),

    array(
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/theme.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-theme.css',
        'compress' => false
    ),
    array(
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/theme.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-theme.min.css',
        'compress' => true
    ),

    array(
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-4/font-awesome.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-4/font-awesome.css',
        'compress' => false
    ),
    array(
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-4/font-awesome.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-4/font-awesome.min.css',
        'compress' => true
    ),

);
