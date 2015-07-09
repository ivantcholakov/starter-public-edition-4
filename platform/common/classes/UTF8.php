<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UTF-8 string support for CodeIgniter based on Kohana's implementation.
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015 (for this file)
 * @license The MIT License (for this file)
 * @version 1.0.0
 * Code repository: https://github.com/ivantcholakov/codeigniter-utf8
 *
 * See the file application/third_party/kohana/Kohana_UTF8.php for
 * technical requirements and license information.
 */

if (!defined('SYSPATH')) {
    define('SYSPATH', COMMONPATH.'third_party/kohana/');
}

if (!defined('EXT')) {
    define('EXT', '.php');
}

if (!defined('ICONV_INSTALLED')) {
    define('ICONV_INSTALLED', function_exists('iconv'));
}

if (!defined('MBSTRING_INSTALLED')) {
    define('MBSTRING_INSTALLED', extension_loaded('mbstring'));
}

if (!class_exists('Kohana', false)) {
    class Kohana { public static $charset = 'UTF-8'; }
}

if (!class_exists('Kohana_UTF8', false)) {
    require SYSPATH.'Kohana_UTF8.php';
}

class UTF8 extends Kohana_UTF8 {

    final private function __construct() {}
    final private function __clone() {}

    public static $aliases = array('UTF-8', 'WINDOWS-65001', 'CP65001', 'WIN-65001', 'WIN65001', '65001');

    public static function encode($string, $from_encoding) {

        $from_encoding = strtoupper($from_encoding);

        if (in_array($from_encoding, self::$aliases)) {
            return $string;
        }

        if (ICONV_INSTALLED) {
            return @ (string) iconv($from_encoding, 'UTF-8', $string);
        }
        elseif (MBSTRING_INSTALLED) {
            return @ (string) mb_convert_encoding($string, 'UTF-8', $from_encoding);
        }

        return $string;
    }

    public static function decode($string, $to_encoding) {

        $to_encoding = strtoupper($to_encoding);

        if (in_array($to_encoding, self::$aliases)) {
            return $string;
        }

        if (ICONV_INSTALLED) {
            return @ (string) iconv('UTF-8', $to_encoding, $string);
        }
        elseif (MBSTRING_INSTALLED) {
            return @ (string) mb_convert_encoding($string, $to_encoding, 'UTF-8');
        }
    }

    public static function is($string) {

        return preg_match('//u', $string);
    }

    public static function is_alias($encoding) {

        return in_array(strtoupper($encoding), self::$aliases);
    }

}
