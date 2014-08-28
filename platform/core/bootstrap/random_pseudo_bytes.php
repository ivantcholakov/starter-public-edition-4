<?php

if (!function_exists('random_pseudo_bytes')) {

    /**
     * This is a fallback function for openssl_random_pseudo_bytes().
     * See @link http://php.net/manual/en/function.openssl-random-pseudo-bytes.php
     *
     * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
     * @license The MIT License, http://opensource.org/licenses/MIT
     */
    function random_pseudo_bytes($length, & $crypto_strong = null, & $method = null) {

        if (!(ctype_digit((string) $length) && ($length = (int) $length) > 0)) {

            $crypto_strong = null;
            $method = null;

            return false;
        }

        static $detected_method = null;
        static $is_windows = null;

        if (!isset($is_windows)) {
            $is_windows = strtolower(substr(php_uname('s'), 0, 3 )) === 'win';
        }

        if (!isset($is_php_5_3_0)) {
            $is_php_5_3_0 = version_compare(PHP_VERSION, '5.3.0', '>=');
        }

        if (!isset($is_php_5_3_4)) {
            $is_php_5_3_4 = version_compare(PHP_VERSION, '5.3.4', '>=');
        }

        //----------------------------------------------------------------------

        // Try to use openssl_random_pseudo_bytes()

        if (!isset($detected_method) && function_exists('openssl_random_pseudo_bytes')) {

            // See http://stackoverflow.com/questions/1940168/openssl-random-pseudo-bytes-is-slow-php
            // See http://php.net/ChangeLog-5.php#5.3.4
            // "Fixed possible blocking behavior in openssl_random_pseudo_bytes on Windows. (Pierre)"

            if (!$is_windows || ($is_windows && $is_php_5_3_4)) {

                $test = openssl_random_pseudo_bytes(8, $crypto_strong);

                if ($crypto_strong === true) {
                    $detected_method = 'openssl_random_pseudo_bytes';
                }
            }
        }

        if ($detected_method === 'openssl_random_pseudo_bytes') {

            $result = openssl_random_pseudo_bytes($length, $crypto_strong);
            $method = $detected_method;

            return $result;
        }

        //----------------------------------------------------------------------

        // Try to use mcrypt extension.

        // See http://php.net/manual/en/function.mcrypt-create-iv.php

        if (
            !isset($detected_method)
            && function_exists('mcrypt_create_iv') && defined('MCRYPT_DEV_URANDOM')
            && (!$is_windows || ($is_windows && $is_php_5_3_0))
        ) {

            $test = mcrypt_create_iv(8, MCRYPT_DEV_URANDOM);

            if ($test !== false) {
                $detected_method = 'mcrypt_dev_urandom';
            }
        }

        if ($detected_method === 'mcrypt_dev_urandom') {

            if (!$is_php_5_3_0) {
                srand();
            }

            $result = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
            $crypto_strong = true;
            $method = $detected_method;

            return $result;
        }

        //----------------------------------------------------------------------

        // Try to use dev/urandom special file.

        if (!isset($detected_method)) {

            $fp = @fopen('/dev/urandom', 'rb');

            if ($fp !== false) {

                $test = @fread($fp, 8);
                @fclose($fp);

                if ($test !== false) {
                    $detected_method = 'dev_urandom';
                }
            }
        }

        if ($detected_method === 'dev_urandom') {

            $fp = fopen('/dev/urandom', 'rb');
            $result = fread($fp, $length);
            fclose($fp);

            $crypto_strong = true;
            $method = $detected_method;

            return $result;
        }

        //----------------------------------------------------------------------

        // A PHP fallback code is the last option.

        $crypto_strong = false;
        $detected_method = 'php_fallback';
        $method = $detected_method;

        // Borrowed from http://phpseclib.com/

        $result = '';

        for ($i = 0; $i < $length; $i++) {

            $sha = hash('sha256', mt_rand());
            $char = mt_rand(0, 30);
            $result .= chr(hexdec($sha[$char].$sha[$char + 1]));
        }

        return $result;
    }

}
