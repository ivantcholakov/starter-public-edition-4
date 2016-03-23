<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Random class
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2016.
 * @license The MIT License (MIT), http://opensource.org/licenses/MIT
 */

class Random {

    public static function boolean() {

        return (bool) (ord(self::bytes(1)) % 2);
    }

    public static function bytes($length) {

        if (!(ctype_digit(@ (string) $length) && ($length = (int) $length) > 0)) {
            throw new InvalidArgumentException('Random::bytes(): A positive integer value as parameter is expected.');
        }

        $result = get_instance()->security->get_random_bytes($length);

        if ($result === false) {
            throw new Exception('Random::bytes(): There is no suitable CSPRNG installed on your system.');
        }

        return $result;
    }

    // Generate random float (0..1)
    public static function float() {

        $bytes = self::bytes(7);
        $bytes[6] = $bytes[6] | chr(0xF0);
        $bytes .= chr(63);
        list(, $float) = unpack('d', $bytes);

        return ($float - 1);
    }

    public static function int($min, $max) {

        // See https://paragonie.com/blog/2015/07/how-safely-generate-random-strings-and-integers-in-php

        // TODO: Check the algorithm for the case when PHP_INT_MIN !== ~PHP_INT_MAX

        $php_int_min = defined('PHP_INT_MIN') ? PHP_INT_MIN : ~PHP_INT_MAX;
        $php_int_max = PHP_INT_MAX;
        $php_int_size = PHP_INT_SIZE;

        if (is_numeric($max)) {
            $max += 0;
        }

        if (is_float($max) && $max >= $php_int_min && $max <= $php_int_max) {
            $max = (int) $max;
        }

        if (is_numeric($min)) {
            $min += 0;
        }

        if (is_float($min) && $min >= $php_int_min && $min <= $php_int_max) {
            $min = (int) $min;
        }

        if (!is_int($max)) {
            throw new InvalidArgumentException(
               'Random::int(): Maximum value must be an integer within ['.$php_int_min.', '.$php_int_max.'] range.'
            );
        }

        if (!is_int($min)) {
            throw new InvalidArgumentException(
               'Random::int(): Minimum value must be an integer within ['.$php_int_min.', '.$php_int_max.'] range.'
            );
        }

        if ($min > $max) {
            throw new InvalidArgumentException(
                'Random::int(): Minimum value must be less than or equal to the maximum value.'
            );
        }

        if ($max === $min) {
            return $min;
        }

        $offset = 0;
        $mask = 0;
        $bits = 0;
        $bytes = 0;

        $range = $max - $min;

        if (!is_int($range)) {

            // Integer overflow, still safely calculate wider ranges.
            // See https://gist.github.com/CodesInChaos/03f9ea0b58e8b2b8d435
            // See https://eval.in/400356
            // See http://3v4l.org/XX9r5

            $bytes = $php_int_size;
            $mask = ~0;

        } else {

            // $bits is effectively ceil(log($range, 2)) without dealing with type juggling.

            while ($range > 0) {

                if ($bits % 8 === 0) {
                   ++$bytes;
                }

                ++$bits;
                $range >>= 1;
                $mask = $mask << 1 | 1;
            }

            $offset = $min;
        }

        $attempts = 0;

        // Generate random integers until one falls between $min and $max.

        do {

            // The rejection probability is at most 0.5, so this corresponds
            // to a failure probability of 2^-128 for a working RNG.
            if ($attempts > 128) {
                throw new Exception(
                    'Random::int(): RNG is broken - too many rejections.'
                );
            }

            // Getting random bytes and turning them into an integer.

            $random_bytes = self::bytes($bytes);
            $val = 0;

            for ($i = 0; $i < $bytes; ++$i) {
                $val |= ord($random_bytes[$i]) << ($i * 8);
            }

            $val &= $mask;
            $val += $offset;

            // If $val overflows to a floating point number, or is larger than $max,
            // or smaller than $min, then try again.

            ++$attempts;

        } while (!is_int($val) || $val > $max || $val < $min);

        return (int) $val;
    }

    public static function string($length, $charlist = null) {

        if (!(ctype_digit(@ (string) $length) && ($length = (int) $length) > 0)) {
            throw new InvalidArgumentException('Random::string(): A positive integer value as parameter is expected.');
        }

        if (empty($charlist)) {
            return substr(rtrim(base64_encode(self::bytes(ceil($length * 0.75))), '='), 0, $length);
        }

        if (!is_array($charlist)) {

            if (IS_UTF8_CHARSET) {
                $charlist = UTF8::str_split(@ (string) $charlist);
            } else {
                $charlist = str_split(@ (string) $charlist);
            }
        }

        $charlist_length = count($charlist);

        if ($charlist_length == 1) {
            return str_repeat($charlist[0], $length);
        }

        $bytes  = self::bytes($length);

        $pos = 0;
        $result = array();

        for ($i = 0; $i < $length; $i++) {

            $pos = ($pos + ord($bytes[$i])) % $charlist_length;
            $result[$i] = $charlist[$pos];
        }

        return implode('', $result);
    }

    //--------------------------------------------------------------------------

    // Deprecated methods, for BC. TODO: Remove them.

    public static function get() {

        return self::float();
    }

    public static function integer($multiplier) {

        return floor(((int) $multiplier) * self::float());
    }

    public static function integer_between($min = 0, $max = 1) {

        return self::int($min, $max);
    }

    // See http://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid/2040279#2040279
    public static function uuid() {

        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            self::int( 0, 0xffff ), self::int( 0, 0xffff ),

            // 16 bits for "time_mid"
            self::int( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            self::int( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            self::int( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            self::int( 0, 0xffff ), self::int( 0, 0xffff ), self::int( 0, 0xffff )
        );
    }

}
