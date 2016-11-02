<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Template extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('template')
            ->helper('template')
        ;
    }

    public function __call($name, $arguments) {

        $template_data = & $this->parser_instance->getVariableRef(
            'template',
            $this->parser_instance->parser_data
        );

        return isset($template_data[$name]) ? $template_data[$name] : null;
    }

    public function file_partial() {

        ob_start();

        file_partial($this->get_attribute(0));

        return ob_get_clean();
    }

    public function partial() {

        ob_start();

        template_partial($this->get_attribute(0));

        return ob_get_clean();
    }

    public function has_partial() {

        return template_has_partial($this->get_attribute(0));
    }

    public function body() {

        ob_start();

        template_body();

        return ob_get_clean();
    }

    public function html_title() {

        ob_start();

        template_title();

        return ob_get_clean();
    }

    public function html_metadata() {

        ob_start();

        template_metadata();

        return ob_get_clean();
    }

    public function html_begin() {

        return html_begin($this->get_attribute(0));
    }

    public function html_end() {

        return html_end();
    }

    public function html_head_begin() {

        return head_begin();
    }

    public function html_head_end() {

        return head_end();
    }

    public function html_body_begin() {

        return body_begin($this->get_attribute(0));
    }

    public function html_body_end() {

        return body_end();
    }

    public function html_meta_charset() {

        return meta_charset();
    }

    public function html_base_href() {

        return base_href();
    }

    public function html_ie_edge() {

        return ie_edge();
    }

    public function html_viewport() {

        return viewport();
    }

    public function html_favicon() {

        return favicon($this->get_attribute(0, 'favicon.ico'));
    }

    public function html_apple_touch_icon() {

        return apple_touch_icon();
    }

    public function html_apple_touch_icon_precomposed() {

        return apple_touch_icon_precomposed();
    }

    public function css_normalize() {

        return css_normalize();
    }

    public function js_platform() {

        return js_platform();
    }

    public function js_selectivizr() {

        return js_selectivizr();
    }

    public function js_modernizr() {

        return js_modernizr();
    }

    public function js_respond() {

        return js_respond();
    }

    public function js_jquery() {

        return js_jquery();
    }

    public function html_noscript() {

        $alternative_message = $this->get_attribute(0, $this->get_content());

        if (trim($alternative_message) == '') {
            $alternative_message = null;
        }

        return noscript($alternative_message);
    }

    public function html_unsupported_browser() {

        $alternative_message = $this->get_attribute(0, $this->get_content());

        if (trim($alternative_message) == '') {
            $alternative_message = null;
        }

        return unsupported_browser($alternative_message);
    }

    public function js_jquery_extra_selectors() {

        return js_jquery_extra_selectors();
    }

    public function js_bp_plugins() {

        return js_bp_plugins();
    }

    public function js_mbp_helper() {

        return js_mbp_helper();
    }

    public function js_scale_fix_ios() {

        return js_scale_fix_ios();
    }

    public function js_imgsizer() {

        return js_imgsizer();
    }

}
