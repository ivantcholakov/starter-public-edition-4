<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Setting extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load->library('settings');
    }

    public function get() {

        $item = $this->get_attribute(0);

        if (!isset($item)) {
            return;
        }

        $item = trim(@ (string) $item);

        if ($item == '') {
            return;
        }

        if ($this->is_blacklisted_config_setting($item)) {
            return;
        }

        return $this->settings->lang($item, null, true);
    }

}
