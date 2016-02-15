<?php

if (!function_exists('money_format')) {

    // A fallback money_format()
    // http://stackoverflow.com/questions/6369887/alternative-to-money-format-function-in-php-on-windows-platform
    function money_format($format, $number) {

        return number_format($number, 2);
    }

}
