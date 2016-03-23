<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Gibberish AES, a PHP Implementation
 *
 * See Gibberish AES javascript encryption library, @link https://github.com/mdp/gibberish-aes
 *
 * An important note: The complementary JavaScript project Gibberish AES has been
 * deprecated, see https://github.com/mdp/gibberish-aes/issues/25
 * Consider finding alternative PHP and JavaScript solutions.
 *
 * This implementation is based on initial code proposed by nbari at dalmp dot com
 * @link http://www.php.net/manual/en/function.openssl-decrypt.php#107210
 *
 * Requirements:
 *
 * OpenSSL functions installed and PHP version >= 5.3.3
 * or
 * Mcrypt functions installed.
 *
 * For PHP under version 7 it is recommendable you to install within your project
 * "PHP 5.x support for random_bytes() and random_int()",
 * @link https://github.com/paragonie/random_compat
 *
 * Usage:
 *
 * // This is a secret pass-phrase, keep it in a safe place and don't loose it.
 * $pass = 'my secret pass-phrase, it should be long';
 *
 * // The string to be encrypted.
 * $string = 'my secret message';
 *
 * // This is the result after encryption of the given string.
 * $encrypted_string = GibberishAES::enc($string, $pass);
 *
 * // This is the result after decryption of the previously encrypted string.
 * // $decrypted_string == $string (should be).
 * $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
 * echo $decrypted_string;
 *
 * // The default key-size is 256 bits. 128 and 192 bits are also allowed.
 * // Example:
 * $old_key_size = GibberishAES::size();
 * GibberishAES::size(192);
 * // The short way: $old_key_size = GibberishAES::size(192);
 * $encrypted_string = GibberishAES::enc($string, $pass);
 * $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
 * GibberishAES::size($old_key_size);
 * echo $decrypted_string;
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2016.
 * Code repository: @link https://github.com/ivantcholakov/gibberish-aes-php
 *
 * @version 1.3.0-dev
 *
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

class GibberishAES {

    // The default key size in bits.
    protected static $key_size = 256;

    // The allowed key sizes in bits.
    protected static $valid_key_sizes = array(128, 192, 256);

    protected static $random_bytes_exists = null;
    protected static $openssl_encrypt_exists = null;
    protected static $openssl_decrypt_exists = null;
    protected static $mcrypt_exists = null;
    protected static $mbstring_func_overload = null;

    // This is a static class, instances are disabled.
    final private function __construct() {}
    final private function __clone() {}

    /**
     * Crypt AES (256, 192, 128)
     *
     * @param   string  $string     The input message to be encrypted.
     * @param   string  $pass       The secret pass-phrase, choose a long string
     *                              (64 characters for example) for keeping high entropy.
     *                              The pass-phrase is converted internaly into
     *                              a binary key that is to be used for encryption.
     * @return  mixed               base64 encrypted string, FALSE on failure.
     */
    public static function enc($string, $pass) {

        $key_size = self::$key_size;

        // Set a random salt.
        $salt = self::random_bytes(8);

        $salted = '';
        $dx = '';

        // Lengths in bytes:
        $key_length = (int) ($key_size / 8);
        $block_length = 16; // 128 bits, iv has the same length.
        // $salted_length = $key_length (32, 24, 16) + $block_length (16) = (48, 40, 32)
        $salted_length = $key_length + $block_length;

        while (self::strlen($salted) < $salted_length) {

            $dx = md5($dx.$pass.$salt, true);
            $salted .= $dx;
        }

        $key = self::substr($salted, 0, $key_length);
        $iv = self::substr($salted, $key_length, $block_length);

        $encrypted = self::aes_cbc_encrypt($string, $key, $iv);

        return $encrypted !== false ? base64_encode('Salted__'.$salt.$encrypted) : false;
    }

    /**
     * Decrypt AES (256, 192, 128)
     *
     * @param   string  $string     The input message to be decrypted.
     * @param   string  $pass       The secret pass-phrase that has been used for encryption.
     * @return  mixed               base64 decrypted string, FALSE on failure.
     */
    public static function dec($string, $pass) {

        $key_size = self::$key_size;

        // Lengths in bytes:
        $key_length = (int) ($key_size / 8);
        $block_length = 16;

        $data = base64_decode($string);
        $salt = self::substr($data, 8, 8);
        $encrypted = self::substr($data, 16);

        /**
         * From https://github.com/mdp/gibberish-aes
         *
         * Number of rounds depends on the size of the AES in use
         * 3 rounds for 256
         *     2 rounds for the key, 1 for the IV
         * 2 rounds for 128
         *     1 round for the key, 1 round for the IV
         * 3 rounds for 192 since it's not evenly divided by 128 bits
         */
        $rounds = 3;
        if ($key_size == 128) {
            $rounds = 2;
        }

        $data00 = $pass.$salt;
        $md5_hash = array();
        $md5_hash[0] = md5($data00, true);
        $result = $md5_hash[0];

        for ($i = 1; $i < $rounds; $i++) {

            $md5_hash[$i] = md5($md5_hash[$i - 1].$data00, true);
            $result .= $md5_hash[$i];
        }

        $key = self::substr($result, 0, $key_length);
        $iv = self::substr($result, $key_length, $block_length);

        return self::aes_cbc_decrypt($encrypted, $key, $iv);
    }

    /**
     * Sets the key-size for encryption/decryption in number of bits
     * @param   mixed       $newsize    The new key size. The valid integer values are: 128, 192, 256 (default)
     *                                  $newsize may be NULL or may be omited - in this case
     *                                  this method is just a getter of the current key size value.
     * @return  integer                 Returns the old key size value.
     */
    public static function size($newsize = null) {

        $result = self::$key_size;

        if (is_null($newsize)) {
            return $result;
        }

        $newsize = (string) $newsize;

        if ($newsize == '') {
            return $result;
        }

        $valid_integer = ctype_digit($newsize);

        $newsize = (int) $newsize;

        if (!$valid_integer || !in_array($newsize, self::$valid_key_sizes)) {
            trigger_error('GibberishAES: Invalid key size value was to be set. It should be an integer value (number of bits) amongst: '.implode(', ', self::$valid_key_sizes).'.', E_USER_WARNING);
        } else {
            self::$key_size = $newsize;
        }

        return $result;
    }

    // Non-public methods ------------------------------------------------------

    protected static function random_bytes_exists() {

        if (!isset(self::$random_bytes_exists)) {

            self::$random_bytes_exists = false;

            if (function_exists('random_bytes')) {

                try
                {
                    $test = random_bytes(1);
                    self::$random_bytes_exists = true;
                }
                catch (Exception $e) {
                    // Do nothing.
                }
            }
        }

        return self::$random_bytes_exists;
    }

    protected static function openssl_encrypt_exists() {

        if (!isset(self::$openssl_encrypt_exists)) {
            self::$openssl_encrypt_exists = function_exists('openssl_encrypt')
                // We need the $iv parameter.
                && version_compare(PHP_VERSION, '5.3.3', '>=');
        }

        return self::$openssl_encrypt_exists;
    }

    protected static function openssl_decrypt_exists() {

        if (!isset(self::$openssl_decrypt_exists)) {
            self::$openssl_decrypt_exists = function_exists('openssl_decrypt')
                // We need the $iv parameter.
                && version_compare(PHP_VERSION, '5.3.3', '>=');
        }

        return self::$openssl_decrypt_exists;
    }

    protected static function mcrypt_exists() {

        if (!isset(self::$mcrypt_exists)) {
            self::$mcrypt_exists = function_exists('mcrypt_encrypt');
        }

        return self::$mcrypt_exists;
    }

    protected static function is_windows() {

        // Beware about 'Darwin'.
        return 0 === stripos(PHP_OS, 'win');
    }

    protected static function mbstring_func_overload() {

        if (!isset(self::$mbstring_func_overload)) {
            self::$mbstring_func_overload = extension_loaded('mbstring') && ini_get('mbstring.func_overload');
        }

        return self::$mbstring_func_overload;
    }

    protected static function strlen($str) {

        return self::mbstring_func_overload() ? mb_strlen($str, '8bit') : strlen($str);
    }

    protected static function substr($str, $start, $length = null) {

        if (self::mbstring_func_overload()) {

            // mb_substr($str, $start, null, '8bit') returns an empty string on PHP 5.3
            isset($length) OR $length = ($start >= 0 ? self::strlen($str) - $start : -$start);

            return mb_substr($str, $start, $length, '8bit');
        }

        return isset($length) ? substr($str, $start, $length) : substr($str, $start);
    }

    protected static function random_bytes($length) {

        $length = (int) $length;

        if (self::random_bytes_exists()) {

            try
            {
                return random_bytes($length);
            }
            catch (Exception $e) {
                // Do nothing, continue.
            }
        }

        // Rename the parameter on order it to fit with the code below.
        $len = $length;

        /*
         * The following code fragment has been taken from Secure-random-bytes-in-PHP
         * project, released under the New BSD License.
         * @see https://github.com/GeorgeArgyros/Secure-random-bytes-in-PHP
         *
         *
         *
         * Author:
         * George Argyros <argyros.george@gmail.com>
         *
         * Copyright (c) 2012, George Argyros
         * All rights reserved.
         *
         * Redistribution and use in source and binary forms, with or without
         * modification, are permitted provided that the following conditions are met:
         *    * Redistributions of source code must retain the above copyright
         *      notice, this list of conditions and the following disclaimer.
         *    * Redistributions in binary form must reproduce the above copyright
         *      notice, this list of conditions and the following disclaimer in the
         *      documentation and/or other materials provided with the distribution.
         *    * Neither the name of the <organization> nor the
         *      names of its contributors may be used to endorse or promote products
         *      derived from this software without specific prior written permission.
         *
         * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
         * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
         * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
         * DISCLAIMED. IN NO EVENT SHALL GEORGE ARGYROS BE LIABLE FOR ANY
         * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
         * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
         * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
         * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
         * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
         * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
         *
         *
         *
         * The function is providing, at least at the systems tested :),
         * $len bytes of entropy under any PHP installation or operating system.
         * The execution time should be at most 10-20 ms in any system.
         */

        $SSLstr = '4'; // http://xkcd.com/221/

        /*
         * No build-in crypto randomness function found. We collect any entropy
         * available in the PHP core PRNGs along with some filesystem info and memory
         * stats. To make this data cryptographically strong we add data either from
         * /dev/urandom or if its unavailable, we gather entropy by measuring the
         * time needed to compute a number of SHA-1 hashes.
         */
        $str = '';
        $bits_per_round = 2; // bits of entropy collected in each clock drift round
        $msec_per_round = 400; // expected running time of each round in microseconds
        $hash_len = 20; // SHA-1 Hash length
        $total = $len; // total bytes of entropy to collect
        $handle = @fopen('/dev/urandom', 'rb');
        if ($handle && function_exists('stream_set_read_buffer')) {
            @stream_set_read_buffer($handle, 0);
        }

        do {
            $bytes = ($total > $hash_len) ? $hash_len : $total;
            $total -= $bytes;
            //collect any entropy available from the PHP system and filesystem
            $entropy = rand() . uniqid(mt_rand(), true) . $SSLstr;
            $entropy .= implode('', @fstat(@fopen(__FILE__, 'r')));
            $entropy .= memory_get_usage() . getmypid();
            $entropy .= serialize($_ENV) . serialize($_SERVER);
            if (function_exists('posix_times')) {
                $entropy .= serialize(posix_times());
            }
            if (function_exists('zend_thread_id')) {
                $entropy .= zend_thread_id();
            }
            if ($handle) {
                $entropy .= @fread($handle, $bytes);
            } else {
                // Measure the time that the operations will take on average
                for ($i = 0; $i < 3; $i++) {
                    $c1 = microtime(true);
                    $var = sha1(mt_rand());
                    for ($j = 0; $j < 50; $j++) {
                        $var = sha1($var);
                    }
                    $c2 = microtime(true);
                    $entropy .= $c1 . $c2;
                }
                // Based on the above measurement determine the total rounds
                // in order to bound the total running time.
                $rounds = (int) ($msec_per_round * 50 / (int) (($c2 - $c1) * 1000000));
                // Take the additional measurements. On average we can expect
                // at least $bits_per_round bits of entropy from each measurement.
                $iter = $bytes * (int) (ceil(8 / $bits_per_round));
                for ($i = 0; $i < $iter; $i++) {
                    $c1 = microtime();
                    $var = sha1(mt_rand());
                    for ($j = 0; $j < $rounds; $j++) {
                        $var = sha1($var);
                    }
                    $c2 = microtime();
                    $entropy .= $c1 . $c2;
                }
            }
            // We assume sha1 is a deterministic extractor for the $entropy variable.
            $str .= sha1($entropy, true);

        // Modified by Ivan Tcholakov, 16-MAR-2015.
        //} while ($len > strlen($str));
        } while ($len > self::strlen($str));
        //

        if ($handle) {
            @fclose($handle);
        }

        // Modified by Ivan Tcholakov, 16-MAR-2015.
        //return substr($str, 0, $len);
        return self::substr($str, 0, $len);
        //

        /*
         * End of code fragment from Secure-random-bytes-in-PHP project.
         */
    }

    protected static function aes_cbc_encrypt($string, $key, $iv) {

        $key_size = self::$key_size;

        if (self::openssl_encrypt_exists()) {
            return openssl_encrypt($string, "aes-$key_size-cbc", $key, true, $iv);
        }

        if (self::mcrypt_exists()) {

            // Info: http://www.chilkatsoft.com/p/php_aes.asp
            // http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation

            $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');

            if (mcrypt_generic_init($cipher, $key, $iv) != -1) {

                $encrypted = mcrypt_generic($cipher, self::pkcs7_pad($string));
                mcrypt_generic_deinit($cipher);
                mcrypt_module_close($cipher);

                return $encrypted;
            }

            return false;
        }

        trigger_error('GibberishAES: System requirements failure, please, check them.', E_USER_WARNING);

        return false;
    }

    protected static function aes_cbc_decrypt($crypted, $key, $iv) {

        $key_size = self::$key_size;

        if (self::openssl_decrypt_exists()) {
            return openssl_decrypt($crypted, "aes-$key_size-cbc", $key, true, $iv);
        }

        if (self::mcrypt_exists()) {

            $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');

            if (mcrypt_generic_init($cipher, $key, $iv) != -1) {

                $decrypted = mdecrypt_generic($cipher, $crypted);
                mcrypt_generic_deinit($cipher);
                mcrypt_module_close($cipher);

                return self::remove_pkcs7_pad($decrypted);
            }

            return false;
        }

        trigger_error('GibberishAES: System requirements failure, please, check them.', E_USER_WARNING);

        return false;
    }

    // See http://www.php.net/manual/en/function.mcrypt-decrypt.php#105985

    protected static function pkcs7_pad($string) {

        // 128 bits: $block_length = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $block_length = 16;
        $pad = $block_length - (self::strlen($string) % $block_length);

        return $string.str_repeat(chr($pad), $pad);
    }

    protected static function remove_pkcs7_pad($string) {

        // 128 bits: $block_length = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $block_length = 16;
        $len = self::strlen($string);
        $pad = ord($string[$len - 1]);

        if ($pad > 0 && $pad <= $block_length) {

            $valid_pad = true;

            for ($i = 1; $i <= $pad; $i++) {

                if (ord($string[$len - $i]) != $pad) {
                    $valid_pad = false;
                    break;
                }
            }

            if ($valid_pad) {
                $string = self::substr($string, 0, $len - $pad);
            }
        }

        return $string;
    }

}
