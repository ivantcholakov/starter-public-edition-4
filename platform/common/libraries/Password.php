<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Password {

    protected $key;

    public function __construct() {

        $this->key = (string) config_item('encryption_key_for_passwords');

        log_message('debug', 'Password class initialized');
    }

    // Added by Ivan Tcholakov, 11-JUL-2014.
    // $min_length is not allowed to be less than 4.
    // If it not set, $max_length is assumed to be equal to $min_length.
    // $characters is a string representing the set of charactes that a password may contain.
    // if $characters is not set, then a custom string of the allowed charaters is used internally.
    public function create($min_length = 10, $max_length = null, $characters = null) {

        $min_length = (int) $min_length;

        if ($min_length < 4) {
            $min_length = 4;
        }

        if ($max_length === null) {

            $max_length = $min_length;

        } else {

            $max_length = (int) $max_length;

            if ($max_length < $min_length) {
                $max_length = $min_length;
            }
        }

        $length = mt_rand($min_length, $max_length);

        $characters = (string) $characters;

        if ($characters == '') {
            $characters = "!#$%+-0123456789=?@ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        }

        return PasswordGenerator::getCustomPassword(str_split($characters), $length);
    }

    //--------------------------------------------------------------------------

    // An important note: Use the methods hash() and verify() for dealing with
    // users' passwords. Users' passwords should be hashed, not encrypted.

    // See http://www.openwall.com/phpass/
    public function hash($password) {

        $password = (string) $password;

        // Don't allow empty passwords, on creation use validation for not accepting them.
        if ($password == '') {
            return '';
        }

        $hasher = new PasswordHash(8, false);

        return $hasher->HashPassword($password);
    }

    // See http://www.openwall.com/phpass/
    public function verify($password, $hash) {

        $password = (string) $password;
        $hash = (string) $hash;

        // Don't allow empty passwords, on creation use validation for not accepting them.
        if ($hash == '' || $password == '') {
            return false;
        }

        $hasher = new PasswordHash(8, false);

        return $hasher->CheckPassword($password, $hash) ? true : false;
    }

    //--------------------------------------------------------------------------

    // An important note: Use the methods encrypt() and decrypt() for passwords
    // that the system should pass to other systems. For example, you may choose
    // to store the SMTP password as a setting within the database, preferably
    // not in plain text.
    // Don't use these methods for dealing with users' passwords!

    // See https://github.com/ivantcholakov/gibberish-aes-php
    public function encrypt($password) {

        $password = (string) $password;

        // Don't allow empty passwords, on creation use validation for not accepting them.
        if ($password == '') {
            return '';
        }

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);

        $result = GibberishAES::enc($password, $this->key);

        GibberishAES::size($old_key_size);

        return $result;
    }

    // See https://github.com/ivantcholakov/gibberish-aes-php
    public function decrypt($password) {

        $password = (string) $password;

        // Don't allow empty passwords, on creation use validation for not accepting them.
        if ($password == '') {
            return '';
        }

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);

        $result = GibberishAES::dec($password, $this->key);

        GibberishAES::size($old_key_size);

        return $result;
    }

}
