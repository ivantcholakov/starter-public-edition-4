<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class User_agent extends CI_User_agent {

    public function __construct() {

        parent::__construct();

        if (!defined('UA_IS_MOBILE')) {
            define('UA_IS_MOBILE', $this->is_mobile());
        }

        if (!defined('UA_IS_ROBOT')) {
            define('UA_IS_ROBOT', $this->is_robot());
        }

        if (!defined('UA_IS_REFERRAL')) {
            define('UA_IS_REFERRAL', $this->is_referral());
        }
    }

    /**
     * Compile the User Agent Data
     * @return  bool
     */
    protected function _load_agent_file() {

        $found = FALSE;

        if (file_exists(COMMONPATH.'config/user_agents.php')) {
            include(COMMONPATH.'config/user_agents.php');
            $found = TRUE;
        }

        if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/user_agents.php')) {
            include(COMMONPATH.'config/'.ENVIRONMENT.'/user_agents.php');
            $found = TRUE;
        }

        if (file_exists(APPPATH.'config/user_agents.php')) {
            include(APPPATH.'config/user_agents.php');
            $found = TRUE;
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php')) {
            include(APPPATH.'config/'.ENVIRONMENT.'/user_agents.php');
            $found = TRUE;
        }

        if ($found !== TRUE) {
            return FALSE;
        }

        $return = FALSE;

        if (isset($platforms)) {
            $this->platforms = $platforms;
            unset($platforms);
            $return = TRUE;
        }

        if (isset($browsers)) {
            $this->browsers = $browsers;
            unset($browsers);
            $return = TRUE;
        }

        if (isset($mobiles)) {
            $this->mobiles = $mobiles;
            unset($mobiles);
            $return = TRUE;
        }

        if (isset($robots)) {
            $this->robots = $robots;
            unset($robots);
            $return = TRUE;
        }

        return $return;
    }

}
