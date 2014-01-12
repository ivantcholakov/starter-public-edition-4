<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('html_filter_user')) {

    function html_filter_user($html) {

        static $purifier;

        if (!isset($purifier)) {

            $config = array();
            $config['allowed_tags'] = '';

            @include APPPATH.'config/html_filter_user.php';

            $purifier_config = HTMLPurifier_Config::createDefault();
            $purifier_config->set('Cache.SerializerPath', APPPATH.'cache_htmlpurifier');
            $purifier_config->set('Core.Encoding', 'utf-8');
            $purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
            $purifier_config->set('HTML.TidyLevel', 'light');
            $purifier_config->set('Core.ConvertDocumentToFragment', false);
            $purifier_config->set('Core.RemoveProcessingInstructions', true);
            @ $purifier_config->set('HTML.Allowed', $config['allowed_tags']);
            $purifier_config->set('HTML.SafeEmbed', false);
            $purifier_config->set('HTML.SafeObject', false);
            $purifier_config->set('HTML.FlashAllowFullScreen', true);
            $purifier_config->set('HTML.SafeIframe', false);
            $purifier_config->set('Attr.EnableID', true);
            $purifier_config->set('CSS.AllowImportant', true);
            $purifier_config->set('CSS.AllowTricky', true);
            $purifier_config->set('CSS.Proprietary', true);
            $purifier_config->set('Core.EnableIDNA', true);
            $purifier = @ new HTMLPurifier($purifier_config);
        }

        return @ $purifier->purify($html);
    }

}

if (!function_exists('html_filter_admin')) {

    function html_filter_admin($html) {

        static $purifier;

        if (!isset($purifier)) {

            $config = array();
            $config['allowed_tags'] = '';

            @include APPPATH.'config/html_filter_admin.php';

            $purifier_config = HTMLPurifier_Config::createDefault();
            $purifier_config->set('Cache.SerializerPath', APPPATH.'cache_htmlpurifier');
            $purifier_config->set('Core.Encoding', 'utf-8');
            $purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
            $purifier_config->set('HTML.TidyLevel', 'light');
            $purifier_config->set('Core.ConvertDocumentToFragment', false);
            $purifier_config->set('Core.RemoveProcessingInstructions', true);
            @ $purifier_config->set('HTML.Allowed', $config['allowed_tags']);
            $purifier_config->set('HTML.SafeEmbed', true);
            $purifier_config->set('HTML.SafeObject', true);
            $purifier_config->set('HTML.FlashAllowFullScreen', true);
            $purifier_config->set('HTML.SafeIframe', true);
            $purifier_config->set('Attr.EnableID', true);
            $purifier_config->set('CSS.AllowImportant', true);
            $purifier_config->set('CSS.AllowTricky', true);
            $purifier_config->set('CSS.Proprietary', true);
            $purifier_config->set('Core.EnableIDNA', true);
            $purifier = @ new HTMLPurifier($purifier_config);
        }

        return @ $purifier->purify($html);
    }

}
