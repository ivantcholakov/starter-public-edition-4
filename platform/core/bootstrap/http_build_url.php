<?php

/**
 * PHP fallback function http_build_url().
 * For servers without pecl_http package installed.
 *
 * Based on the original C code from pecl_http-1.7.6
 * @link http://svn.php.net/viewvc/pecl/http/tags/RELEASE_1_7_6/php_http_url_api.h?view=markup
 * @link http://svn.php.net/viewvc/pecl/http/tags/RELEASE_1_7_6/http_url_api.c?view=markup
 *
 * Some snippets by Sébastien Corne have been used.
 * @link https://github.com/Seebz/Snippets/blob/master/php/http_build_url.php
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Code repository:
 * @link https://github.com/ivantcholakov/http_build_url
 *
 * Usage:
 * Place this file on a suitable directory of your PHP system.
 * Inside a common bootstrap file within your system insert the following piece of code:
 *
 * if (!function_exists('http_build_str') || !function_exists('http_build_url')) {
 *     require dirname(__FILE__).'/write/your/relative/path/here/http_build_url.php';
 * }
 *
 * After that, the functions http_build_url() and http_build_str() would be callable.
 * A quick test:
 * 
 * echo http_build_url();
 */

if (!function_exists('http_build_url')) {

    /**
     * Based on the original C code from pecl_http-1.7.6:
     * @link http://svn.php.net/viewvc/pecl/http/tags/RELEASE_1_7_6/php_http_url_api.h?view=markup
     * @link http://svn.php.net/viewvc/pecl/http/tags/RELEASE_1_7_6/http_url_api.c?view=markup
     */
    define('HTTP_URL_REPLACE',            0);   // Replace every part of the first URL when there is one of the second URL.
    define('HTTP_URL_JOIN_PATH',          1);   // Join relative paths.
    define('HTTP_URL_JOIN_QUERY',         2);   // Join query strings.
    define('HTTP_URL_STRIP_USER',         4);   // Strip any user authentication information.
    define('HTTP_URL_STRIP_PASS',         8);   // Strip any password authentication information.
    define('HTTP_URL_STRIP_AUTH',        12);   // Strip any authentication information.
    define('HTTP_URL_STRIP_PORT',        32);   // Strip explicit port numbers.
    define('HTTP_URL_STRIP_PATH',        64);   // Strip complete path.
    define('HTTP_URL_STRIP_QUERY',      128);   // Strip query string.
    define('HTTP_URL_STRIP_FRAGMENT',   256);   // Strip any fragments (#identifier).
    define('HTTP_URL_STRIP_ALL',        492);   // Strip anything but scheme and host.

    /**
     * Build a URL (PECL pecl_http >= 0.21.0)
     * @link http://php.net/manual/en/function.http-build-url.php
     * @param   mixed       $url        (Part(s) of) An URL in form of a string or associative array like parse_url() returns.
     * @param   mixed       $parts      Same as the first argument.
     * @param   integer     $flags      A bitmask of binary or'ed HTTP_URL constants; HTTP_URL_REPLACE is the default.
     * @param   array       $new_url    If set, it will be filled with the parts of the composed url like parse_url() would return.
     * @return  string                  Returns the new URL as string on success or FALSE on failure.
     */
    function http_build_url($url = array(), $parts = array(), $flags = HTTP_URL_REPLACE, &$new_url = null) {

        // Initialization

        static $all_keys = array('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment');
        static $all_keys_flipped;

        static $server_https;
        static $default_host;
        static $request_uri;
        static $request_uri_no_query;
        static $request_uri_path;

        if (!isset($all_keys_flipped)) {
            $all_keys_flipped = array_flip($all_keys);
        }

        if (!isset($server_https)) {
            $server_https = !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on';
        }

        if (!isset($default_host)) {

            $default_host =
                isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
                : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '');

            if ($default_host == '') {
                $default_host = function_exists('gethostname') ? gethostname() : php_uname('n');
            }
        }

        if (!isset($request_uri)) {

            if (isset($_SERVER['REQUEST_URI'])) {
                $request_uri = $_SERVER['REQUEST_URI'];
            } else {
                $request_uri = '/';
            }
        }

        if (!isset($request_uri_no_query)) {
            $request_uri_no_query = preg_replace('~^([^\?]*).*$~', '$1', $request_uri);
        }

        if (!isset($request_uri_path)) {
            $request_uri_path = substr($request_uri_no_query, 0, strrpos($request_uri_no_query, '/') + 1);
        }

        // Translate the flags from the single input parameter.

        $JOIN_PATH      = (($flags | HTTP_URL_JOIN_PATH) == $flags);
        $JOIN_QUERY     = (($flags | HTTP_URL_JOIN_QUERY) == $flags);
        $STRIP_USER     = (($flags | HTTP_URL_STRIP_USER) == $flags);
        $STRIP_PASS     = (($flags | HTTP_URL_STRIP_PASS) == $flags);
        $STRIP_PORT     = (($flags | HTTP_URL_STRIP_PORT) == $flags);
        $STRIP_PATH     = (($flags | HTTP_URL_STRIP_PATH) == $flags);
        $STRIP_QUERY    = (($flags | HTTP_URL_STRIP_QUERY) == $flags);
        $STRIP_FRAGMENT = (($flags | HTTP_URL_STRIP_FRAGMENT) == $flags);

        // Parse and validate the input URLs.

        if (!is_array($url)) {
            $url = parse_url($url);
        }

        if (!is_array($parts)) {
            $parts = parse_url($parts);
        }

        $url = array_intersect_key($url, $all_keys_flipped);
        $parts = array_intersect_key($parts, $all_keys_flipped);

        foreach ($all_keys as $key) {

            if ($key == 'port') {

                if (isset($url[$key])) {

                    $url[$key] = (int) $url[$key];

                    if ($url[$key] <= 0 || $url[$key] >= 65535) {
                        unset($url[$key]);
                    }
                }

                if (isset($parts[$key])) {

                    $parts[$key] = (int) $parts[$key];

                    if ($parts[$key] <= 0 || $parts[$key] >= 65535) {
                        unset($parts[$key]);
                    }
                }

            } else {

                if (isset($url[$key])) {

                    $url[$key] = (string) $url[$key];

                    if ($url[$key] == '') {
                        unset($url[$key]);
                    }
                }

                if (isset($parts[$key])) {

                    $parts[$key] = (string) $parts[$key];

                    if ($parts[$key] == '') {
                        unset($parts[$key]);
                    }
                }
            }
        }

        // Start building the result.

        // Port

        if ($STRIP_PORT) {

            if (isset($url['port'])) {
                unset($url['port']);
            }

        } else {

            if (isset($parts['port'])) {
                $url['port'] = $parts['port'];
            }
        }

        // User

        if ($STRIP_USER) {

            if (isset($url['user'])) {
                unset($url['user']);
            }

        } else {

            if (isset($parts['user'])) {
                $url['user'] = $parts['user'];
            }
        }

        // Password

        if ($STRIP_PASS || !isset($url['user'])) {

            if (isset($url['pass'])) {
                unset($url['pass']);
            }

        } else {

            if (isset($parts['pass'])) {
                $url['pass'] = $parts['pass'];
            }
        }

        // Scheme

        if (isset($parts['scheme'])) {
            $url['scheme'] = $parts['scheme'];
        }

        // Host

        if (isset($parts['host'])) {
            $url['host'] = $parts['host'];
        }

        // Path

        if ($STRIP_PATH) {

            if (isset($url['path'])) {
                unset($url['path']);
            }

        } else {

            if ($JOIN_PATH && isset($parts['path']) && isset($url['path']) && substr($parts['path'], 0, 1) != '/') {

                if (substr($url['path'], -1, 1) != '/') {
                    $base_path = str_replace('\\', '/', dirname($url['path']));
                } else {
                    $base_path = $url['path'];
                }

                if (substr($base_path, -1, 1) != '/') {
                    $base_path .= '/';
                }

                $url['path'] = $base_path.$parts['path'];

            } else {

                if (isset($parts['path'])) {
                    $url['path'] = $parts['path'];
                }
            }
        }

        // Query

        if ($STRIP_QUERY) {

            if (isset($url['query'])) {
                unset($url['query']);
            }

        } else {

            if ($JOIN_QUERY && isset($url['query']) && isset($parts['query'])) {

                // From an original snippet by Sébastien Corne.
                //---------------------------------------------------------------------

                $u_query = $url['query'];
                $p_query = $parts['query'];

                if (!is_array($u_query)) parse_str($u_query, $u_query);
                if (!is_array($p_query)) parse_str($p_query, $p_query);

                $u_query = http_build_str($u_query);
                $p_query = http_build_str($p_query);

                $u_query = str_replace(array('[', '%5B'), '{{{', $u_query);
                $u_query = str_replace(array(']', '%5D'), '}}}', $u_query);

                $p_query = str_replace(array('[', '%5B'), '{{{', $p_query);
                $p_query = str_replace(array(']', '%5D'), '}}}', $p_query);

                parse_str($u_query, $u_query);
                parse_str($p_query, $p_query);

                $query = http_build_str(array_merge($u_query, $p_query));
                $query = str_replace(array('{{{', '%7B%7B%7B'), '%5B', $query);
                $query = str_replace(array('}}}', '%7D%7D%7D'), '%5D', $query);

                parse_str($query, $query);

                //---------------------------------------------------------------------

           } else {

                if (isset($parts['query'])) {
 
                    $query = $parts['query'];
                }
            }

            if (isset($query)) {
                
                if (is_array($query)) {
                    $query = http_build_str($query);
                }

                $url['query'] = $query;
            }
        }

        // Fragment

        if ($STRIP_FRAGMENT) {

            if (isset($url['fragment'])) {
                unset($url['fragment']);
            }

        } else {

            if (isset($parts['fragment'])) {
                $url['fragment'] = $parts['fragment'];
            }
        }

        // Ensure scheme presence.

        if (!isset($url['scheme'])) {

            if ($server_https) {

                $url['scheme'] = 'http';

            } elseif (isset($url['port'])) {

                if ($scheme = getservbyport($url['port'], 'tcp')) {

                    $url['scheme'] = $scheme;

                } else {

                    $url['scheme'] = 'http';
                }

            } else {

                $url['scheme'] = 'http';
            }
        }

        // Ensure host presence.

        if (!isset($url['host'])) {
            $url['host'] = $default_host;
        }

        // Hide standard ports.
        // http://www.iana.org/assignments/port-numbers

        if (isset($url['port'])) {

            if ((int) getservbyname($url['scheme'], 'tcp') == $url['port']) {
                unset($url['port']);
            }
        }

        // Ensure path presence.

        if ($STRIP_PATH) {

            $url['path'] = '';

        } else {

            if (!isset($url['path'])) {

                $url['path'] = $request_uri_no_query;

            } elseif (substr($url['path'], 0, 1) != '/') {

                // A relative path, deal with it.
                $url['path'] = $request_uri_path.$url['path'];
            }
        }

        // Canonize the result path.

        if (strpos($url['path'], './') !== false) {

            // From an original snippet by Sébastien Corne.
            //---------------------------------------------------------------------

            $path = explode('/', $url['path']);

            $k_stack = array();

            foreach ($path as $k => $v) {

                if ($v == '..') {      // /../

                    if ($k_stack) {

                        $k_parent = array_pop($k_stack);
                        unset($path[$k_parent]);
                    }

                    unset($path[$k]);

                } elseif ($v == '.')  { // /./

                    unset($path[$k]);

                } else {

                    $k_stack[] = $k;
                }
            }

            $url['path'] = implode('/', $path);

            //---------------------------------------------------------------------
        }

        $url['path'] = '/'.ltrim($url['path'], '/');

        // The result as an array type is ready.

        $new_url = $url;

        // Build the result string.

        $result = $url['scheme'].'://';

        if (isset($url['user'])) {
            $result .= $url['user'].(isset($url['pass']) ? ':'.$url['pass'] : '').'@';
        }

        $result .= $url['host'];

        if (isset($url['port'])) {
            $result .= ':'.$url['port'];
        }

        $result .= $url['path'];

        if (isset($url['query'])) {
            $result .= '?'.$url['query'];
        }

        if (isset($new_url['fragment'])) {
            $result .= '#'.$url['fragment'];
        }

        return $result;
    }

}

if (!function_exists('http_build_str')) {

    /**
     * Build query string (PECL pecl_http >= 0.23.0)
     * @link http://php.net/manual/en/function.http-build-str.php
     * @param   array   $query          Associative array of query string parameters.
     * @param   string  $prefix         Top level prefix.
     * @param   string  $arg_separator  Argument separator to use (by default the INI setting arg_separator.output will be used, or "&" if neither is set.
     * @return  string                  Returns the built query as string on success or FALSE on failure.
     * A snippet from Sébastien Corne.
     */
    function http_build_str(array $query, $prefix = '', $arg_separator = null) {

        if (is_null($arg_separator)) {
            $arg_separator = ini_get('arg_separator.output');
        }

        $result = array();

        foreach ($query as $k => $v) {

            $key = $prefix ? "{$prefix}%5B{$k}%5D" : $k;

            if (is_array($v)) {
                $result[] = call_user_func(__FUNCTION__, $v, $key, $arg_separator);
            } else {
                $result[] = $key.'='.urlencode($v);
            }
        }

        return implode($arg_separator, $result);
    }

}
