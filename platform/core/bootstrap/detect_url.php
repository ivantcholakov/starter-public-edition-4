<?php

/**
 * A Url Detection Routine
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
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

        if (isset($_SERVER['SERVER_PORT']) && !strpos($server_name, ':')
                && (($server_protocol == 'http'
                && $_SERVER['SERVER_PORT'] != 80 ) || ($server_protocol == 'https' && $_SERVER['SERVER_PORT'] != 443))) {

            $server_name_extra = $server_name.':'.$_SERVER['SERVER_PORT'];

        } else {

            $server_name_extra = $server_name;
        }

        $server_url = $server_protocol.'://'.$server_name_extra;
        //

        $script_name = $_SERVER['SCRIPT_NAME'];
        $script_path = str_replace(basename($script_name), '', $script_name);

        if (defined('FCPATH')) {

            $base_url = $server_url . rtrim(preg_replace('/'.preg_quote(str_replace(FCPATH, '', merge_paths(FCPATH, $script_path).'/'), '/').'$/', '', $script_path), '/').'/';

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

        $current_uri = $_SERVER['REQUEST_URI'];
        $current_url = $server_url.$current_uri;

        $server_url .= '/';

        return compact(
            'base_url',
            'base_uri',
            'current_url',
            'current_uri',
            'server_url',
            'server_name',
            'server_protocol',
            'is_https',
            'script_name',
            'script_path'
        );
    }

}
