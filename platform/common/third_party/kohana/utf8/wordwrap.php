<?php

/**
 * UTF8::wordwrap
 * Taken and adapted form Zend Framework by Ivan Tcholakov, 2015.
 *
 * @param       string          The input string.
 * @param       int             The number of characters at which the string will be wrapped.
 * @param       string          The line is broken using the optional break parameter.
 * @param       bool            If the cut is set to TRUE, the string is always wrapped at or before the specified width.
 * @return      string|false
 * @license     @license        http://framework.zend.com/license/new-bsd New BSD License
 */
function _wordwrap($string, $width = 75, $break = "\n", $cut = false) {

    $string = @ (string) $string;

    if ($string === '') {
        return '';
    }

    $break = @ (string) $break;

    if ($break === '') {

        trigger_error('UTF8::wordwrap(): Break string cannot be empty.', E_USER_WARNING);

        return false;
    }

    $width = (int) $width;

    if ($width === 0 && $cut) {

        trigger_error('UTF8::wordwrap(): Cannot force cut when width is zero.', E_USER_WARNING);

        return false;
    }

    $string_length = UTF8::strlen($string);
    $break_length = UTF8::strlen($break);

    $result = '';
    $last_start = 0;
    $last_space = 0;

    for ($current = 0; $current < $string_length; $current++) {

        $char = UTF8::substr($string, $current, 1);
        $possible_break = $char;

        if ($break_length !== 1) {
            $possible_break = UTF8::substr($string, $current, $break_length);
        }

        if ($possible_break === $break) {

            $result .= UTF8::substr($string, $last_start, $current - $last_start + $break_length);
            $current += $break_length - 1;
            $last_start = $last_space = $current + 1;

            continue;
        }

        if ($char === ' ') {

            if ($current - $last_start >= $width) {

                $result .= UTF8::substr($string, $last_start, $current - $last_start).$break;
                $last_start = $current + 1;
            }

            $last_space = $current;

            continue;
        }

        if ($current - $last_start >= $width && $cut && $last_start >= $last_space) {

            $result .= UTF8::substr($string, $last_start, $current - $last_start).$break;
            $last_start = $last_space = $current;

            continue;
        }

        if ($current - $last_start >= $width && $last_start < $last_space) {

            $result .= UTF8::substr($string, $last_start, $last_space - $last_start).$break;
            $last_start = $last_space = $last_space + 1;

            continue;
        }
    }

    if ($last_start !== $current) {
        $result .= UTF8::substr($string, $last_start, $current - $last_start);
    }

    return $result;
}
