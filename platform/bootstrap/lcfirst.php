<?php

if (!function_exists('lcfirst')) {

    /**
     * For PHP 5 < 5.3.0 (backward compatibility)
     */
    function lcfirst( $str ) {
        return (string) (strtolower(substr($str, 0, 1)).substr($str, 1));
    }

}
