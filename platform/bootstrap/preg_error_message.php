<?php

/**
 * @author Ivan Tcholakov, 2016
 * @license MIT
 */

if (!function_exists('preg_error_message')) {

    function preg_error_message($code = null) {

        if ($code === null) {
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
