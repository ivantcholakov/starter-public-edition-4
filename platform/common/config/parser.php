<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Common Parser Settings
// Note: Settings for specific parser drivers are defined
// within configuration files parser_*.php

// The driver to be auto-loaded: "parser" driver (default)
$config['parser_driver'] = 'parser';

// Additional valid drivers that may be loaded.
$config['parser_valid_drivers'] = array(
    'twig',
    'handlebars',
    'mustache',
    'lex',
    'parser',
    'textile',
    'markdown',
    'markdownify',
    'auto_link',
    'i18n',
    'less',
    'smileys',
    'cssmin',
    'jsmin',
    'scss',
    'ts',
    'jsonmin',
    'autoprefixer',
);

// File extensions associated with parsers that are to be applied
// to views, partials, layouts.
// Don't add leading dots on specifying file extensions.
$config['parser_file_extensions'] = array(
    'twig' => array('twig', 'html.twig'),
    'handlebars' => array('handlebars', 'hbs'),
    'mustache' => array('mustache.html', 'mustache'),
    'lex' => array('lex.html', 'lex'),
    'parser' => array('parser.php'),
    'markdown' => array('md', 'markdown', 'fbmd'),
    'textile' => 'textile',
);

// A blacklist of configuration settings that a parser should not access
// when a parsed template contains a directive for that.
// Matching is done by a regular expression, setting keys that contain
// at least one of the enumerated strings below are disabled.
$config['parser_config_settings_balcklist'] = array(

    // Common
    'password',
    'encryption',

    // Speciric
    'uri_protocol',
    'url_suffix',
    'enable_hooks',
    'subclass_prefix',
    'composer_autoload',
    'permitted_uri_chars',
    'allow_get_array',
    'enable_query_strings',
    'controller_trigger',
    'function_trigger',
    'directory_trigger',
    'log_threshold',
    'log_path',
    'log_file_extension',
    'log_file_permissions',
    'log_date_format',
    'error_views_path',
    'cache_path',
    'cache_query_string',
    'encryption_key',
    'encryption_key_256',
    'encryption_key_for_settings',
    'sess_driver',
    'sess_cookie_name',
    'sess_expiration',
    'sess_save_path',
    'sess_match_ip',
    'sess_time_to_update',
    'sess_regenerate_destroy',
    'standardize_newlines',
    'global_xss_filtering',
    'csrf_protection',
    'csrf_token_name',
    'csrf_cookie_name',
    'csrf_expire',
    'csrf_regenerate',
    'csrf_exclude_uris',
    'rewrite_short_tags',
    'proxy_ips',
    'controller_suffix',
    'modules_locations',
    'public_upload_path',
    'platform_upload_path',
);

// A blacklist of session variables that a parser should not read or write
// when a parsed template contains a directive for that.
// Matching of keys is done exactly.
$config['parser_session_balcklist'] = array(
    'session_id',
    'ip_address',
);

// A list of session variables that a parser should not write
// when a parsed template contains a directive for that.
// Matching of keys is done exactly.
$config['parser_session_read_only'] = array(
    'id',
    'user_id',
    'group_id',
    'group',
    'username',
    'email',
);
