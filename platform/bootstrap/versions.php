<?php

/**
 * CodeIgniter Version
 * @var    string
 */
define('CI_VERSION', '3.1.11');


/**
 * Platform (Application Starter) Version
 * @var    string
 */
define('PLATFORM_VERSION', '4.6.3');


/**
 * The Whole End-Product Version, Set Accordingly
 * @var    string
 */
define('PRODUCT_VERSION', '1.0.0');


/**
 * A number to be used on referencing web-assets for browser cache busting.
 * Increment it when you change some web-asset sources (JavaScript, CSS, fonts, etc.)
 * to guarantee on production environment that browsers always load fresh source copies.
 *
 * Sample usage in platform's views (fragments in PHP syntax):
 * 'my.css?v='.WEB_ASSET_CACHE_BUST_NUMBER
 * 'my.js?v='.WEB_ASSET_CACHE_BUST_NUMBER
 *
 * Sample usage in platform's views (fragments in JavaScript syntax):
 * 'my.css?v=' + WEB_ASSET_CACHE_BUST_NUMBER
 * 'my.js?v=' + WEB_ASSET_CACHE_BUST_NUMBER
 *
 * Sample usage in platform's views (fragments in Twig syntax):
 * 'my.css?v=' ~ constant('WEB_ASSET_CACHE_BUST_NUMBER')
 * 'my.js?v=' ~ constant('WEB_ASSET_CACHE_BUST_NUMBER')
 *
 * @var    string
 */
define('WEB_ASSET_CACHE_BUST_NUMBER', '0');


/**
 * Minimum Required PHP Version
 * @var    string
 */
define('PLATFORM_PHP_VERSION_MIN', '7.2.5');


if (version_compare(PHP_VERSION, PLATFORM_PHP_VERSION_MIN, '<')) {

    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'PHP '.PLATFORM_PHP_VERSION_MIN.' or newer is required.';
    exit(3); // EXIT_CONFIG
}
