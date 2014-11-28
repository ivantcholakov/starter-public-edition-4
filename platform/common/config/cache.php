<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Output Caching (Web Page Caching)
|--------------------------------------------------------------------------
|
| If you want to use these settings you may autoload this configuration
| file (see autoload.php, $autoload['config']) or load it on demand.
|
| For caching certain pages put within the corresponding controllers the
| following piece of code:
| if (config_item('cache_output')) {
|     $this->output->cache(config_item('cache_output_minutes'));
| }
|
| The boolean setting 'cache_output' enables/disables caching.
| The setting 'cache_output_minutes' is the number of minutes you wish the page
| to remain cached between refreshes.
| 
| The folder platform/writable/cache should be writable.
|
*/
$config['cache_output'] = false; // true - enable, false - disable html output caching.
$config['cache_output_minutes'] = 6 * 60;  // Hold cached output for 6 hours.
