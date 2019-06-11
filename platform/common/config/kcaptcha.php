<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// KCAPTHCA Settings
// Important note: This feature requires Session library/driver to be loaded.

// Captcha image width in pixels.
$config['width'] = 120;

// Captcha image height in pixels.
// If $config['show_credits'] = true then the actual height increases with 12 px.
$config['height'] = 80;

// The length in characters of the generated captcha keystring.
$config['length'] = 3;

// The foreground color as a RGB triad (RGB, 0-255).
// Example: $config['foreground_color'] = array(0, 0, 0);
// If this setting is empty, then a random color is picked.
$config['foreground_color'] = array();

// The background color as a RGB triad (RGB, 0-255).
// Example: $config['background_color'] = array(220, 230, 255);
// If this setting is empty, then a random color is picked.
$config['background_color'] = array();

// White noise within the generated captcha image.
// 0 - no white noise.
//$config['white_noise_density']  = 1/6;
$config['white_noise_density']  = 0;

// White noise within the generated captcha image.
// 0 - no black noise.
//$config['black_noise_density']  = 1/30;
$config['black_noise_density']  = 0;

// Whether a link to the site of KCAPTCH creator to be shown (true/false).
$config['show_credits'] = false;
