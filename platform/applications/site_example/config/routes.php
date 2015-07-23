<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = 'error_404';

$route['sitemap.xml'] = 'sitemap/xml';

// Sample REST API routes
$route['playground/rest/server[-_]api[-_]example/users/(:num)'] = 'playground/rest/server_api_example/users/id/$1'; // Example 4
$route['playground/rest/server[-_]api[-_]example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'playground/rest/server_api_example/users/id/$1/format/$3$4'; // Example 8
