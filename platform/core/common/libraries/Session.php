<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Session extends CI_Session {

    public function __construct() {

        parent::__construct();
    }

    public function keep_flashdata($key = null) {

        if ($key !== null) {

            parent::keep_flashdata($key);

        } else {

            // An added feature: Keep all the flash data.
            parent::keep_flashdata($this->get_flash_keys());
        }
    }

    protected function _ci_init_vars() {

        parent::_ci_init_vars();

        // An added feature: Keep all the flash data on AJAX requests.
        if (IS_AJAX_REQUEST) {
            $this->keep_flashdata();
        }
    }

}
