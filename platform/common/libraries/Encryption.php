<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

class Encryption extends CI_Encryption {


    public function __construct(array $params = array())
    {
        // Modified by Ivan Tcholakov, 27-FEB-2021.
        //isset(self::$func_overload) OR self::$func_overload = (extension_loaded('mbstring') && ini_get('mbstring.func_overload'));
        isset(self::$func_overload) OR self::$func_overload = (defined('MB_OVERLOAD_STRING') && ((int) @ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING));
        //

        parent::__construct();
    }

}
