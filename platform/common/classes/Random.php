<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Random class
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, FEB-2012.
 * @license The MIT License (MIT), http://opensource.org/licenses/MIT
 *
 * The API of this class complements with my jQuery.random javasript plugin.
 */

class Random {

    public static function get() {

        return lcg_value();
    }

    public static function integer($multiplier) {

        return floor(((int) $multiplier) * self::get());
    }

    public static function integer_between($min = 0, $max = 1) {

        $min = (int) $min;
        $max = (int) $max;

        if (empty($max)) {
            $max = 1;
        }

        return mt_rand($min, $max);
    }

    // See http://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid/2040279#2040279
    public static function uuid() {

        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}
