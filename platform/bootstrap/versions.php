<?php

/**
 * CodeIgniter Version
 * @var    string
 */
define('CI_VERSION', '3.1.2');


/**
 * Platform (Application Starter) Version
 * @var    string
 */
define('PLATFORM_VERSION', '4.2.14');


/**
 * Minimum Required PHP Version
 * @var    string
 */
define('PLATFORM_PHP_VERSION_MIN', '5.3.7');


if (version_compare(PHP_VERSION, PLATFORM_PHP_VERSION_MIN, '<')) {

    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'PHP '.PLATFORM_PHP_VERSION_MIN.' or newer is required.';
    exit(3);
}
