<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * @see https://github.com/pyrocms/lex
 */

// The character(s) used by Lex to trigger a scope change. A scope change is,
// for instance accessing a nested variable inside and array/object,
$config['scope_glue'] = ':';

// Sets the noparse style; FALSE - immediate, TRUE - cumulative.
$config['cumulative_noparse'] = false;


// Lex Parser Extensions

// A whitelist of constants that Lex parser can access.
$config['allowed_globals'] = array(
    'BASE_URL',
    'BASE_URI',
    'SERVER_URL',
    'SITE_URL',
    'SITE_URI',
    'CURRENT_SITE_URL',
    'CURRENT_SITE_URI',
    'CURRENT_URL',
    'CURRENT_URI',
    'CURRENT_URL_IS_HTTPS',
    'CURRENT_URL_PROTOCOL',
    'CURRENT_URL_HOST',
    'CURRENT_URL_PORT',
    'CURRENT_URI_STRING',
    'CURRENT_QUERY_STRING',
    'DEFAULT_BASE_URL',
    'DEFAULT_BASE_URI',
    'ASSET_URL',
    'ASSET_URI',
    'THEME_ASSET_URL',
    'THEME_ASSET_URI',
    'ASSET_IMG_URL',
    'ASSET_IMG_URI',
    'ASSET_JS_URL',
    'ASSET_JS_URI',
    'ASSET_CSS_URL',
    'ASSET_CSS_URI',
    'THEME_IMG_URL',
    'THEME_IMG_URI',
    'THEME_JS_URL',
    'THEME_JS_URI',
    'THEME_CSS_URL',
    'THEME_CSS_URI',
    'PUBLIC_UPLOAD_URL',
    'UA_IS_MOBILE',
    'UA_IS_ROBOT',
    'UA_IS_REFERRAL',
    'CI_VERSION',
    'PLATFORM_VERSION',
    'ENVIRONMENT',
);

// A whitelist of functions that Lex parser can execute.
$config['allowed_functions'] = array(
    'character_limiter',
    'count',
    'css_escape',       // Works as in Twig.
    'date',
    'empty',
    'explode',
    'gettype',
    'gmap_url',
    'highlight_phrase',
    'html_attr_escape', // Works as in Twig.
    'html_entity_decode',
    'html_escape',
    'htmlentities',
    'htmlspecialchars',
    'htmlspecialchars_decode',
    'humanize',
    'implode',
    'is_array',
    'is_bool',
    'is_boolean',
    'is_float',
    'is_https',
    'is_int',
    'is_integer',
    'is_null',
    'is_numeric',
    'is_object',
    'is_scalar',
    'is_string',
    'isset',
    'js_escape',        // Works as in Twig.
    'json_decode',
    'json_encode',
    'ltrim',
    'md5',
    'money_format',
    'nl2br',
    'number_format',
    'preg_match',
    'preg_match_all',
    'preg_replace',
    'print_d',
    'print_r',
    'rand_string',
    'rtrim',
    'safe_mailto',
    'slugify',
    'sha1',
    'sprintf',
    'str_replace',
    'strip_tags',
    'stripos',
    'strlen',
    'strpos',
    'strtolower',
    'strtoupper',
    'substr',
    'timespan',
    'trim',
    'ucfirst',
    'ucwords',
    'url_escape',       // Works as in Twig.
    'url_title',
    'var_dump',
    'var_export',
    'word_limiter',
    'word_wrap',        // CodeIgniter
    'wordwrap',         // PHP
    // Platform Routines
    'file_type_icon_fa',    // load file helper.
    'file_type_icon',       // load file helper.
);
