<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package     CodeIgniter
 * @author      EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license     http://opensource.org/licenses/MIT    MIT License
 * @link        http://codeigniter.com
 * @since       Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
if (!defined('FILE_READ_MODE')) {
    define('FILE_READ_MODE', 0644);
}

if (!defined('FILE_WRITE_MODE')) {
    define('FILE_WRITE_MODE', 0666);
}

if (!defined('DIR_READ_MODE')) {
    define('DIR_READ_MODE', 0755);
}

if (!defined('DIR_WRITE_MODE')) {
    define('DIR_WRITE_MODE', 0755);
}


/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/


if (!defined('FOPEN_READ')) {
    define('FOPEN_READ',                            'rb');
}

if (!defined('FOPEN_READ_WRITE')) {
    define('FOPEN_READ_WRITE',                      'r+b');
}

if (!defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')) {
    define('FOPEN_WRITE_CREATE_DESTRUCTIVE',        'wb'); // truncates existing file data, use with care
}

if (!defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')) {
    define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',   'w+b'); // truncates existing file data, use with care
}

if (!defined('FOPEN_WRITE_CREATE')) {
    define('FOPEN_WRITE_CREATE',                    'ab');
}

if (!defined('FOPEN_READ_WRITE_CREATE')) {
    define('FOPEN_READ_WRITE_CREATE',               'a+b');
}

if (!defined('FOPEN_WRITE_CREATE_STRICT')) {
    define('FOPEN_WRITE_CREATE_STRICT',             'xb');
}

if (!defined('FOPEN_READ_WRITE_CREATE_STRICT')) {
    define('FOPEN_READ_WRITE_CREATE_STRICT',        'x+b');
}

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
if (!defined('SHOW_DEBUG_BACKTRACE')) {
    define('SHOW_DEBUG_BACKTRACE', TRUE);
}

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
if (!defined('EXIT_SUCCESS')) {
    define('EXIT_SUCCESS', 0); // no errors
}

if (!defined('EXIT_ERROR')) {
    define('EXIT_ERROR', 1); // generic error
}

if (!defined('EXIT_CONFIG')) {
    define('EXIT_CONFIG', 3); // configuration error
}

if (!defined('EXIT_UNKNOWN_FILE')) {
    define('EXIT_UNKNOWN_FILE', 4); // file not found
}

if (!defined('EXIT_UNKNOWN_CLASS')) {
    define('EXIT_UNKNOWN_CLASS', 5); // unknown class
}

if (!defined('EXIT_UNKNOWN_METHOD')) {
    define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
}

if (!defined('EXIT_USER_INPUT')) {
    define('EXIT_USER_INPUT', 7); // invalid user input
}

if (!defined('EXIT_DATABASE')) {
    define('EXIT_DATABASE', 8); // database error
}

if (!defined('EXIT__AUTO_MIN')) {
    define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
}

if (!defined('EXIT__AUTO_MAX')) {
    define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
}
