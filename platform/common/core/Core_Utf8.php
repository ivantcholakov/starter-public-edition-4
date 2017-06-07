<?php

// Added by Ivan Tcholakov, 07-JUN-2017.

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Utf8 extends CI_Utf8 {

    public function __construct()
    {
        if (
            defined('PREG_BAD_UTF8_ERROR')                          // PCRE must support UTF-8
            && (ICONV_ENABLED === TRUE OR MB_ENABLED === TRUE)      // iconv or mbstring must be installed
            && strtoupper(config_item('charset')) === 'UTF-8'       // Application charset must be UTF-8
            )
        {
            define('UTF8_ENABLED', TRUE);
            // Modified by Ivan Tcholakov, 07-JUN-2017.
            //log_message('debug', 'UTF-8 Support Enabled');
            log_message('info', 'UTF-8 Support Enabled');
            //
        }
        else
        {
            define('UTF8_ENABLED', FALSE);
            // Modified by Ivan Tcholakov, 07-JUN-2017.
            //log_message('debug', 'UTF-8 Support Disabled');
            log_message('info', 'UTF-8 Support Disabled');
            //
        }

        log_message('info', 'Utf8 Class Initialized');
    }

}
