<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * See http://twig.sensiolabs.org/doc/api.html
 */

// Twig's 'debug' option.
$config['debug'] = ENVIRONMENT !== 'production';

// Character set used by the Twig template engine.
// NULL means config_item('charset'), i.e. the character set of the site.
$config['charset'] = null;

// Caching: An absolute path where to store the compiled templates,
// or FALSE to disable caching.
// The constant TWIG_CACHE contains the usual path for Twig cache.
// An alternative example: $config['cache'] = ENVIRONMENT === 'production' ? TWIG_CACHE : FALSE;
$config['cache'] = FALSE;

// The default timezone to be used by Twig.
$config['timezone'] = date_default_timezone_get();

// Extending the Twig parser: Load CodeIgniter helpers
// that serve implemented for Twig functions and filters.
$config['helpers'] = array(
    'asset',
    'date',
    'form',
    'gravatar',
    'inflector',
    'language_extra',
    'template',
    'text',
    'html',
    'url',
    'file',
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
    // Static Class Methods and Properties
    array('call_static', array('Parser_Twig_Extension_Static', 'call_static')),
    array('get_static', array('Parser_Twig_Extension_Static', 'get_static')),
    // Debugging Previews
    array('print_d', 'print_d', array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    array('print_r', array('Parser_Twig_Extension_Debug', 'print_r'), array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    array('var_export', array('Parser_Twig_Extension_Debug', 'var_export'), array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    // PHP
    array('mt_rand', 'mt_rand', array('is_safe' => array('html'))),
    array('rand', 'mt_rand', array('is_safe' => array('html'))),
    'file_exists',
    // CodeIgniter's Helpers
    array('is_https', 'is_https', array('is_safe' => array('html'))),
    array('is_php', 'is_php', array('is_safe' => array('html'))),
    // Session
    array('session', array('Parser_Twig_Extension_Session', 'session')),
    array('session_flash', array('Parser_Twig_Extension_Session', 'session_flash')),
    array('session_temp', array('Parser_Twig_Extension_Session', 'session_temp')),
    // Configuration, Settings
    array('config', array('Parser_Twig_Extension_Setting', 'config')),
    array('setting', array('Parser_Twig_Extension_Setting', 'setting')),
    // Platform Routines
    array('captcha', array('Parser_Twig_Extension_Platform', 'captcha')),
    array('current_user', array('Parser_Twig_Extension_Platform', 'current_user')),
    array('gravatar', 'gravatar', array('is_safe' => array('html'))),
    array('html_attr', 'html_attr', array('is_safe' => array('html'))),
    array('html_attr_*', array('Parser_Twig_Extension_Html', 'html_attr_functions'), array('is_safe' => array('html'))),
    array('registry', array('Parser_Twig_Extension_Platform', 'registry')),
    array('thumbnail', 'thumbnail', array('is_safe' => array('html'))),
    'url',
    'url_add_data_language',
    array('view', array('Parser_Twig_Extension_Platform', 'view'), array('is_safe' => array('html'))),
    array('file_type_icon_fa', 'file_type_icon_fa', array('is_safe' => array('html', 'html_attr', 'js'))),
    array('file_type_icon', 'file_type_icon', array('is_safe' => array('html', 'html_attr', 'js'))),
    // Web Assets
    array('css', array('Parser_Twig_Extension_Asset', 'css'), array('is_safe' => array('html'))),
    'css_path',
    'css_url',
    array('image', array('Parser_Twig_Extension_Asset', 'image'), array('is_safe' => array('html'))),
    'image_path',
    'image_url',
    array('js', array('Parser_Twig_Extension_Asset', 'js'), array('is_safe' => array('html'))),
    'js_path',
    'js_url',
    // Template
    array('body', array('Parser_Twig_Extension_Template', 'body'), array('is_safe' => array('html'))),
    array('file_partial', array('Parser_Twig_Extension_Template', 'file_partial'), array('is_safe' => array('html'))),
    array('partial', array('Parser_Twig_Extension_Template', 'partial'), array('is_safe' => array('html'))),
    array('has_partial', array('Parser_Twig_Extension_Template', 'has_partial'), array('is_safe' => array('html'))),
    array('html_title', array('Parser_Twig_Extension_Template', 'html_title'), array('is_safe' => array('html'))),
    array('metadata', array('Parser_Twig_Extension_Template', 'metadata'), array('is_safe' => array('html'))),
    array('html_begin', 'html_begin', array('is_safe' => array('html'))),
    array('html_end', 'html_end', array('is_safe' => array('html'))),
    array('head_begin', 'head_begin', array('is_safe' => array('html'))),
    array('head_end', 'head_end', array('is_safe' => array('html'))),
    array('body_begin', 'body_begin', array('is_safe' => array('html'))),
    array('body_end', 'body_end', array('is_safe' => array('html'))),
    array('meta_charset', 'meta_charset', array('is_safe' => array('html'))),
    array('base_href', 'base_href', array('is_safe' => array('html'))),
    array('ie_edge', 'ie_edge', array('is_safe' => array('html'))),
    array('viewport', 'viewport', array('is_safe' => array('html'))),
    array('favicon', 'favicon', array('is_safe' => array('html'))),
    array('apple_touch_icon', 'apple_touch_icon', array('is_safe' => array('html'))),
    array('apple_touch_icon_precomposed', 'apple_touch_icon_precomposed', array('is_safe' => array('html'))),
    array('css_normalize', 'css_normalize', array('is_safe' => array('html'))),
    array('js_platform', 'js_platform', array('is_safe' => array('html'))),
    array('js_modernizr', 'js_modernizr', array('is_safe' => array('html'))),
    array('js_jquery', 'js_jquery', array('is_safe' => array('html'))),
    array('noscript', 'noscript', array('is_safe' => array('html'))),
    array('unsupported_browser', 'unsupported_browser', array('is_safe' => array('html'))),
    array('js_bp_plugins', 'js_bp_plugins', array('is_safe' => array('html'))),
    array('js_mbp_helper', 'js_mbp_helper', array('is_safe' => array('html'))),
    array('js_scale_fix_ios', 'js_scale_fix_ios', array('is_safe' => array('html'))),
    array('enable_oldie', 'template_enable_oldie', array('is_safe' => array('html'))),
    // Visual Themes
    array('theme_name', array('Parser_Twig_Extension_Theme', 'theme_name')),
    array('theme_css', 'theme_css', array('is_safe' => array('html'))),
    'theme_css_path',
    'theme_css_url',
    array('theme_image', 'theme_image', array('is_safe' => array('html'))),
    'theme_image_path',
    'theme_image_url',
    array('theme_js', 'theme_js', array('is_safe' => array('html'))),
    'theme_js_path',
    'theme_js_url',
    // URL/URI Handling
    array('current_url', array('Parser_Twig_Extension_Url', 'current_url')),
    array('current_uri', array('Parser_Twig_Extension_Url', 'current_uri')),
    array('uri_string', array('Parser_Twig_Extension_Url', 'uri_string')),
    array('query_string', array('Parser_Twig_Extension_Url', 'query_string')),
    array('url_get', array('Parser_Twig_Extension_Url', 'url_get')),
    'site_url',
    'site_uri',
    'base_url',
    'base_uri',
    'default_base_url',
    array('segment', array('Parser_Twig_Extension_Url', 'segment')),
    array('segments', array('Parser_Twig_Extension_Url', 'segments')),
    array('total_segments', array('Parser_Twig_Extension_Url', 'total_segments')),
    array('rsegment', array('Parser_Twig_Extension_Url', 'rsegment')),
    array('rsegments', array('Parser_Twig_Extension_Url', 'rsegments')),
    array('total_rsegments', array('Parser_Twig_Extension_Url', 'total_rsegments')),
    array('anchor', 'anchor', array('is_safe' => array('html'))),
    'redirect',
    'http_build_url',
    'http_build_query',
    // Language
    array('lang', array('Parser_Twig_Extension_Language', 'lang')),
    array('lang_get', array('Parser_Twig_Extension_Language', 'lang_get')),
    array('lang_current', array('Parser_Twig_Extension_Language', 'lang_current')),
    array('lang_code', array('Parser_Twig_Extension_Language', 'lang_code')),
    array('lang_direction', array('Parser_Twig_Extension_Language', 'lang_direction')),
    array('lang_uri_segment', array('Parser_Twig_Extension_Language', 'lang_uri_segment')),
    array('lang_current_uri_segment', array('Parser_Twig_Extension_Language', 'lang_current_uri_segment')),
    array('lang_name', array('Parser_Twig_Extension_Language', 'lang_name')),
    array('lang_name_en', array('Parser_Twig_Extension_Language', 'lang_name_en')),
    array('lang_flag', array('Parser_Twig_Extension_Language', 'lang_flag')),
    array('lang_enabled', array('Parser_Twig_Extension_Language', 'lang_enabled')),
    array('is_multilingual', array('Parser_Twig_Extension_Language', 'is_multilingual')),
    array('language_*', array('Parser_Twig_Extension_Language', 'language_extra_helpers'), array('is_safe' => array('html'))),
    // Widgets
    array('widget', array('Parser_Twig_Extension_Widget', 'widget'), array('is_safe' => array('html'))),
    array('run', array('Parser_Twig_Extension_Widget', 'run'), array('is_safe' => array('html'))),
    // Forms
    array('form_*', array('Parser_Twig_Extension_Form', 'form_functions'), array('is_safe' => array('html'))),
    array('has_validation_error', 'has_validation_error', array('is_safe' => array('html'))),
    array('build_validation_message', 'build_validation_message', array('is_safe' => array('html'))),
    array('validation_errors', 'validation_errors', array('is_safe' => array('html'))),
    array('validation_errors_array', 'validation_errors_array', array('is_safe' => array('html'))),
    array('set_value', 'set_value', array('is_safe' => array('html'))),
    array('set_select', 'set_select', array('is_safe' => array('html'))),
    array('set_checkbox', 'set_checkbox', array('is_safe' => array('html'))),
    array('set_radio', 'set_radio', array('is_safe' => array('html'))),
);

// Extending the Twig parser: Extra-filters.
$config['filters'] = array(
    // Type Casting
    array('boolean', array('Parser_Twig_Extension_TypeCasting', 'boolean'), array('is_safe' => array('html'))),
    array('bool', array('Parser_Twig_Extension_TypeCasting', 'boolean'), array('is_safe' => array('html'))),
    array('integer', array('Parser_Twig_Extension_TypeCasting', 'integer'), array('is_safe' => array('html'))),
    array('int', array('Parser_Twig_Extension_TypeCasting', 'integer'), array('is_safe' => array('html'))),
    array('float', array('Parser_Twig_Extension_TypeCasting', 'float'), array('is_safe' => array('html'))),
    array('double', array('Parser_Twig_Extension_TypeCasting', 'float'), array('is_safe' => array('html'))),
    array('real', array('Parser_Twig_Extension_TypeCasting', 'float'), array('is_safe' => array('html'))),
    array('string', array('Parser_Twig_Extension_TypeCasting', 'string')),
    array('array', array('Parser_Twig_Extension_TypeCasting', 'twig_array')),
    array('object', array('Parser_Twig_Extension_TypeCasting', 'object')),
    array('null', array('Parser_Twig_Extension_TypeCasting', 'null'), array('is_safe' => array('html'))),
    // PHP Functions
    'base64_decode',
    array('base64_encode', 'base64_encode', array('is_safe' => array('html', 'html_attr', 'js'))),
    array('count', 'count', array('is_safe' => array('html'))),
    array('gettype', 'gettype', array('is_safe' => array('html'))),
    array('ltrim', array('Parser_Twig_Extension_Php', 'ltrim')),
    array('money_format', array('Parser_Twig_Extension_Php', 'money_format')),
    array('rtrim', array('Parser_Twig_Extension_Php', 'rtrim')),
    'sprintf',
    'str_repeat',
    array('stripos', 'stripos', array('is_safe' => array('html'))),
    array('strpos', 'strpos', array('is_safe' => array('html'))),
    array('wordwrap', array('Parser_Twig_Extension_Php', 'wordwrap')),
    array('array_plus', array('Parser_Twig_Extension_Php', 'array_plus')),
    array('array_replace', array('Parser_Twig_Extension_Php', 'array_replace')),
    // CodeIgniter's Helpers
    'character_limiter',
    'ellipsize',
    array('highlight_phrase', 'highlight_phrase', array('is_safe' => array('html'))),
    'humanize',
    array('mailto', 'mailto', array('is_safe' => array('html'))),
    array('safe_mailto', 'safe_mailto', array('is_safe' => array('html'))),
    array('auto_link', 'auto_link', array('is_safe' => array('html'))),
    array('timespan', array('Parser_Twig_Extension_DateTime', 'timespan')),
    'url_title',
    'word_limiter',
    'word_wrap',
    // Platform Routines
    'slugify',
    array('trim_html', 'trim_html', array('is_safe' => array('html'))),
    // HTML
    array('html_code', 'html_code', array('is_safe' => array('html'))),
    array('xss_clean', array('Parser_Twig_Extension_Html', 'xss_clean'), array('is_safe' => array('html'))),
    // Formatters, Parsers
    array('markdown', array('Parser_Twig_Extension_Format', 'markdown'), array('is_safe' => array('html'))),
    array('textile', array('Parser_Twig_Extension_Format', 'textile'), array('is_safe' => array('html'))),
    array('i18n', array('Parser_Twig_Extension_Format', 'i18n'), array('is_safe' => array('html'))),
);

// Extending the Twig parser: Extra-tests (is * operators).
$config['tests'] = array(
    array('array', 'is_array'),
    array('bool', 'is_bool'),
    array('boolean', 'is_bool'),
    array('float', 'is_float'),
    array('int', 'is_int'),
    array('integer', 'is_integer'),
    array('numeric', 'is_numeric'),
    array('object', 'is_object'),
    array('scalar', 'is_scalar'),
    array('string', 'is_string'),
    array('zero', array('Parser_Twig_Extension_Php', 'php_empty')),
);

// Sandbox Whitelists
// See http://twig.sensiolabs.org/doc/api.html#sandbox-extension

$config['sandbox_tags'] = array();

$config['sandbox_filters'] = array();

$config['sandbox_methods'] = array();

$config['sandbox_properties'] = array();

$config['sandbox_functions'] = array();
