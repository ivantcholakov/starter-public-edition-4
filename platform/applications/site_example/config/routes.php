<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';

// Internationalization
// See https://github.com/EllisLab/CodeIgniter/wiki/CodeIgniter-2.1-internationalization-i18n

// URI like '/en/about' -> use controller 'about'
// An example: $route['^(en|de|fr|nl)/(.+)$'] = '$2';
$route['^(en|bg)/(.+)$'] = '$2';

// URI like '/en' -> use the default controller
// An example: $route['^(en|de|fr|nl)$'] = $route['default_controller'];
$route['^(en|bg)$'] = $route['default_controller'];
