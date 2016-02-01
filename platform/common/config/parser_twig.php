<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Twig's 'debug' option.
$config['debug'] = ENVIRONMENT !== 'production';

// Character set used by the Twig template engine.
// NULL means config_item('charset'), i.e. the character set of the site.
$config['charset'] = null;

// Caching: An absolute path where to store the compiled templates,
// or false to disable caching (which is the default).
// Disable caching for now.
//$config['cache'] = TWIG_CACHE;
$config['cache'] = false;

// Extending the Twig parser: Load CodeIgniter helpers
// that serve implemented for Twig functions and filters.
$config['helpers'] = array(
    'text',
);

// Extending the Twig parser: Choose Twig extensions to be loaded.
$config['extensions'] = array(
    'Twig_Extension_StringLoader',
    array('Twig_Extension_Debug', ENVIRONMENT !== 'production'),
    array('Twig_Extensions_Extension_Text', false), // TRUE enables the corresponding extension.
    array('Twig_Extensions_Extension_I18n', false),
    array('Twig_Extensions_Extension_Intl', false),
    array('Twig_Extensions_Extension_Array', false),
    array('Twig_Extensions_Extension_Date', false),
);

// Extending the Twig parser: Extra-functions.
$config['functions'] = array(
    // Debugging Previews
    array('print_d', 'print_d', array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    array('print_r', array('Parser_Twig_Functions_Debug', 'print_r'), array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    array('var_export', array('Parser_Twig_Functions_Debug', 'var_export'), array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    // PHP Functions
    array('count', 'count', array('is_safe' => array('html'))),
    array('gettype', 'gettype', array('is_safe' => array('html'))),
    array('is_array', 'is_array', array('is_safe' => array('html'))),
    array('is_bool', 'is_bool', array('is_safe' => array('html'))),
    array('is_boolean', 'is_bool', array('is_safe' => array('html'))),
    array('is_float', 'is_float', array('is_safe' => array('html'))),
    array('is_int', 'is_int', array('is_safe' => array('html'))),
    array('is_integer', 'is_integer', array('is_safe' => array('html'))),
    array('is_null', 'is_null', array('is_safe' => array('html'))),
    array('is_numeric', 'is_numeric', array('is_safe' => array('html'))),
    array('is_object', 'is_object', array('is_safe' => array('html'))),
    array('is_scalar', 'is_scalar', array('is_safe' => array('html'))),
    array('is_string', 'is_string', array('is_safe' => array('html'))),
    //CodeIgniter's Helpers
    'character_limiter',
);

// Extending the Twig parser: Extra-filters.
$config['filters'] = array(
    // Type Casting
    array('boolean', array('Parser_Twig_Filters_TypeCasting', 'boolean'), array('is_safe' => array('html'))),
    array('bool', array('Parser_Twig_Filters_TypeCasting', 'boolean'), array('is_safe' => array('html'))),
    array('integer', array('Parser_Twig_Filters_TypeCasting', 'integer'), array('is_safe' => array('html'))),
    array('int', array('Parser_Twig_Filters_TypeCasting', 'integer'), array('is_safe' => array('html'))),
    array('float', array('Parser_Twig_Filters_TypeCasting', 'float'), array('is_safe' => array('html'))),
    array('double', array('Parser_Twig_Filters_TypeCasting', 'float'), array('is_safe' => array('html'))),
    array('real', array('Parser_Twig_Filters_TypeCasting', 'float'), array('is_safe' => array('html'))),
    array('string', array('Parser_Twig_Filters_TypeCasting', 'string')),
    array('array', array('Parser_Twig_Filters_TypeCasting', 'twig_array')),
    array('object', array('Parser_Twig_Filters_TypeCasting', 'object')),
    array('null', array('Parser_Twig_Filters_TypeCasting', 'null'), array('is_safe' => array('html'))),
);
