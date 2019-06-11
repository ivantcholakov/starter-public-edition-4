<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_DateTime {

    public static function timespan($timestamp = null) {

        $timestamp = isset($timestamp) ? $timestamp : now();

        return timespan($timestamp, time());
    }

}
