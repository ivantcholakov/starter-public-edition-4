<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Asset Directory
|--------------------------------------------------------------------------
|
| Absolute path from the webroot to your asset root, WITH a trailing slash:
|
|    /assets/
|
*/

$config['asset_dir'] = BASE_URI.'assets/';

/*
|--------------------------------------------------------------------------
| Asset URL
|--------------------------------------------------------------------------
|
| URL to your asset root, WITH a trailing slash:
|
|    http://example.com/assets/
|
*/

$config['asset_url'] = BASE_URL.'assets/';

/*
|--------------------------------------------------------------------------
| Theme Asset Directory
|--------------------------------------------------------------------------
|
*/

$config['theme_asset_dir'] = BASE_URI.'themes/';

/*
|--------------------------------------------------------------------------
| Theme Asset URL
|--------------------------------------------------------------------------
|
*/

$config['theme_asset_url'] = BASE_URL.'themes/';

/*
|--------------------------------------------------------------------------
| Asset Sub-folders
|--------------------------------------------------------------------------
|
| Names for the img, js and css folders. Can be renamed to anything
|
|    images js css
|
*/
$config['asset_img_dir'] = 'img';
$config['asset_js_dir'] = 'js';
$config['asset_css_dir'] = 'css';

/*
|--------------------------------------------------------------------------
| Javascript Options
|--------------------------------------------------------------------------
|
| Options for helping debugging javascripts, for testing purposes only.
|
*/
$config['load_javascripts_from_source'] = false;

/*
|--------------------------------------------------------------------------
| Internet Explorer Support Options
|--------------------------------------------------------------------------
*/
$config['ie_min_supported_version'] = 6;    // 6, 7, 8, 9, 10, ...

/*
|--------------------------------------------------------------------------
| Enable Loading Assets Depending on User Agent Detection
|--------------------------------------------------------------------------
*/
$config['load_assets_by_ua_detection'] = true;  // or false
