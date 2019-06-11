<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * GibberishAES 256-bit, Integration for CodeIgniter.
 * See https://github.com/ivantcholakov/gibberish-aes-php
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Gibberish {

    protected $key;

    public function __construct() {

        $this->key = bin2hex(config_item('encryption_key_256'));

        log_message('debug', 'Gibberish class initialized');
    }

    public function encrypt($string, $encryption_key = null) {

        $string = (string) $string;
        $encryption_key = $encryption_key === null ? $this->key : (string) $encryption_key;

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);

        $result = GibberishAES::enc($string, $encryption_key);

        GibberishAES::size($old_key_size);

        return $result;
    }

    public function decrypt($string, $encryption_key = null) {

        $string = (string) $string;
        $encryption_key = $encryption_key === null ? $this->key : (string) $encryption_key;

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);

        $result = GibberishAES::dec($string, $encryption_key);

        GibberishAES::size($old_key_size);

        return $result;
    }

}
