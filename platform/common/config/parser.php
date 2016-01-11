<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Common Parser Settings
// Note: Settings for specific parser drivers are defined
// within configuration files parser_*.php

// The driver to be auto-loaded: "parser" driver (default)
$config['parser_driver']        = 'parser';

// Additional valid drivers that may be loaded.
$config['parser_valid_drivers'] = array(
    'mustache',
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
    'lex',
);
