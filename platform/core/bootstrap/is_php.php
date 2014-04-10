<?php

// Ivan: This is the original CodeIgniter's is_php() function.
// It has been placed here in order it to be loaded at the earliest possible moment.

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package         CodeIgniter
 * @author          EllisLab Dev Team
 * @copyright       Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @license         http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link            http://codeigniter.com
 */

if ( ! function_exists('is_php'))
{
    /**
     * Determines if the current version of PHP is greater then the supplied value
     *
     * @param       string
     * @return      bool        TRUE if the current version is $version or higher
     */
    function is_php($version)
    {
        static $_is_php;
        $version = (string) $version;

        if ( ! isset($_is_php[$version]))
        {
            $_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
        }

        return $_is_php[$version];
    }
}
