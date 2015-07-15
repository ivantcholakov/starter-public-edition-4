<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// An 'escape' callback, responsible for escaping double-mustache variables.
// NULL (default) means that 'htmlspecialchars' function will be applied.
$config['escape'] = null;

// Character set for 'htmlspecialchars' function if applied for escaping.
// NULL means config_item('charset'), i.e. the character set of the site.
$config['charset'] = null;

// Type argument for 'htmlspecialchars' function if applied for escaping.
// It defaults to ENT_COMPAT. You may prefer ENT_QUOTES.
$config['entity_flags'] = ENT_COMPAT;
