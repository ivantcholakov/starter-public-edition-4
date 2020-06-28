<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Filesystem path to the disk cache location.
$config['cache'] = ENVIRONMENT === 'production' ? HANDLEBARS_CACHE : null;

// Cache file prefix, defaults to empty string.
$config['cache_file_prefix'] = '';

// Cache file extension, defaults to empty string.
$config['cache_file_suffix'] = '';

// A Handlebars template loader instance. Uses a StringLoader if not specified.
$config['loader'] = null;

// A Handlebars loader instance for partials. Uses a StringLoader if not specified.
$config['partials_loader'] = null;

// An array of alliases of partial names: [['initial_name' => 'alias'], ...]
// The loader for partials would try to locate them by aliases only, if defined.
$config['partials_alias'] = array();

// An array of helper functions. Normally a function like
// function ($sender, $name, $arguments), $arguments is unscaped arguments and
// is a string, not an array.
$config['helpers'] = null;

// A callable escape function to use.
$config['escape'] = 'htmlspecialchars';

// Parametes to pass to the escape function.
$config['escapeArgs'] = array(ENT_QUOTES, 'UTF-8');

// Enables @data variables (boolean, default: false).
$config['enableDataVariables'] = false;
