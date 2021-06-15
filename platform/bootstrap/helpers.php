<?php

// URL Detection ---------------------------------------------------------------

if (!function_exists('resolve_path')) {

    /**
     * This function resolves paths like realpath does,
     * WITHOUT checking for validance.
     * http://www.php.net/manual/en/function.realpath.php#81935
     * @author 131 dot php at cloudyks dot org
     */

    //realpath like, working with absolute/relative path & a little bit shorter :p

    function resolve_path($path) {

        $path = str_replace('\\', '/', $path);

        $out = array();

        foreach (explode('/', $path) as $i => $fold) {

            if ($fold == '' || $fold == '.') {
                continue;
            }

            if ($fold == '..' && $i > 0 && end($out) != '..') {
                array_pop($out);
            } else {
                $out[] = $fold;
            }
        }

        return (strpos($path, '/') === 0 ? '/' : '').implode('/', $out);
    }

}

if (!function_exists('merge_paths')) {

    // See http://stackoverflow.com/questions/2267074/merge-string-with-common-middle-part
    // "Merge string with common middle part"

    function merge_paths($path1, $path2) {

        // Added by Ivan Tcholakov, 13-MAR-2016.
        $path1 = str_replace('\\', '/', $path1);
        $path2 = str_replace('\\', '/', $path2);
        //

        $p1 = explode('/', trim($path1,' /'));
        $p2 = explode('/', trim($path2,' /'));

        $len = count($p1);

        do {

            if (array_slice($p1, -$len) === array_slice($p2, 0, $len)) {

                return '/'
                    . implode('/', array_slice($p1, 0, -$len))
                    . '/'
                    . implode('/', $p2);
            }
        }
        while (--$len);

        return '/'.implode('/', array_merge($p1, $p2));
    }

}

/**
 * A HTTPS Detection Routine
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('detect_https')) {

    function detect_https() {

        return

            (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
            ? true
            : (
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
                ? true
                : (
                    (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
                    ? true
                    : false
                )
            );
    }

}

/**
 * Server Name Detection Routine
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('detect_host')) {

    function detect_host() {

        return

            isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME']
                : (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
                : (isset($_SERVER['SERVER_ADDR']) ? (strpos($_SERVER['SERVER_ADDR'], '::') === FALSE ? $_SERVER['SERVER_ADDR'] : '['.$_SERVER['SERVER_ADDR'].']')
                : 'localhost'));
    }

}

/**
 * A Url Detection Routine
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * @depends detect_https(), detect_host(), merge_paths()
 */

if (!function_exists('detect_url')) {

    function detect_url($returnAutodetectedPart = null) {

        static $result = array();

        if (empty($result)) {

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

            $result = compact(
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

        if (is_string($returnAutodetectedPart) && $returnAutodetectedPart != '') {

            return isset($result[$returnAutodetectedPart]) ? $result[$returnAutodetectedPart] : null;
        }

        return $result;
    }

}

// For common purpose ----------------------------------------------------------

/**
 * Converts string boolean representation to a true boolean.
 *
 * @param string    $value      The given value.
 * @param bool      $strict     Whether the value has to match exactly to a truthy string for returning TRUE.
 * @return bool
 *
 * @author Ivan Tcholakov, 2015
 * @license MIT
 */

if (!function_exists('str_to_bool')) {

    function str_to_bool($value, $strict = false) {

        if (empty($value)) {
            return false;
        }

        if (is_bool($value)) {
            return $value;
        }

        $value = strtolower(@ (string) $value);

        if (in_array($value, array('no', 'n', 'false', 'off'))) {
            return false;
        }

        if ($strict) {
            return in_array($value, array('yes', 'y', 'true', '1', 'on'));
        }

        return true;
    }

}

/**
 * Checks whether a given value can be a strict string representation of a boolean value.
 *
 * @param string    $value      The given value.
 * @return bool
 *
 * @author Ivan Tcholakov, 2015
 * @license MIT
 */

if (!function_exists('is_str_to_bool')) {

    function is_str_to_bool($value, $strict = false) {

        if (!$strict) {

            $value_test = @ (string) $value;

            if (is_numeric($value_test)) {
                return true;
            }
        }

        return !str_to_bool($value) || str_to_bool($value, true);
    }

}

/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://sam.zoy.org/wtfpl/COPYING for more details.
 */

if (!function_exists('is_serialized'))
{
    /**
     * Tests if an input is valid PHP serialized string.
     *
     * Checks if a string is serialized using quick string manipulation
     * to throw out obviously incorrect strings. Unserialize is then run
     * on the string to perform the final verification.
     *
     * Valid serialized forms are the following:
     * <ul>
     * <li>boolean: <code>b:1;</code></li>
     * <li>integer: <code>i:1;</code></li>
     * <li>double: <code>d:0.2;</code></li>
     * <li>string: <code>s:4:"test";</code></li>
     * <li>array: <code>a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}</code></li>
     * <li>object: <code>O:8:"stdClass":0:{}</code></li>
     * <li>null: <code>N;</code></li>
     * </ul>
     *
     * @author      Chris Smith <code+php@chris.cs278.org>
     * @copyright   Copyright (c) 2009 Chris Smith (http://www.cs278.org/)
     * @license     http://sam.zoy.org/wtfpl/ WTFPL
     * @param       string      $value      Value to test for serialized form
     * @param       mixed       $result     Result of unserialize() of the $value
     * @return      boolean                 True if $value is serialized data, otherwise false
     */
    function is_serialized($value, &$result = null)
    {
        // Bit of a give away this one
        if (!is_string($value))
        {
            return false;
        }

        // Serialized false, return true. unserialize() returns false on an
        // invalid string or it could return false if the string is serialized
        // false, eliminate that possibility.
        if ($value === 'b:0;')
        {
            $result = false;
            return true;
        }

        $length    = strlen($value);
        $end    = '';

        // Added by Ivan Tcholakov, 26-DEC-2015.
        if (!isset($value[0]))
        {
            return false;
        }
        //

        switch ($value[0])
        {
            case 's':

                // Added by Ivan Tcholakov, 26-DEC-2015.
                if (!isset($value[$length - 2]))
                {
                    return false;
                }
                //

                if ($value[$length - 2] !== '"')
                {
                    return false;
                }
            case 'b':
            case 'i':
            case 'd':
                // This looks odd but it is quicker than isset()ing
                $end .= ';';
            case 'a':
            case 'O':
                $end .= '}';

                // Added by Ivan Tcholakov, 26-DEC-2015.
                if (!isset($value[1]))
                {
                    return false;
                }
                //

                if ($value[1] !== ':')
                {
                    return false;
                }

                // Added by Ivan Tcholakov, 26-DEC-2015.
                if (!isset($value[2]))
                {
                    return false;
                }
                //

                switch ($value[2])
                {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                    break;

                    default:
                        return false;
                }
            case 'N':
                $end .= ';';

                // Added by Ivan Tcholakov, 26-DEC-2015.
                if (!isset($value[$length - 1]))
                {
                    return false;
                }
                //

                if ($value[$length - 1] !== $end[0])
                {
                    return false;
                }
                break;

            default:
                return false;
        }

        if (($result = @unserialize($value)) === false)
        {
            $result = null;
            return false;
        }

        return true;
    }

}

// Taken form http://stackoverflow.com/questions/1252693/using-str-replace-so-that-it-only-acts-on-the-first-match/11400172#11400172
// Author: http://stackoverflow.com/users/526741/bfrohs

if (!function_exists('str_replace_limit')) {

    /**
     * Replace $limit occurences of the search string with the replacement string
     * @param mixed $search The value being searched for, otherwise known as the needle. An
     * array may be used to designate multiple needles.
     * @param mixed $replace The replacement value that replaces found search values. An
     * array may be used to designate multiple replacements.
     * @param mixed $subject The string or array being searched and replaced on, otherwise
     * known as the haystack. If subject is an array, then the search and replace is
     * performed with every entry of subject, and the return value is an array as well.
     * @param string $count If passed, this will be set to the number of replacements
     * performed.
     * @param int $limit The maximum possible replacements for each pattern in each subject
     * string. Defaults to -1 (no limit).
     * @return string This function returns a string with the replaced values.
     */
    function str_replace_limit(
            $search,
            $replace,
            $subject,
            &$count,
            $limit = -1
        ){

        // Set some defaults
        $count = 0;

        // Invalid $limit provided. Throw a warning.
        if(!_str_replace_limit_valid_integer($limit)){
            $backtrace = debug_backtrace();
            trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                    '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting an '.
                    'integer', E_USER_WARNING);
            return $subject;
        }

        // Invalid $limit provided. Throw a warning.
        if($limit<-1){
            $backtrace = debug_backtrace();
            trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                    '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting -1 or '.
                    'a positive integer', E_USER_WARNING);
            return $subject;
        }

        // No replacements necessary. Throw a notice as this was most likely not the intended
        // use. And, if it was (e.g. part of a loop, setting $limit dynamically), it can be
        // worked around by simply checking to see if $limit===0, and if it does, skip the
        // function call (and set $count to 0, if applicable).
        if($limit===0){
            $backtrace = debug_backtrace();
            trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                    '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting -1 or '.
                    'a positive integer', E_USER_NOTICE);
            return $subject;
        }

        // Use str_replace() whenever possible (for performance reasons)
        if($limit===-1){
            return str_replace($search, $replace, $subject, $count);
        }

        if(is_array($subject)){

            // Loop through $subject values and call this function for each one.
            foreach($subject as $key => $this_subject){

                // Skip values that are arrays (to match str_replace()).
                if(!is_array($this_subject)){

                    // Call this function again for
                    $this_function = __FUNCTION__;
                    $subject[$key] = $this_function(
                            $search,
                            $replace,
                            $this_subject,
                            $this_count,
                            $limit
                    );

                    // Adjust $count
                    $count += $this_count;

                    // Adjust $limit, if not -1
                    if($limit!=-1){
                        $limit -= $this_count;
                    }

                    // Reached $limit, return $subject
                    if($limit===0){
                        return $subject;
                    }

                }

            }

            return $subject;

        } elseif(is_array($search)){
            // Only treat $replace as an array if $search is also an array (to match str_replace())

            // Clear keys of $search (to match str_replace()).
            $search = array_values($search);

            // Clear keys of $replace, if applicable (to match str_replace()).
            if(is_array($replace)){
                $replace = array_values($replace);
            }

            // Loop through $search array.
            foreach($search as $key => $this_search){

                // Don't support multi-dimensional arrays (to match str_replace()).
                $this_search = strval($this_search);

                // If $replace is an array, use the value of $replace[$key] as the replacement. If
                // $replace[$key] doesn't exist, just an empty string (to match str_replace()).
                if(is_array($replace)){
                    if(array_key_exists($key, $replace)){
                        $this_replace = strval($replace[$key]);
                    } else {
                        $this_replace = '';
                    }
                } else {
                    $this_replace = strval($replace);
                }

                // Call this function again for
                $this_function = __FUNCTION__;
                $subject = $this_function(
                        $this_search,
                        $this_replace,
                        $subject,
                        $this_count,
                        $limit
                );

                // Adjust $count
                $count += $this_count;

                // Adjust $limit, if not -1
                if($limit!=-1){
                    $limit -= $this_count;
                }

                // Reached $limit, return $subject
                if($limit===0){
                    return $subject;
                }

            }

            return $subject;

        } else {
            $search = strval($search);
            $replace = strval($replace);

            // Get position of first $search
            $pos = strpos($subject, $search);

            // Return $subject if $search cannot be found
            if($pos===false){
                return $subject;
            }

            // Get length of $search, to make proper replacement later on
            $search_len = strlen($search);

            // Loop until $search can no longer be found, or $limit is reached
            for($i=0;(($i<$limit)||($limit===-1));$i++){

                // Replace
                $subject = substr_replace($subject, $replace, $pos, $search_len);

                // Increase $count
                $count++;

                // Get location of next $search
                $pos = strpos($subject, $search);

                // Break out of loop if $needle
                if($pos===false){
                    break;
                }

            }

            // Return new $subject
            return $subject;

        }

    }

}

if (!function_exists('_str_replace_limit_valid_integer')) {

    /**
     * Checks if $string is a valid integer. Integers provided as strings (e.g. '2' vs 2)
     * are also supported.
     * @param mixed $string
     * @return bool Returns boolean TRUE if string is a valid integer, or FALSE if it is not
     */
    function _str_replace_limit_valid_integer($string){
        // 1. Cast as string (in case integer is provided)
        // 1. Convert the string to an integer and back to a string
        // 2. Check if identical (note: 'identical', NOT just 'equal')
        // Note: TRUE, FALSE, and NULL $string values all return FALSE
        $string = strval($string);
        return ($string===strval(intval($string)));
    }

}

// Arrays ----------------------------------------------------------------------

if (!function_exists('get_object_vars_recursive')) {

    // Added by Ivan Tcholakov, 21-MAR-2016.
    function get_object_vars_recursive($data) {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {

            array_walk($data, '_get_object_vars_recursive_callback');
            return $data;
        }

        return null;
    }

}

if (!function_exists('_get_object_vars_recursive_callback')) {

    // Added by Ivan Tcholakov, 21-MAR-2016.
    function _get_object_vars_recursive_callback(& $data) {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            array_walk($data, __FUNCTION__);
        }

        return $data;
    }

}

// The following functions have been borrowed from Laravel framework.
// @link http://laravel.com/

/**
 * Divide an array into two arrays. One with keys and the other with values.
 *
 * @param  array  $array
 * @return array
 */
if (!function_exists('array_divide')) {

    function array_divide($array) {

        return array(array_keys($array), array_values($array));
    }

}

/**
 * Get a subset of the items from the given array.
 *
 * @param  array  $array
 * @param  array  $keys
 * @return array
 */
if (!function_exists('array_only')) {

    function array_only($array, $keys) {

        return array_intersect_key($array, array_flip((array) $keys));
    }

}

/**
 * Get all of the given array except for a specified array of items.
 *
 * @param  array  $array
 * @param  array  $keys
 * @return array
 */
if (!function_exists('array_except')) {

    function array_except($array, $keys) {

        return array_diff_key($array, array_flip((array) $keys));
    }

}

// The following function have been borrowed from
// @link https://github.com/vdw/Compare-arrays

/**
 * Compares two arrays using their common (intersection) keys.
 *
 * @access    public
 * @param     array    a flat associative array
 * @param     array    a flat associative array
 * @return    bool
 */
if (!function_exists('array_intersect_compare')) {

    function array_intersect_compare($array1, $array2) {

        $common_keys = array_intersect_key($array2, $array1);
        $common_values = array_intersect_assoc($array2, $array1);
        $against = array_intersect_key($common_keys, $common_values);

        if ($common_keys == $against) {

            return true;
        }

        return false;
    }

}

if (!function_exists('array_merge_recursive_distinct')) {

    // Ivan Tcholakov, 18-JUN-2020, License: MIT.
    function array_merge_recursive_distinct() {

        $args = func_get_args();

        if (empty($args)) {

            return [];
        }

        $arg0 = array_shift($args);

        if (!is_array($arg0)) {

            throw new InvalidArgumentException('array_merge_recursive_distinct(): Array arguments are expected.');
        }

        $result = array_merge([], $arg0);

        if (empty($args)) {

            return $result;
        }

        foreach ($args as $arr) {

            if (!is_array($arr)) {

                throw new InvalidArgumentException('array_merge_recursive_distinct(): Array arguments are expected.');
            }

            foreach ($arr as $key => $value) {

                if (
                    !is_int($key)
                    &&
                    is_array($value)
                    &&
                    isset($result[$key])
                    &&
                    is_array($result[$key])
                ) {

                    $result[$key] = array_merge_recursive_distinct($result[$key], $value);

                } else {

                    if (is_int($key)) {
                        $result[] = $value;
                    } else {
                        $result[$key] = $value;
                    }
                }
            }
        }

        return $result;
    }

}

// Miscelaneous ----------------------------------------------------------------

/**
 * @author Ivan Tcholakov, 2016-2021
 * @license MIT
 */

if (!function_exists('preg_error_message')) {

    function preg_error_message($code = null) {

        static $preg_last_error_msg_exists = null;

        if (!isset($preg_last_error_msg_exists)) {
            $preg_last_error_msg_exists = function_exists('preg_last_error_msg');
        }

        if ($code === null) {

            if ($preg_last_error_msg_exists) {

                return preg_last_error_msg();
            }

            $code = preg_last_error();
        }

        $code = (int) $code;

        switch ($code) {

            case PREG_NO_ERROR:
                $result = 'PCRE: No error, probably invalid regular expression.';
                break;

            case PREG_INTERNAL_ERROR:
                $result = 'PCRE: Internal error.';
                break;

            case PREG_BACKTRACK_LIMIT_ERROR:
                $result = 'PCRE: Backtrack limit has been exhausted.';
                break;

            case PREG_RECURSION_LIMIT_ERROR:
                $result = 'PCRE: Recursion limit has been exhausted.';
                break;

            case PREG_BAD_UTF8_ERROR:
                $result = 'PCRE: Malformed UTF-8 data.';
                break;

            default:

                if (is_php('5.3') && $code == PREG_BAD_UTF8_OFFSET_ERROR) {
                    $result = 'PCRE: Did not end at a valid UTF-8 codepoint.';
                }
                elseif (is_php('7') && $code == PREG_JIT_STACKLIMIT_ERROR) {
                    $result = 'PCRE: Failed because of limited JIT stack space.';
                }
                else {
                    $result = 'PCRE: Error '.$code.'.';
                }

                break;
        }

        return $result;
    }

}
