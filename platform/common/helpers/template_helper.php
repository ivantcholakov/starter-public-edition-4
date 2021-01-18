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

        $data =& ci()->load->_ci_cached_vars;

        if (isset($data['template']['title']) && $data['template']['title'] != '') {

            echo
'
    <title>'.$data['template']['title'].'</title>';
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

if (!function_exists('template_has_partial')) {

    // Added by Ivan Tcholakov, 19-JAN-2016.
    // An alias of template_partial_exists()
    function template_has_partial($name) {

        return template_partial_exists($name);
    }

}

if (!function_exists('file_partial')) {

    function file_partial($file) {

        $file = (string) $file;

        $data =& ci()->load->_ci_cached_vars;

        $file_found = null;

        if (isset($data['template_views'])) {

            $base_path = $data['template_views'];
            $file_found = ci()->parser->find_file($base_path.'partials/'.$file);
        }

        if ($file_found === null) {

            $base_path = VIEWPATH;
            $file_found = ci()->parser->find_file($base_path.'partials/'.$file);
        }

        if ($file_found === null) {

            $base_path = $base_path = COMMONPATH.'views/';
            $file_found = ci()->parser->find_file($base_path.'partials/'.$file);
        }

        if ($file_found === null) {
            return;
        }

        echo ci()->load->_ci_load(array(
            '_ci_path' => $file_found,
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

if (!function_exists('html_begin')) {

    // Added by Ivan Tcholakov. 21-OCT-2013.
    // Renamed by Ivan Tcholakov, html_tag -> html_tag_no_conflict, 03-JAN-2016.
    // Renamed by Ivan Tcholakov, html_tag_no_conflict -> html_begin, 23-APR-2016.
    function html_begin($attributes = null) {

        // Add language code and text direction automatically.
        $attr = array();

        $lang = ci()->lang->code();

        if ($lang != '') {
            $attr['lang'] = $lang;
        }

        $dir = ci()->lang->direction();

        if ($dir != '') {
            $attr['dir'] = $dir;
        }

        if (!empty($attr)) {
            $attributes = html_attr_merge($attr, $attributes);
        }

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

if (!function_exists('head_begin')) {

    // Added by Ivan Tcholakov. 23-APR-2016.
    function head_begin() {

        return
'
<head>';
    }

}

if (!function_exists('head_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    /**
     *
     * @deprecated Use head_begin().
     */
    function head_tag() {

        return head_begin();
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

if (!function_exists('css_normalize')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    function css_normalize() {

        ci()->load->helper('asset');

        if (template_enable_oldie()) {
            return css('lib/normalize-1/normalize.min.css');
        }

        //return css('lib/normalize-2/normalize.min.css');
        //return css('lib/normalize-3/normalize.min.css');
        return css('lib/normalize-7/normalize.min.css');
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

            if (defined($name)) {
                $constants_js[] = '        var '.$name.' = '.json_encode(constant($name)).';
';
            }
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

if (!function_exists('js_modernizr')) {

    // Added by Ivan Tcholakov. 22-OCT-2013.
    // Modified by Ivan Tcholakov, 08-DEC-2020.
    function js_modernizr() {

        return '    <script type="text/javascript" src="'.html_attr_escape(base_url('assets/composer-asset/components/modernizr/modernizr.js?v='.PLATFORM_VERSION)).'"></script>';
    }

}

if (!function_exists('js_jquery')) {

    // Added by Ivan Tcholakov. 21-OCT-2013.
    // Modified by Ivan Tcholakov, 08-DEC-2020.
    function js_jquery() {

        return '    <script type="text/javascript" src="'.html_attr_escape(base_url('assets/composer-asset/components/jquery/jquery.min.js?v='.PLATFORM_VERSION)).'"></script>';
    }

}


//------------------------------------------------------------------------------
// Within a template here is the place for additional head-section related
// partials to be included - javascripts (if the placement within the head
// section is mandatory), custom metadata, etc.
//------------------------------------------------------------------------------


// Head Section End
//------------------------------------------------------------------------------

if (!function_exists('head_end')) {

    // Added by Ivan Tcholakov. 25-APR-2016.
    function head_end() {

        return
'
</head>';
    }

}

if (!function_exists('head_close_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    /**
     * @deprecated Use head_end().
     */
    function head_close_tag() {

        return head_end();
    }

}


// Body Section Start
//------------------------------------------------------------------------------

if (!function_exists('body_begin')) {

    // Added by Ivan Tcholakov. 23-APR-2016.
    function body_begin($attributes = null) {

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

if (!function_exists('body_tag')) {

    // Added by Ivan Tcholakov. 21-OCT-2013.
    /**
     * @deprecated Use body_begin().
     */
    function body_tag($attributes = null) {

        return body_begin($attributes);
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

if (!function_exists('body_end')) {

    // Added by Ivan Tcholakov. 23-APR-2016.
    function body_end() {

        return
'
</body>';
    }

}

if (!function_exists('body_close_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    /**
     * @deprecated Use body_end().
     */
    function body_close_tag() {

        return body_end();
    }

}


// Document End
//------------------------------------------------------------------------------

if (!function_exists('html_end')) {

    // Added by Ivan Tcholakov. 23-APR-2016.
    function html_end() {

        return
'
</html>';
    }

}

if (!function_exists('html_close_tag')) {

    // Added by Ivan Tcholakov. 25-OCT-2013.
    /**
     * @deprecated Use html_end().
     */
    function html_close_tag() {

        return html_end();
    }

}
