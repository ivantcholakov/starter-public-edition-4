<?php

/**
 * For PHP 5 < 5.2.0 (backward compatibility)
 */
if (!function_exists('array_fill_keys')) {

    function array_fill_keys($keys, $value) {
        return array_combine($keys, array_fill(0, count($keys), $value));
    }

}
