<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Php {

    public static function money_format($number, $format) {

        return money_format($format, $number);
    }

    public static function ltrim() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'ltrim'), $args)
            : call_user_func_array('ltrim', $args);
    }

    public static function rtrim() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'rtrim'), $args)
            : call_user_func_array('rtrim', $args);
    }

    public static function stripos() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'stripos'), $args)
            : call_user_func_array('stripos', $args);
    }

    public static function strpos() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'strpos'), $args)
            : call_user_func_array('strpos', $args);
    }

    public static function wordwrap() {

        $args = func_get_args();

        return IS_UTF8_CHARSET
            ? call_user_func_array(array('UTF8', 'wordwrap'), $args)
            : call_user_func_array('wordwrap', $args);
    }

    public static function php_empty($variable) {

        return empty($variable);
    }

    public static function array_plus($arr1, $arr2) {

        if ($arr1 instanceof Traversable) {
            $arr1 = iterator_to_array($arr1);
        } elseif (!is_array($arr1)) {
            throw new Twig_Error_Runtime(sprintf('The array_plus filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
        }

        if ($arr2 instanceof Traversable) {
            $arr2 = iterator_to_array($arr2);
        } elseif (!is_array($arr2)) {
            throw new Twig_Error_Runtime(sprintf('The array_plus filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
        }

        return $arr1 + $arr2;
    }

    public static function array_replace($arr1, $arr2) {

        if ($arr1 instanceof Traversable) {
            $arr1 = iterator_to_array($arr1);
        } elseif (!is_array($arr1)) {
            throw new Twig_Error_Runtime(sprintf('The array_plus filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
        }

        if ($arr2 instanceof Traversable) {
            $arr2 = iterator_to_array($arr2);
        } elseif (!is_array($arr2)) {
            throw new Twig_Error_Runtime(sprintf('The array_plus filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
        }

        return array_replace($arr1, $arr2);
    }

}
