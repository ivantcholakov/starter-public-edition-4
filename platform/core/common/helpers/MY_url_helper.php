<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('base_uri')) {

    // Added by Ivan Tcholakov, 09-NOV-2013.
    function base_uri($uri = '') {

        return get_instance()->config->base_uri($uri);
    }
}

if (!function_exists('site_uri')) {

    // Added by Ivan Tcholakov, 09-NOV-2013.
    function site_uri($uri = '') {

        return get_instance()->config->site_uri($uri);
    }
}

if (!function_exists('url_add_params')) {

    // See http://www.bin-co.com/php/scripts/misc/getlink/
    // Deprecated function. Use http_build_url() instead.
    function url_add_params($url, $params = array(), $xml_compliant = false, $skip_empty_params = true) {

        $param_separator = $xml_compliant ? '&amp;' : '&';

        if (empty($params) || !is_array($params)) {
            return $url;
        }

        $param_starter = '';

        if (strpos($url, '?') === false) {
            $param_starter = '?';
        }
        elseif (!preg_match('/(\?|\&(amp;)?)$/', $url)) {
            $param_starter = $param_separator;
        }

        $params_arr = array();

        foreach ($params as $key => $value) {

            if (is_array($value)) {

                if ($skip_empty_params && empty($value)) {
                    continue;
                }

                foreach ($value as $value_nested) {
                    $params_arr[] = $key . '[]=' . urlencode($value_nested);
                }

            } else {

                if ($skip_empty_params && trim($value) == '') {
                    continue;
                }

                $params_arr[] = $key . '=' . urlencode($value);
            }
        }

        $params_serialized = implode($param_separator, $params_arr);

        if ($params_serialized != '') {
            $url .= $param_starter.$params_serialized;
        }

        return $url;
    }

}
