<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UTF-8 alternatives to CodeIgniter's text helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('character_limiter') && IS_UTF8_CHARSET) {

    /**
     * Character Limiter, UTF-8 version.
     *
     * Limits the string based on the character count. Preserves complete words
     * so the character count may not be exactly as specified.
     *
     * @param       string
     * @param       int
     * @param       string    The end character. Usually an ellipsis
     * @return      string
     */
    function character_limiter($str, $n = 500, $end_char = '&#8230;') {

        if (UTF8::strlen($str) < $n) {
            return $str;
        }

        // a bit complicated, but faster than preg_replace with \s+
        //$str = preg_replace('/ {2,}/', ' ', str_replace(array("\r", "\n", "\t", "\x0B", "\x0C"), ' ', $str));
        $str = preg_replace('/\s+/u', ' ', $str);

        if (UTF8::strlen($str) <= $n) {
            return $str;
        }

        $out = '';

        foreach (explode(' ', trim($str)) as $val) {

            $out .= $val.' ';

            if (UTF8::strlen($out) >= $n) {
                $out = trim($out);
                return (UTF8::strlen($out) === UTF8::strlen($str)) ? $out : $out.$end_char;
            }
        }
    }

}
