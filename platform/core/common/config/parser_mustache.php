<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$config['base_dir'] = array(
    APPPATH.'views/mustache/',
    COMMONPATH.'views/mustache/',
);
$config['extension'] = '.mustache';
$config['cache'] = MUSTACHE_CACHE;
$config['cache_file_mode'] = FILE_WRITE_MODE;
$config['charset'] = 'UTF-8';
$config['entityFlags'] = ENT_COMPAT;
