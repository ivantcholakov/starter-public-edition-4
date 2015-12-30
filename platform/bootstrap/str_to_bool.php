<?php

/**
 * Converts string boolean representation to a true boolean.
 *
 * @param string    $value      The given value.
 * @param bool      $strict     Whether the value has to match exactly to a truthy string for returning TRUE.
 * @return bool
 *
 * @author Ivan Tcholakov, 2015
 * @license MIT
 */

if (!function_exists('str_to_bool')) {

    function str_to_bool($value, $strict = false) {

        if (empty($value)) {
            return false;
        }

        if (is_bool($value)) {
            return $value;
        }

        $value = strtolower(@ (string) $value);

        if (in_array($value, array('no', 'n', 'false', 'off'))) {
            return false;
        }

        if ($strict) {
            return in_array($value, array('yes', 'y', 'true', '1', 'on'));
        }

        return true;
    }

}

/**
 * Checks whether a given value can be a strict string representation of a boolean value.
 *
 * @param string    $value      The given value.
 * @return bool
 *
 * @author Ivan Tcholakov, 2015
 * @license MIT
 */

if (!function_exists('is_str_to_bool')) {

    function is_str_to_bool($value, $strict = false) {

        if (!$strict) {

            $value_test = @ (string) $value;

            if (is_numeric($value_test)) {
                return true;
            }
        }

        return !str_to_bool($value) || str_to_bool($value, true);
    }

}
