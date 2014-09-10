<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['avatar/([a-zA-Z0-9\.\-_]+)'] = 'avatar/index/$1';
