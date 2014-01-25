<?php

if (!function_exists('array_replace_recursive')) {

    /**
     * For PHP 5 < 5.3.0 (backward compatibility)
     * (from @link http://www.php.net/manual/en/function.array-replace-recursive.php#92574)
     *
     * @see array-replace-recursive()
     */
    function array_replace_recursive($array, $array1) {

        // Handle the arguments, merge one by one.
        $args = func_get_args();
        $array = $args[0];

        if (!is_array($array)) {
            return $array;
        }

        for ($i = 1; $i < count($args); $i++) {

            if (is_array($args[$i])) {
                $array = array_replace_recursive_recurse($array, $args[$i]);
            }
        }

        return $array;
    }

    function array_replace_recursive_recurse($array, $array1) {

        foreach ($array1 as $key => $value) {

            // Create new key in $array, if it is empty or not an array.
            if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
                $array[$key] = array();
            }

            // Overwrite the value in the base array.
            if (is_array($value)) {
                $value = array_replace_recursive_recurse($array[$key], $value);
            }

            $array[$key] = $value;
        }

        return $array;
    }

}
