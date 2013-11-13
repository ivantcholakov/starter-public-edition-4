<?php

if (!function_exists('openssl_random_pseudo_bytes')) {

    /**
     * For PHP 5 < 5.3.0 (backward compatibility)
     * (see @link http://php.net/manual/en/function.openssl-random-pseudo-bytes.php)
     * Borrowed from @link http://phpseclib.com/
     *
     * @see openssl_random_pseudo_bytes()
     */
    function openssl_random_pseudo_bytes($length, & $crypto_strong = null) {

        $crypto_strong = false;

        $rnd = '';

        for ($i = 0; $i < $length; $i++) {

            $sha = hash('sha256', mt_rand());
            $char = mt_rand(0, 30);
            $rnd .= chr(hexdec($sha[$char].$sha[$char + 1]));
        }

        return $rnd;
    }

}
