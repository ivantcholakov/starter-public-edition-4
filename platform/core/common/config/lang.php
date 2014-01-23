<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Hides language segment for default language.
$config['hide_default_uri_segment'] = true;

// Declare the default language within config.php.
// It should be one of the enabled languages.

$config['enabled_languages'] = array(
    'english',
);

// For language codes refer to CLDR.

$config['languages'] = array(

    'bulgarian' => array(
        'code' => 'bg',
        'direction' => 'ltr',   // This is the value by default, you may omit it.
        'uri_segment' => 'bg',  // If this value == value[code], you may omit it.
    ),

    'english' => array(
        'code' => 'en',
    ),

);
