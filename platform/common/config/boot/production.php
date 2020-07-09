<?php

if (!IS_CLI) {

    /*
      |--------------------------------------------------------------------------
      | ERROR DISPLAY
      |--------------------------------------------------------------------------
      | Don't show ANY in production environments. Instead, let the system catch
      | it and display a generic error message.
     */
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);

} else {

    /*
      |--------------------------------------------------------------------------
      | ERROR DISPLAY
      |--------------------------------------------------------------------------
      | In development, we want to show as many errors as possible to help
      | make sure they don't make it to production. And save us hours of
      | painful debugging.
     */
    error_reporting(-1);
    ini_set('display_errors', '1');

}
