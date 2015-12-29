<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UTF-8 alternatives to CodeIgniter's text helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
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

if (!function_exists('convert_accented_characters') && IS_UTF8_CHARSET) {

    /**
     * Converts (Accented) Foreign Characters to ASCII
     *
     * @param   string  $string     Input string
     * @param   string  $language   Language identificator
     * @return  string
     */
    function convert_accented_characters($string, $language = null) {

        $language = (string) $language;

        if ($language == '') {
            $language = config_item('language');
        }

        // See https://github.com/ivantcholakov/transliterate
        return Transliterate::to_ascii($string, $language);
    }

}

if (!function_exists('ellipsize') && IS_UTF8_CHARSET)
{
    /**
     * Ellipsize String (UTF-8 compatible version)
     *
     * This function will strip tags from a string, split it at its max_length and ellipsize
     *
     * @param   string      string to ellipsize
     * @param   int         max length of string
     * @param   mixed       int (1|0) or float, .5, .2, etc for position to split
     * @param   string      ellipsis ; Default '...'
     * @return  string      ellipsized string
     */
    function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;')
    {
        // Strip tags
        $str = trim(strip_tags($str));

        // Added by Ivan Tcholakov, 07-JAN-2014.
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        //

        // Is the string long enough to ellipsize?
        if (UTF8::strlen($str) <= $max_length)
        {
            return $str;
        }

        $beg = UTF8::substr($str, 0, floor($max_length * $position));
        $position = ($position > 1) ? 1 : $position;

        if ($position === 1)
        {
            $end = UTF8::substr($str, 0, -($max_length - UTF8::strlen($beg)));
        }
        else
        {
            $end = UTF8::substr($str, -($max_length - UTF8::strlen($beg)));
        }

        return $beg.$ellipsis.$end;
    }
}

if (!function_exists('word_limiter') && IS_UTF8_CHARSET) {

    /**
     * Word Limiter, UTF-8 version.
     *
     * Limits a string to X number of words.
     *
     * @param       string
     * @param       int
     * @param       string    The end character. Usually an ellipsis
     * @return      string
     */
    function word_limiter($str, $limit = 100, $end_char = '&#8230;')
    {
        if (UTF8::trim($str) === '')
        {
            return $str;
        }

        preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), $str, $matches);

        if (UTF8::strlen($str) === UTF8::strlen($matches[0]))
        {
            $end_char = '';
        }

        return UTF8::rtrim($matches[0]).$end_char;
    }

}
