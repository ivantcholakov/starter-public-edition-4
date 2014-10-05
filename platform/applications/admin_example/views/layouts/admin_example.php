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

echo css('lib/bootstrap-3/bootstrap.min.css');
echo css('lib/jasny-bootstrap-3/jasny-bootstrap.min.css');
echo css('lib/bootstrap-3/bootstrap-theme.min.css');
echo css('lib/font-awesome-4/font-awesome.min.css');
echo css('admin_example.css');

file_partial('css');
template_partial('css');

echo js_platform();
echo js_selectivizr();
echo js_modernizr();
echo js_respond();
echo js_jquery();

template_partial('head');

echo head_close_tag();
echo body_tag('id="page-top"');

?>

    <!-- Wrap all page content here -->
    <div id="wrap">
<?php

file_partial('admin_example_navbar');

?>

        <!-- Begin page content -->
        <div class="container">
<?php

echo noscript('<div class="alert alert-warning text-center">'.$this->lang->line('ui_noscript').'</div>');
echo unsupported_browser('<div class="alert alert-warning text-center">'.$this->lang->line('ui_unsupported_browser').'</div>');

template_body();

?>
        </div>

    </div>

<?php

file_partial('admin_example_footer');

echo js_jquery_extra_selectors();
echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

echo js('lib/bootstrap-3/bootstrap.min.js');
echo js('lib/jasny-bootstrap-3/jasny-bootstrap.min.js');
echo js('lib/jquery-ajax-queue/jquery-ajax-queue.js');

file_partial('scripts');
template_partial('scripts');

template_partial('handle_unauthenticated_ajax');

echo div_debug();

echo body_close_tag();
echo html_close_tag();
