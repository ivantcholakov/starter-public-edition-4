<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('humanize') && IS_UTF8_CHARSET) {

    /**
     * Humanize
     *
     * Takes multiple words separated by the separator and changes them to spaces
     *
     * @param       string      $str            Input string
     * @param       string      $separator      Input separator
     * @return      string
     */
    function humanize($str, $separator = '_')
    {
        return UTF8::ucwords(preg_replace('/['.$separator.']+/'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), ' ', trim(UTF8::strtolower($str))));
    }

}
