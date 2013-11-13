<?php

// See Hack 4. Running CodeIgniter from the Command Line, http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/
// Sample usage: php cli.php "controller/method/parameter_1_key/parameter_1_value/parameter_2_key/parameter_2_value"

if (!((PHP_SAPI == 'cli') or defined('STDIN'))) {
    die('Command line only!');
}

$_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'] = $argv[1];

require dirname(__FILE__) . '/index.php';
