<?php

if (!function_exists('get_object_vars_recursive')) {

    // Added by Ivan Tcholakov, 21-MAR-2016.
    function get_object_vars_recursive($data) {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {

            array_walk($data, '_get_object_vars_recursive_callback');
            return $data;
        }

        return null;
    }

}

if (!function_exists('_get_object_vars_recursive_callback')) {

    // Added by Ivan Tcholakov, 21-MAR-2016.
    function _get_object_vars_recursive_callback(& $data) {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            array_walk($data, __FUNCTION__);
        }

        return $data;
    }

}


// The following functions have been borrowed from Laravel framework.
// @link http://laravel.com/

/**
 * Recursively remove slashes from array keys and values.
 *
 * @param  array  $array
 * @return array
 */

if (!function_exists('array_strip_slashes')) {

    function array_strip_slashes($array) {

        $result = array();

        foreach ($array as $key => $value) {

            $key = stripslashes($key);

            if (is_array($value)) {
                $result[$key] = array_strip_slashes($value);
            } else {
                $result[$key] = stripslashes($value);
            }
        }

        return $result;
    }

}

/**
 * Divide an array into two arrays. One with keys and the other with values.
 *
 * @param  array  $array
 * @return array
 */
if (!function_exists('array_divide')) {

    function array_divide($array) {

        return array(array_keys($array), array_values($array));
    }

}

/**
 * Get a subset of the items from the given array.
 *
 * @param  array  $array
 * @param  array  $keys
 * @return array
 */
if (!function_exists('array_only')) {

    function array_only($array, $keys) {

        return array_intersect_key($array, array_flip((array) $keys));
    }

}

/**
 * Get all of the given array except for a specified array of items.
 *
 * @param  array  $array
 * @param  array  $keys
 * @return array
 */
if (!function_exists('array_except')) {

    function array_except($array, $keys) {

        return array_diff_key($array, array_flip((array) $keys));
    }

}

// The following function have been borrowed from
// @link https://github.com/vdw/Compare-arrays

/**
 * Compares two arrays using their common (intersection) keys.
 *
 * @access    public
 * @param     array    a flat associative array
 * @param     array    a flat associative array
 * @return    bool
 */
if (!function_exists('array_intersect_compare')) {

    function array_intersect_compare($array1, $array2) {

        $common_keys = array_intersect_key($array2, $array1);
        $common_values = array_intersect_assoc($array2, $array1);
        $against = array_intersect_key($common_keys, $common_values);

        if ($common_keys == $against) {

            return true;
        }

        return false;
    }

}
