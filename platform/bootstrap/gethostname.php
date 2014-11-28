<?php

/**
 * For PHP 5 < 5.3.0 (backward compatibility)
 */
if (!function_exists('gethostname')) {

    function gethostname() {
        return php_uname('n');
    }

}
