<?php

// See Hack 4. Running CodeIgniter from the Command Line, http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/
// Sample usage: php cli.php "controller/method/parameter_1_key/parameter_1_value/parameter_2_key/parameter_2_value"

if (!((PHP_SAPI == 'cli') || defined('STDIN'))) {
    die('Command line only!');
}

// Added by Ivan Tcholakov, 04-JUN-2020.
// A fix about the language segment for command-line interface.

$languages = array('bg', 'en', 'de', 'es', 'es-419', 'fr', 'it', 'pt', 'pt-br', 'ru', 'nl', 'tr', 'sq', 'ar', 'bs', 'el', 'da', 'et', 'ga', 'is', 'lv', 'lt', 'mk', 'no', 'pl', 'ro', 'sk', 'sl', 'sr', 'uk', 'hu', 'fi', 'hr', 'cs', 'sv', 'id', 'ja', 'ko', 'fa', 'zh-cn', 'th', 'zh-tw', 'ca', 'fil', 'gu', 'km', 'ta', 'ur', 'hi', 'az');
$default_cli_language = 'en';
$argv_1 = explode('/', isset($argv[1]) ? $argv[1] : '');

if (!isset($argv_1[0])) {
    $argv_1[0] = '';
}

if (!in_array($argv_1[0], $languages)) {
    $argv[1] = $default_cli_language.($argv_1[0] != '' ? '/'.$argv_1[0] : '').(isset($argv[1]) ? $argv[1] : ''); // Insert the language segment.
}

unset($languages);
unset($default_cli_language);
unset($argv_1);

//

$_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'] = (isset($argv[1]) ? $argv[1] : '');

require dirname(__FILE__) . '/index.php';
