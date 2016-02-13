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

// The default timezone to be used by Twig.
$config['timezone'] = date_default_timezone_get();

// Extending the Twig parser: Load CodeIgniter helpers
// that serve implemented for Twig functions and filters.
$config['helpers'] = array(
    'asset',
    'date',
    'gravatar',
    'inflector',
    'template',
    'text',
    'url',
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
    array('print_r', array('Parser_Twig_Extension_Debug', 'print_r'), array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    array('var_export', array('Parser_Twig_Extension_Debug', 'var_export'), array('is_safe' => array('html')), ENVIRONMENT !== 'production'),
    // CodeIgniter's Helpers
    array('is_https', 'is_https', array('is_safe' => array('html'))),
    // Session
    array('session', array('Parser_Twig_Extension_Session', 'session')),
    array('session_flash', array('Parser_Twig_Extension_Session', 'session_flash')),
    array('session_temp', array('Parser_Twig_Extension_Session', 'session_temp')),
    // Configuration, Settings
    array('config', array('Parser_Twig_Extension_Setting', 'config')),
    array('setting', array('Parser_Twig_Extension_Setting', 'setting')),
    // Platform Routines
    array('gravatar', 'gravatar', array('is_safe' => array('html'))),
    array('my_image_url', array('Parser_Twig_Extension_Platform', 'my_image_url'), array('is_safe' => array('html'))),
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
    array('html_begin', 'html_tag_no_conflict', array('is_safe' => array('html'))),
    array('html_end', 'html_close_tag', array('is_safe' => array('html'))),
    array('head_begin', 'head_tag', array('is_safe' => array('html'))),
    array('head_end', 'head_close_tag', array('is_safe' => array('html'))),
    array('body_begin', 'body_tag', array('is_safe' => array('html'))),
    array('body_end', 'body_close_tag', array('is_safe' => array('html'))),
    array('meta_charset', 'meta_charset', array('is_safe' => array('html'))),
    array('base_href', 'base_href', array('is_safe' => array('html'))),
    array('ie_edge', 'ie_edge', array('is_safe' => array('html'))),
    array('viewport', 'viewport', array('is_safe' => array('html'))),
    array('favicon', 'favicon', array('is_safe' => array('html'))),
    array('apple_touch_icon', 'apple_touch_icon', array('is_safe' => array('html'))),
    array('apple_touch_icon_precomposed', 'apple_touch_icon_precomposed', array('is_safe' => array('html'))),
    array('cleartype_ie', 'cleartype_ie', array('is_safe' => array('html'))),
    array('css_normalize', 'css_normalize', array('is_safe' => array('html'))),
    array('js_platform', 'js_platform', array('is_safe' => array('html'))),
    array('js_selectivizr', 'js_selectivizr', array('is_safe' => array('html'))),
    array('js_modernizr', 'js_modernizr', array('is_safe' => array('html'))),
    array('js_respond', 'js_respond', array('is_safe' => array('html'))),
    array('js_jquery', 'js_jquery', array('is_safe' => array('html'))),
    array('noscript', 'noscript', array('is_safe' => array('html'))),
    array('unsupported_browser', 'unsupported_browser', array('is_safe' => array('html'))),
    array('js_jquery_extra_selectors', 'js_jquery_extra_selectors', array('is_safe' => array('html'))),
    array('js_bp_plugins', 'js_bp_plugins', array('is_safe' => array('html'))),
    array('js_mbp_helper', 'js_mbp_helper', array('is_safe' => array('html'))),
    array('js_scale_fix_ios', 'js_scale_fix_ios', array('is_safe' => array('html'))),
    array('js_imgsizer', 'js_imgsizer', array('is_safe' => array('html'))),
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
    // Widgets
    array('widget', array('Parser_Twig_Extension_Widget', 'widget'), array('is_safe' => array('html'))),
    array('run', array('Parser_Twig_Extension_Widget', 'run'), array('is_safe' => array('html'))),
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
    array('count', 'count', array('is_safe' => array('html'))),
    array('gettype', 'gettype', array('is_safe' => array('html'))),
    array('ltrim', array('Parser_Twig_Extension_Php', 'ltrim')),
    array('money_format', array('Parser_Twig_Extension_Php', 'money_format')),
    array('rtrim', array('Parser_Twig_Extension_Php', 'rtrim')),
    'sprintf',
    array('stripos', 'stripos', array('is_safe' => array('html'))),
    array('strpos', 'strpos', array('is_safe' => array('html'))),
    array('wordwrap', array('Parser_Twig_Extension_Php', 'wordwrap')),
    // CodeIgniter's Helpers
    'character_limiter',
    'ellipsize',
    array('highlight_phrase', 'highlight_phrase', array('is_safe' => array('html'))),
    'humanize',
    array('safe_mailto', 'safe_mailto', array('is_safe' => array('html', 'js'))),
    array('timespan', array('Parser_Twig_Extension_DateTime', 'timespan')),
    'url_title',
    'word_limiter',
    'word_wrap',
    // Platform Routines
    'slugify',
    // HTML
    array('html_code', 'html_code', array('is_safe' => array('html'))),
    array('xss_clean', array('Parser_Twig_Extension_Html', 'xss_clean'), array('is_safe' => array('html'))),
    // Formatters, Parsers
    array('markdown', array('Parser_Twig_Extension_Format', 'markdown'), array('is_safe' => array('html'))),
    array('textile', array('Parser_Twig_Extension_Format', 'textile'), array('is_safe' => array('html'))),
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
);
