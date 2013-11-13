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
                : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
                : (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR']
                : 'localhost')));
    }

}
