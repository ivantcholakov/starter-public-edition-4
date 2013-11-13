<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Core_Hooks extends CI_Hooks {

    /**
     * Class constructor
     * @return    void
     */
    public function __construct() {

        $CFG =& load_class('Config', 'core');

        log_message('debug', 'Hooks Class Initialized');

        if ($CFG->item('enable_hooks') === FALSE) {
            return;
        }

        if (file_exists(APPPATH.'config/hooks.php')) {
            include(APPPATH.'config/hooks.php');
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/hooks.php')) {
            include(APPPATH.'config/'.ENVIRONMENT.'/hooks.php');
        }

        if (file_exists(COMMONPATH.'config/hooks.php')) {
            include(COMMONPATH.'config/hooks.php');
        }

        if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/hooks.php')) {
            include(COMMONPATH.'config/'.ENVIRONMENT.'/hooks.php');
        }

        if (!isset($hook) || !is_array($hook)) {
            return;
        }

        $this->hooks =& $hook;
        $this->enabled = TRUE;
    }

}
