<?php defined('BASEPATH') or exit('No direct script access allowed.');

/**
 * Template helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 * Some original functions from Phil Sturgeon have been taken as a starting point.
 */

// Added by Ivan Tcholakov, 29-DEC-2013.
ci()->config->load('asset', false, true);
//

// Functions by Phil Sturgeon (with minor modifications).
//------------------------------------------------------------------------------

if (!function_exists('template_title')) {

    function template_title() {

        $charset = config_item('charset');

        $data =& ci()->load->_ci_cached_vars;

        if (isset($data['template']['title']) && $data['template']['title'] != '') {

            echo
'
    <title>'.htmlspecialchars(strip_tags($data['template']['title']), ENT_QUOTES, $charset).'</title>';
        }
    }

}

if (!function_exists('template_metadata')) {

    function template_metadata() {

        $data =& ci()->load->_ci_cached_vars;

        if (isset($data['template']['metadata'])) {
            echo $data['template']['metadata'];
        }
    }

}

if (!function_exists('template_body')) {

    function template_body() {

        $data =& ci()->load->_ci_cached_vars;

        if (isset($data['template']['body'])) {
            echo $data['template']['body'];
        }
    }

}

if (!function_exists('template_partial')) {

    function template_partial($name) {

        $name = (string) $name;

        $data =& ci()->load->_ci_cached_vars;

        if (isset($data['template']['partials'][$name])) {
            echo $data['template']['partials'][$name];
        }
    }

}

if (!function_exists('template_partial_exists')) {

    function template_partial_exists($name) {

        $name = (string) $name;

        $data =& ci()->load->_ci_cached_vars;

        return isset($data['template']['partials'][$name]);
    }

}

if (!function_exists('file_partial')) {

    function file_partial($file, $ext = null) {

        $file = (string) $file;
        $ext = (string) $ext;

        if ($ext == '') {
            $ext = 'php';
        }

        $data =& ci()->load->_ci_cached_vars;

        if (isset($data['template_views'])) {

            $base_path = $data['template_views'];

            if (!file_exists($base_path.'partials/'.$file.'.'.$ext)) {
                $base_path = VIEWPATH;
            }

        } else {

            $base_path = VIEWPATH;
        }

        if (!file_exists($base_path.'partials/'.$file.'.'.$ext)) {
            $base_path = COMMONPATH.'views/';
        }

        if (!file_exists($base_path.'partials/'.$file.'.'.$ext)) {
            return;
        }

        echo ci()->load->_ci_load(array(
            '_ci_path' => $base_path.'partials/'.$file.'.'.$ext,
            '_ci_return' => TRUE
        ));
    }

}

if (!function_exists('template_breadcrumbs')) {

    function template_breadcrumbs() {

        $data =& ci()->load->_ci_cached_vars;

        return isset($data['template']['breadcrumbs']) ? $data['template']['breadcrumbs'] : array();
    }

}


// Functions supporting conditional asset/html inclusion,
// based on configuration options and/or user agent detection.
//------------------------------------------------------------------------------

if (!function_exists('template_enable_oldie')) {

    /**
     * This function decides whether additional assets within a html template
     * to be loaded for supporting older versions of Internet Explorer.
     * Create within your system the following configuration options:
     * $config['ie_min_supported_version'] = 6;         // 6, 7, 8, 9, 10, ...
     * $config['load_assets_by_ua_detection'] = true;   // or false
     * @autor Ivan Tcholakov, 2013.
     * @license The MIT License, http://opensource.org/licenses/MIT
     * @return boolean
     */
    function template_enable_oldie() {

        $result = false;

        $ie_min_supported = config_item('ie_min_supported_version');

        if ($ie_min_supported < 9) {

            if (config_item('load_assets_by_ua_detection')) {

                ci()->load->helper('user_agent');

                $browser = user_agent_ie();

                if ($browser['is_ie']) {

                    if ($browser['ie_version'] < 9 &&
                        $browser['ie_version'] >= $ie_min_supported) {

                        $result = true;
                    }
                }

            } else {

                $result = true;
            }
        }

        return $result;
    }

}

if (!function_exists('template_ie')) {

    // Added by Ivan Tcholakov, 25-OCT-2013.
    function template_ie() {

        if (config_item('load_assets_by_ua_detection')) {

            ci()->load->helper('user_agent');

            $browser = user_agent_ie();

            if ($browser['is_ie']) {
                return true;
            }

            return false;
        }

        return true;
    }

}

if (!function_exists('template_ie_mobile')) {

    // Added by Ivan Tcholakov, 24-OCT-2013.
    function template_ie_mobile() {

        if (config_item('load_assets_by_ua_detection')) {

            ci()->load->helper('user_agent');

            $browser = user_agent_ie();

            if ($browser['is_ie_mobile']) {
                return true;
            }

            return false;
        }

        return true;
    }

}

if (!function_exists('template_ios')) {

    // Added by Ivan Tcholakov, 24-OCT-2013.
    function template_ios() {

        if (config_item('load_assets_by_ua_detection')) {

            ci()->load->helper('user_agent');

            $browser = user_agent_ios();

            if ($browser['is_ios']) {
                return true;
            }

            return false;
        }

        return true;
    }

}


// Functions for inclusion frequently used asset/html parts within a template.
// The order of these functions is according to mandatory order of their
// calls inside a template.
//==============================================================================


// Document Start
//------------------------------------------------------------------------------

if (!function_exists('html_tag')) {

    // Added by Ivan Tcholakov. 21-OCT-2013.
    function html_tag($attributes = null) {

        ci()->load->helper('html');

        $data =& ci()->load->_ci_cached_vars;

        $attributes = html_attr_merge(
            isset($data['template_html_tag_attributes']) ? $data['template_html_tag_attributes'] : '',
            $attributes
        );

        // The Modernizr javascript removes this additional class,
        // if it does not fail to run for some reason (no javascript).
        $attributes = html_attr_merge('class="no-js"', $attributes);

        if (template_enable_oldie()) {

            return
'<!DOCTYPE html>
<!--[if IEMobile 7]><html'.html_attr_merge('class="iem7 oldie lt-ie9"', $attributes).'><![endif]-->
<!--[if lt IE 7]><html'.html_attr_merge('class="ie6 oldie lt-ie9 lt-ie8 lt-ie7"', $attributes).'><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html'.html_attr_merge('class="ie7 oldie lt-ie9 lt-ie8"', $attributes).'><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html'.html_attr_merge('class="ie8 oldie lt-ie9"', $attributes).'><![endif]-->
<!--[if gt IE 8]><!-->
    <html'.$attributes.'>
    <!--<![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!-->
    <html'.$attributes.'>
    <!--<![endif]-->';
        }

        return
"<!DOCTYPE html>
<html$attributes>";
    }

}


// Head Section Start
//------------------------------------------------------------------------------

if (!function_exists('head_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function head_tag() {

        return
'
<head>';
    }

}

if (!function_exists('meta_charset')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function meta_charset() {

        $charset = config_item('charset');

        return
"
    <meta charset=\"$charset\" />";
    }

}

if (!function_exists('base_href')) {

    // Added by Ivan Tcholakov. 26-OCT-2013.
    function base_href() {

        return
'
    <base href="'.BASE_URL.'" />';
    }

}

if (!function_exists('ie_edge')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function ie_edge() {

        if (template_ie()) {

            return
'
    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
        }

        return '';
    }

}


//------------------------------------------------------------------------------
// Within a template here is the place for site metadata -
// title, description, keywords, etc.
// The function is template_metadata().
//------------------------------------------------------------------------------


if (!function_exists('viewport')) {

    // Added by Ivan Tcholakov. 24-OCT-2013.
    function viewport() {

        // http://t.co/dKP3o1e
        return
'
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />';

    }

}

if (!function_exists('favicon')) {

    // Added by Ivan Tcholakov. 27-OCT-2013.
    function favicon($name = 'favicon.ico') {

        ci()->load->helper('file');

        $mime = get_mime_by_extension($name);

        if ($mime == '') {
            $mime = 'image/x-icon';
        }

        return
'
    <link rel="shortcut icon" type="'.$mime.'" href="'.BASE_URI.$name.'" />';
    }

}

if (!function_exists('apple_touch_icon')) {

    // Added by Ivan Tcholakov. 27-OCT-2013.
    function apple_touch_icon() {

        return
'
    <link rel="apple-touch-icon" href="'.BASE_URI.'apple-touch-icon.png">';
    }

}

if (!function_exists('apple_touch_icon_precomposed')) {

    // Added by Ivan Tcholakov. 27-OCT-2013.
    function apple_touch_icon_precomposed() {

        return
'
    <link rel="apple-touch-icon-precomposed" href="'.BASE_URI.'apple-touch-icon-precomposed.png">';
    }

}

if (!function_exists('cleartype_ie')) {

    // Added by Ivan Tcholakov. 24-OCT-2013.
    function cleartype_ie() {

        if (template_ie_mobile()) {

            // Mobile IE allows us to activate ClearType technology
            // for smoothing fonts for easy reading.
            return
'
    <meta http-equiv="cleartype" content="on" />';

        }

        return '';
    }

}

if (!function_exists('css_normalize')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function css_normalize() {

        ci()->load->helper('asset');

        if (template_enable_oldie()) {
            return css('lib/normalize-1/normalize.css');
        }

        //return css('lib/normalize-2/normalize.css');
        return css('lib/normalize-3/normalize.css');
    }
}


//------------------------------------------------------------------------------
// Within a template here is the place for CSS to be included.
//------------------------------------------------------------------------------


if (!function_exists('js_platform')) {

    // Added by Ivan Tcholakov. 22-OCT-2013.
    // Modified by Ivan Tcholakov, 02-JAN-2016.
    function js_platform() {

        ci()->load->helper('asset');
        ci()->load->helper('user_agent');

        $constants = array(
            'BASE_URL',
            'BASE_URI',
            'SERVER_URL',
            'SITE_URL',
            'CURRENT_SITE_URL',
            'SITE_URI',
            'CURRENT_SITE_URI',
            'CURRENT_URL',
            'CURRENT_URI',
            'CURRENT_URL_IS_HTTPS',
            'CURRENT_URL_PROTOCOL',
            'CURRENT_URL_HOST',
            'CURRENT_URL_PORT',
            'CURRENT_URI_STRING',
            'CURRENT_QUERY_STRING',
            'DEFAULT_BASE_URL',
            'DEFAULT_BASE_URI',
            'ASSET_URL',
            'ASSET_URI',
            'THEME_ASSET_URL',
            'THEME_ASSET_URI',
            'ASSET_IMG_URL',
            'ASSET_IMG_URI',
            'ASSET_JS_URL',
            'ASSET_JS_URI',
            'ASSET_CSS_URL',
            'ASSET_CSS_URI',
            'THEME_IMG_URL',
            'THEME_IMG_URI',
            'THEME_JS_URL',
            'THEME_JS_URI',
            'THEME_CSS_URL',
            'THEME_CSS_URI',
            'PUBLIC_UPLOAD_URL',
            'UA_IS_MOBILE',
            'UA_IS_ROBOT',
            'UA_IS_REFERRAL',
        );

        $constants_js = array();

        foreach ($constants as $name) {

            $constants_js[] = '        var '.$name.' = '.json_encode(constant($name)).';
';
        }

        $constants_js = implode('', $constants_js);

        return
'
    <script type="text/javascript">
    //<![CDATA[
'.$constants_js.'
        var site_url = '.json_encode(CURRENT_SITE_URL).'; // The language segment is added. Kept here for BC, replaced by CURRENT_SITE_URL.
        var site_uri = '.json_encode(CURRENT_SITE_URI).'; // The language segment is added. Kept here for BC, replaced by CURRENT_SITE_URI.
    //]]>
    </script>';
    }

}

if (!function_exists('js_selectivizr')) {

    // Added by Ivan Tcholakov. 22-OCT-2013.
    function js_selectivizr() {

        if (template_enable_oldie()) {

            ci()->load->helper('asset');

            return
'
    <!--[if (lt IE 9) & (!IEMobile)]>
        '.trim(js('lib/selectivizr/selectivizr.js')).'
    <![endif]-->';
        }

        return '';
    }

}

if (!function_exists('js_modernizr')) {

    // Added by Ivan Tcholakov. 22-OCT-2013.
    function js_modernizr() {

        ci()->load->helper('asset');

        if (config_item('load_javascripts_from_source')) {
            return js('lib/modernizr/modernizr.custom.js');
        }

        return js('lib/modernizr/modernizr.custom.min.js');
    }

}

if (!function_exists('js_respond')) {

    // Added by Ivan Tcholakov. 22-OCT-2013.
    function js_respond() {

        if (template_enable_oldie()) {

            ci()->load->helper('asset');

            if (config_item('load_javascripts_from_source')) {
                $js_path = js_path('lib/respond/respond-1.3.0.js');
            } else {
                $js_path = js_path('lib/respond/respond-1.3.0.min.js');
            }

            return
"
    <script type=\"text/javascript\">
    //<![CDATA[
        Modernizr.mq('(min-width:0)') || document.write('\x3Cscr' + 'ipt type=\"text/javascript\" src=\"$js_path\">\x3C/scr' + 'ipt>');
    //]]>
    </script>";

        }

        return '';
    }

}

if (!function_exists('js_jquery')) {

    // Added by Ivan Tcholakov. 21-OCT-2013.
    function js_jquery() {

        ci()->load->helper('asset');
        ci()->load->helper('user_agent');

        $jquery_version = '1.11.3';

        $browser = user_agent_ie();

        if ($browser['is_ie']) {

            if ($browser['ie_version'] < 7) {
                $jquery_version = '1.9.1';
            }
        }

        if (config_item('load_javascripts_from_source')) {

            $result = js("lib/jquery/jquery-$jquery_version.js");
            $result .= js('lib/jquery/jquery-migrate-1.2.1.js');

        } else {

            $result = js("lib/jquery/jquery-$jquery_version.min.js");
            $result .= js('lib/jquery/jquery-migrate-1.2.1.min.js');
        }

        return $result;
    }

}


//------------------------------------------------------------------------------
// Within a template here is the place for additional head-section related
// partials to be included - javascripts (if the placement within the head
// section is mandatory), custom metadata, etc.
//------------------------------------------------------------------------------


// Head Section End
//------------------------------------------------------------------------------

if (!function_exists('head_close_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function head_close_tag() {

        return
'
</head>';
    }

}


// Body Section Start
//------------------------------------------------------------------------------

if (!function_exists('body_tag')) {

    // Added by Ivan Tcholakov. 21-OCT-2013.
    function body_tag($attributes = null) {

        ci()->load->helper('html');

        $data =& ci()->load->_ci_cached_vars;

        $attributes = html_attr_merge(
            isset($data['template_body_tag_attributes']) ? $data['template_body_tag_attributes'] : '',
            $attributes
        );

        return
"
<body$attributes>
";
    }

}

if (!function_exists('noscript')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function noscript($alternative_message = null) {

        if ($alternative_message != '') {

                return
'
    <noscript>'.$alternative_message.'</noscript>';
        }

        return
'
    <noscript>Your browser does not support JavaScript!</noscript>';
    }

}

if (!function_exists('unsupported_browser')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function unsupported_browser($alternative_message = null) {

        if (template_enable_oldie()) {

            $ie_min_supported = (int) config_item('ie_min_supported_version');

            if ($alternative_message != '') {

                return
'
    <!--[if lt IE '.$ie_min_supported.']>
        '.$alternative_message.'
    <![endif]-->';
            }

            return
'
    <!--[if lt IE '.$ie_min_supported.']>
        <p class="browsehappy">
            You are using an <strong>outdated</strong> browser.
            Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
        </p>
    <![endif]-->';
        }

        return '';
    }

}


//------------------------------------------------------------------------------
// Within a template here is the place for the content, provided by the
// current controller. The function is template_body().
//------------------------------------------------------------------------------


if (!function_exists('js_jquery_extra_selectors')) {

    // Added by Ivan Tcholakov. 23-OCT-2013.
    function js_jquery_extra_selectors() {

        if (template_enable_oldie()) {

            ci()->load->helper('asset');

            if (config_item('load_javascripts_from_source')) {
                $js = js('lib/jquery-extra-selectors/jquery-extra-selectors.js');
            } else {
                $js = js('lib/jquery-extra-selectors/jquery-extra-selectors.min.js');
            }

            return
'
    <!--[if (lt IE 9) & (!IEMobile)]>
        '.trim($js).'
    <![endif]-->';
        }

        return '';
    }

}

if (!function_exists('js_bp_plugins')) {

    // Added by Ivan Tcholakov. 26-OCT-2013.
    function js_bp_plugins() {

        return js('lib/bp/plugins.js');
    }

}

if (!function_exists('js_mbp_helper')) {

    // Added by Ivan Tcholakov. 24-OCT-2013.
    function js_mbp_helper() {

        return js('lib/mbp/helper.js');
    }

}

if (!function_exists('js_scale_fix_ios')) {

    // Added by Ivan Tcholakov. 24-OCT-2013.
    function js_scale_fix_ios() {

        if (template_ios()) {

            // iOS scale bug fix
            return
'
    <script type="text/javascript">
    //<![CDATA[
        MBP.scaleFix();
    //]]>
    </script>';

        }

        return '';
    }

}

if (!function_exists('js_imgsizer')) {

    // Added by Ivan Tcholakov. 22-OCT-2013.
    function js_imgsizer() {

        if (template_enable_oldie()) {

            ci()->load->helper('asset');

            return
'
    <!--[if (lt IE 9) & (!IEMobile)]>
        '.trim(js('lib/imgsizer/imgsizer.js')).'
    <![endif]-->';
        }

        return '';
    }

}


//------------------------------------------------------------------------------
// Within a template here is the place for custom javascripts,
// at the bottom of the page.
//------------------------------------------------------------------------------


if (!function_exists('div_debug')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function div_debug() {

        // This div element is user by the Profiler for debugging AJAX requests.
        // http://www.moojuice.net/posts/making-codeigniters-profiler-ajax-compatible
        return
'
    <div id="debug"></div>';
    }

}


// Body Section End
//------------------------------------------------------------------------------

if (!function_exists('body_close_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function body_close_tag() {

        return
'
</body>';
    }

}


// Document End
//------------------------------------------------------------------------------

if (!function_exists('html_close_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function html_close_tag() {

        return
'
</html>';
    }

}
