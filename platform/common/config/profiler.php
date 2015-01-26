<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|     http://codeigniter.com/user_guide/general/profiling.html
|
*/

$config['benchmarks'] = true;
// Disabled by Ivan Tcholakov, 21-OCT-2013.
// This section contains sensitive data that should not be exposed.
//$config['config'] = true;
$config['config'] = false;
//
$config['controller_info'] = true;
$config['get'] = true;
$config['http_headers'] = true;
$config['memory_usage'] = true;
$config['post'] = true;
$config['queries'] = true;
$config['uri_string'] = true;
$config['query_toggle_count'] = 25;
