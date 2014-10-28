<?php

/**
 * Server Name Detection Routine
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('detect_host')) {

    function detect_host() {

        return

            isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME']
                : (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
                // The regular expression is only a basic validation for a valid "Host" header.
                // It's not exhaustive, only checks for valid characters.
                : (isset($_SERVER['HTTP_HOST']) && preg_match('/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
                : (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR']
                : 'localhost')));
    }

}
