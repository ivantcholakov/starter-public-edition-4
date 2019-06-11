<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/*
|--------------------------------------------------------------------------
| Parsers Enabled
|--------------------------------------------------------------------------
|
| Should parsers be used for the entire page?
| Setting Type: array|false
| Example: $config['parser_enabled'] = false;
| Example: $config['parser_enabled'] = array('i18n');
|
*/

$config['parser_enabled'] = false;

/*
|--------------------------------------------------------------------------
| Parsers Enabled for Body
|--------------------------------------------------------------------------
|
| Should parsers be used for the body of the page?
| Setting Type: array|false
| Example: $config['parser_body_enabled'] = false;
| Example: $config['parser_body_enabled'] = array('i18n');
|
*/

$config['parser_body_enabled'] = false;

/*
|--------------------------------------------------------------------------
| Title Separator
|--------------------------------------------------------------------------
|
| What string should be used to separate title segments sent via $this->template->title('Foo', 'Bar');
|
|   Default: ' | '
|
*/

$config['title_separator'] = ' | ';

/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
|
| Which layout file should be used? When combined with theme it will be a layout file in that theme
|
| Change to 'main' to get /application/views/layouts/main.php
|
|   Default: 'default'
|
*/

$config['layout'] = 'default';

/*
|--------------------------------------------------------------------------
| Theme
|--------------------------------------------------------------------------
|
| Which theme to use by default?
|
| Can be overriden with $this->template->set_theme('foo');
|
|   Default: ''
|
*/

$config['theme'] = '';

/*
|--------------------------------------------------------------------------
| Theme Locations
|--------------------------------------------------------------------------
|
| Where should we expect to see themes?
|
|    Default: array(APPPATH.'themes/' => '../themes/')
|
*/

$config['theme_locations'] = array(
    APPPATH.'themes/'
);
