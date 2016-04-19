<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// On which directories or single images dynamic thumbnails to be enabled.
// Put within the array full absolute system paths.
// It is preferable directories to have trailing slashes.
$config['enable_dynamic_output'] = array(
    DEFAULTFCPATH.'assets/img/playground.jpg',  // An example.
);

// The background of the hard-sized canvas, if it is needed
// Color
$config['bg_r'] = 255;
$config['bg_g'] = 255;
$config['bg_b'] = 255;
// Alpha channel 0..127; 0 - completely opaque, 127 - completely transparent.
$config['bg_alpha'] = 127;

// Watermarks

// On which directories or single images to put watermarks.
// Put within the array full absolute system paths.
// It is preferable directories to have trailing slashes.
$config['enable_watermark'] = array(
    DEFAULTFCPATH.'assets/img/playground.jpg',  // An example.
);

// The minimal image size for watermark to be applied.
$config['wm_enabled_min_w'] = 100;
$config['wm_enabled_min_h'] = 50;

// Common watermark properties.
$config['wm_type'] = 'text';    // 'text' or 'overlay'
$config['wm_padding'] = 0;
$config['wm_vrt_alignment'] = 'B';
$config['wm_hor_alignment'] = 'C';
$config['wm_hor_offset'] = 0;
$config['wm_vrt_offset'] = 0;

// Watermark of 'text' type.
$config['wm_text'] = 'Watermark';
$config['wm_font_path'] = '';
$config['wm_font_size'] = 17;
$config['wm_font_color'] = '#ff0000';
$config['wm_shadow_color'] = '';
$config['wm_shadow_distance'] = 2;

// Watermark of 'overlay' type.
$config['wm_overlay_path'] = '';
$config['wm_opacity'] = 50;
$config['wm_x_transp'] = false;
$config['wm_y_transp'] = false;

// Force cropping globally, may be activated for testing purpose.
$config['force_crop'] = false;
