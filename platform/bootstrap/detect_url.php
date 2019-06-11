<?php

/**
 * A Url Detection Routine
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * @depends detect_https(), detect_host(), merge_paths()
 */

if (!function_exists('detect_url')) {

    function detect_url() {

        // See http://www.mediawiki.org/wiki/Manual:$wgServer
        $is_https = detect_https();
        $server_protocol = $is_https ? 'https' : 'http';
        $server_name = detect_host();

        if (isset($_SERVER['SERVER_PORT']) && !(strpos($server_name, '::') === FALSE ? strpos($server_name, ':') === FALSE : strpos($server_name, ']:') === FALSE)
                && (($server_protocol == 'http'
                && $_SERVER['SERVER_PORT'] != 80 ) || ($server_protocol == 'https' && $_SERVER['SERVER_PORT'] != 443))) {

            $server_name_extra = $server_name.':'.$_SERVER['SERVER_PORT'];
            $port = (int) $_SERVER['SERVER_PORT'];

        } else {

            $server_name_extra = $server_name;
            $port = $is_https ? 443 : 80;
        }

        $server_url = $server_protocol.'://'.$server_name_extra;
        //

        $script_name = $_SERVER['SCRIPT_NAME'];
        $script_path = str_replace(basename($script_name), '', $script_name);

        if (defined('FCPATH')) {

            $fcpath = FCPATH;

            // Added by Ivan Tcholakov, 17-MAY-2017.
            // A patch that has been tested on host.bg:
            if (strpos($script_path, '/~') === 0) {
                $fcpath = rtrim($fcpath, '/').$script_path;
            }
            //

            $base_url = $server_url . rtrim(preg_replace('/'.preg_quote(str_replace($fcpath, '', merge_paths($fcpath, $script_path).'/'), '/').'$/', '', $script_path), '/').'/';

        } else {

            $base_url = $server_url.'/';
        }

        $base_uri = parse_url($base_url, PHP_URL_PATH);

        if (substr($base_uri, 0, 1) != '/') {
            $base_uri = '/' . $base_uri;
        }

        if (substr($base_uri, -1, 1) != '/') {
            $base_uri .= '/';
        }

        $current_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';  // $_SERVER['REQUEST_URI'] is always set by previous code. The additional check here is for peace.
        $current_url = $server_url.$current_uri;

        $server_url .= '/';

        $current_uri_string = parse_url($current_url, PHP_URL_PATH);
        $current_query_string = parse_url($current_url, PHP_URL_QUERY);

        return compact(
            'base_url',
            'base_uri',
            'current_url',
            'current_uri',
            'current_uri_string',
            'current_query_string',
            'server_url',
            'server_name',
            'server_protocol',
            'is_https',
            'script_name',
            'script_path',
            'port'
        );
    }

}
