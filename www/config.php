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

$PLATFORMRUN = $PLATFORMPATH.'/run.php';
$PLATFORMCREATE = $PLATFORMPATH.'/create.php';
$PLATFORMDESTROY = $PLATFORMPATH.'/destroy.php';

// Uncomment for enabling production mode.
//if (!defined('ENVIRONMENT')) {
//    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');
//}

// Uncomment if it is necessary.
// You need to know what you diong here:
// http://php.net/manual/en/function.umask.php
//umask(0002);
