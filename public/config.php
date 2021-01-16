<?php

$PLATFORMPATH = dirname(__FILE__).'/../platform';

$DEFAULTAPPNAME = 'front';
$DEFAULTFCPATH = dirname(__FILE__);

if (!isset($APPNAME)) {
    $APPNAME = $DEFAULTAPPNAME;
}

if (!isset($FCPATH)) {
    $FCPATH = $DEFAULTFCPATH;
}

if (!isset($SELF)) {
    $SELF = 'index.php';
}

$PLATFORMRUN = $PLATFORMPATH.'/bootstrap/run.php';
$PLATFORMCREATE = $PLATFORMPATH.'/bootstrap/create.php';
$PLATFORMDESTROY = $PLATFORMPATH.'/bootstrap/destroy.php';

if (!defined('ENVIRONMENT')) {
// Uncomment accordingly for enabling development/testing/production mode.
//    define('ENVIRONMENT', 'development');
//    define('ENVIRONMENT', 'testing');
    define('ENVIRONMENT', 'production');
}

// Uncomment if it is necessary.
// You need to know what you doing here:
// http://php.net/manual/en/function.umask.php
//umask(0002);
