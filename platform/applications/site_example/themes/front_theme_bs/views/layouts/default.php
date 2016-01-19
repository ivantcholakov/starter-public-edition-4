<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo html_tag('lang="'.$this->lang->code().'" dir="'.$this->lang->direction().'"');
echo head_tag();

echo meta_charset();
echo base_href();
echo ie_edge();

template_title();
template_metadata();

echo viewport();
echo favicon();
echo apple_touch_icon_precomposed();
echo cleartype_ie();

echo js_platform();
file_partial('webfontloader');

echo theme_css('front.min.css');

file_partial('css');
template_partial('css');

echo js('lib/phpjs/phpjs.min.js');

echo js_selectivizr();
echo js_modernizr();
echo js_respond();
echo js_jquery();
echo js('lib/jquery-json/jquery.json.js');
template_partial('ckeditor');

template_partial('head');

echo head_close_tag();
echo body_tag('id="page-top"');

?>

    <!-- Wrap all page content here -->
    <div id="wrap">
<?php

echo Modules::run('main_menu_widget');

?>

        <!-- Begin page content -->
        <div class="container" id="content-container">
<?php

echo noscript('<div class="alert alert-warning text-center">'.$this->lang->line('ui_noscript').'</div>');
echo unsupported_browser('<div class="alert alert-warning text-center">'.$this->lang->line('ui_unsupported_browser').'</div>');

echo Modules::run('breadcrumb_widget/index');

template_body();

?>
        </div>

    </div>

<?php

file_partial('site_example_footer');

echo js_jquery_extra_selectors();
echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

echo js('lib/bootstrap-3/bootstrap.min.js');
echo js('lib/jasny-bootstrap-3/jasny-bootstrap.min.js');
echo js('lib/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js');
echo js('lib/snackbar/snackbar.min.js');
echo js('lib/nouislider/nouislider.min.js');

file_partial('scripts');
template_partial('scripts');

echo js('lib/google-code-prettify/prettify.js');
echo js('site_example.js');

echo div_debug();

if ($this->settings->get('google_analytics_enabled')) {
    file_partial('google_analytics');
}

echo body_close_tag();
echo html_close_tag();
