<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['error[_-]logs'] = 'home';
$route['error[_-]logs/proxy/(:num)'] = 'proxy/index/$1';