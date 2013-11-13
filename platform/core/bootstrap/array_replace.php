<?php

if (!function_exists('array_replace')) {

    /**
     * For PHP 5 < 5.3.0 (backward compatibility)
     * (from @link http://php.net/manual/function.array-replace.php#92549)
     *
     * @see array_replace()
     * @param string $array
     * @param string $array1
     * @return $array
     */
    function array_replace(array &$array, array &$array1) {

        $args  = func_get_args();
        $count = func_num_args();

        for ($i = 0; $i < $count; ++$i) {

            if (is_array($args[$i])) {

                foreach ($args[$i] as $key => $val) {
                    $array[$key] = $val;
                }

            } else {

                trigger_error(
                    __FUNCTION__.'(): Argument #'.($i + 1).' is not an array',
                    E_USER_WARNING
                );

                return null;
            }
        }

        return $array;
    }

}
