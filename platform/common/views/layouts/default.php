<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo html_begin();
echo head_begin();

echo meta_charset();
echo base_href();
echo ie_edge();

template_title();
template_metadata();

echo viewport();
echo favicon();
echo apple_touch_icon_precomposed();

echo css_normalize();
file_partial('css');
template_partial('css');

echo js_platform();
echo js_modernizr();
echo js_jquery();

template_partial('head');

echo head_end();
echo body_begin('id="page-top"');

echo noscript();
echo unsupported_browser();

template_body();

echo js_jquery_extra_selectors();
echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

file_partial('scripts');
template_partial('scripts');

echo div_debug();

echo body_end();
echo html_end();
