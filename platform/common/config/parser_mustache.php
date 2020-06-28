<?php defined('BASEPATH') OR exit('No direct script access allowed');

// See https://github.com/bobthecow/mustache.php/wiki

// "The class prefix for compiled templates. Defaults to '__Mustache_'."
$config['template_class_prefix'] = '__Mustache_';

// "A Mustache Cache instance or cache directory for compiled templates.
// Mustache will not cache templates unless this is set."
$config['cache'] = ENVIRONMENT === 'production' ? MUSTACHE_CACHE : null;

// "Override default permissions for cache files. Defaults to using
// the system-defined umask. It is strongly recommended that you
// configure your umask properly rather than overriding permissions here."
$config['cache_file_mode'] = 0666;

// "Enable template caching for lambda sections. This is generally
// not recommended, as lambda sections are often too dynamic
// to benefit from caching."
$config['cache_lambda_templates'] = null;

// "A Mustache template loader instance. Uses a StringLoader if not specified."
$config['loader'] = null;

// "A Mustache loader instance for partials. If none is specified, defaults
// to an ArrayLoader for the supplied partials option, if present, and
// falls back to the specified template loader."
$config['partials_loader'] = null;

// "An array of Mustache partials. Useful for quick-and-dirty string template
// loading, but not as efficient or lazy as a Filesystem (or database) loader."
$config['partials'] = null;

// "An array of 'helpers'. Helpers can be global variables or objects, closures
// (e.g. for higher order sections), or any other valid Mustache context value.
// They will be prepended to the context stack, so they will be available in any
// template loaded by this Mustache instance."
$config['helpers'] = null;

// "An 'escape' callback, responsible for escaping double-mustache variables.
// Defaults to htmlspecialchars."
$config['escape'] = null;

// "The type argument for htmlspecialchars. Defaults to ENT_COMPAT,
// but you may prefer ENT_QUOTES."
$config['entity_flags'] = ENT_QUOTES;

// "Character set for htmlspecialchars. Defaults to UTF-8."
$config['charset'] = 'UTF-8';

// "A Mustache logger instance. No logging will occur unless this is set.
// Using a PSR-3 compatible logging library—such as Monolog—is highly recommended.
// A simple stream logger implementation is available as well."
$config['logger'] = null;

// "Only treat Closure instances and invokable classes as callable.
// If true, values like array('ClassName', 'methodName') and
// array($classInstance, 'methodName'), which are traditionally "callable"
// in PHP, are not called to resolve variables for interpolation or section
// contexts. This helps protect against arbitrary code execution when user
// input is passed directly into the template.
// This currently defaults to false, but will default to true in v3.0."
$config['strict_callables'] = true;

// "Enable pragmas across all templates, regardless of the presence
// of pragma tags in the individual templates."
$config['pragmas'] = array();

// "Customize the tag delimiters used by this engine instance. Note that
// overriding here changes the delimiters used to parse all templates and
// partials loaded by this instance. To override just for a single template,
// use an inline "change delimiters" tag at the start of
// the template file: {{=<% %>=}}."
$config['delimiters'] = null;
