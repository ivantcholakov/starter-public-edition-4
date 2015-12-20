<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
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

// A whitelist of functions that Lex parser can execute.
$config['allowed_functions'] = array(
    'character_limiter',
    'count',
    'empty',
    'explode',
    'html_entity_decode',
    'html_escape',
    'htmlentities',
    'htmlspecialchars',
    'htmlspecialchars_decode',
    'humanize',
    'implode',
    'is_array',
    'is_int',
    'is_integer',
    'is_string',
    'isset',
    'ltrim',
    'md5',
    'money_format',
    'nl2br',
    'number_format',
    'preg_match',
    'preg_replace',
    'rand_string',
    'rtrim',
    'safe_mailto',
    'slugify',
    'sprintf',
    'str_replace',
    'str_word_count',
    'strip_tags',
    'strpos',
    'strtolower',
    'strtoupper',
    'substr',
    'trim',
    'ucfirst',
    'ucwords',
    'word_censor',
    'word_limiter',
    'word_wrap',
);
