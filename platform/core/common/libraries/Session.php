<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// See http://degreesofzero.com/article/55

require_once BASEPATH.'libraries/Driver.php';
require_once BASEPATH.'libraries/Session/Session.php';
require_once BASEPATH.'libraries/Session/drivers/Session_native.php';

class Session extends CI_Session {

    public function __construct() {

        parent::__construct();
    }

    public function keep_flashdata($key = null) {

        if ($key) {

            // Mark individual flashdata as 'new' to preserve it from _flashdata_sweep().

            parent::keep_flashdata($key);

        } else {

            // Mark all 'old' flashdata as 'new' (keep data from being deleted during next request).

            $userdata = $this->all_userdata();

            foreach ($userdata as $name => $value) {

                $parts = explode(self::FLASHDATA_OLD, $name);

                if (is_array($parts) && count($parts) === 2) {

                    $new_name = self::FLASHDATA_KEY.self::FLASHDATA_NEW.$parts[1];
                    $this->set_userdata($new_name, $value);
                    $this->unset_userdata($name);
                }
            }
        }
    }

    protected function _flashdata_mark() {

        if (IS_AJAX_REQUEST) {
            return;
        }

        parent::_flashdata_mark();
    }

    protected function _flashdata_sweep() {
        
        if (IS_AJAX_REQUEST) {
            return;
        }

        parent::_flashdata_sweep();
    }

}
