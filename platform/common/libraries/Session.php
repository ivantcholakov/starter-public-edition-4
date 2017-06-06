<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Session extends CI_Session {

    public function __construct() {

        parent::__construct();
    }

    protected function _ci_load_classes($driver)
    {
        // PHP 5.4 compatibility
        interface_exists('SessionHandlerInterface', FALSE) OR require_once(BASEPATH.'libraries/Session/SessionHandlerInterface.php');

        $prefix = config_item('subclass_prefix');

        if ( ! class_exists('CI_Session_driver', FALSE))
        {
            require_once(
                file_exists(APPPATH.'libraries/Session/Session_driver.php')
                    ? APPPATH.'libraries/Session/Session_driver.php'
                    // Modified by Ivan Tcholakov, 12-DEC-2014.
                    //: BASEPATH.'libraries/Session/Session_driver.php'
                    : (file_exists(COMMONPATH.'libraries/Session/Session_driver.php')
                        ? COMMONPATH.'libraries/Session/Session_driver.php'
                        : BASEPATH.'libraries/Session/Session_driver.php')
                    //
            );

            if (file_exists($file_path = APPPATH.'libraries/Session/'.$prefix.'Session_driver.php'))
            {
                require_once($file_path);
            }
            // Added by Ivan Tcholakov, 12-DEC-2014.
            elseif (file_exists($file_path = COMMONPATH.'libraries/Session/'.$prefix.'Session_driver.php'))
            {
                require_once($file_path);
            }
            //
        }

        $class = 'Session_'.$driver.'_driver';

        // Allow custom drivers without the CI_ or MY_ prefix
        if ( ! class_exists($class, FALSE) && file_exists($file_path = APPPATH.'libraries/Session/drivers/'.$class.'.php'))
        {
            require_once($file_path);
            if (class_exists($class, FALSE))
            {
                return $class;
            }
        }
        // Added by Ivan Tcholakov, 12-DEC-2014.
        elseif ( ! class_exists($class, FALSE) && file_exists($file_path = COMMONPATH.'libraries/Session/drivers/'.$class.'.php'))
        {
            require_once($file_path);
            if (class_exists($class, FALSE))
            {
                return $class;
            }
        }
        //

        if ( ! class_exists('CI_'.$class, FALSE))
        {
            // Modified by Ivan Tcholakov, 12-DEC-2014.
            //if (file_exists($file_path = APPPATH.'libraries/Session/drivers/'.$class.'.php') OR file_exists($file_path = BASEPATH.'libraries/Session/drivers/'.$class.'.php'))
            if (file_exists($file_path = APPPATH.'libraries/Session/drivers/'.$class.'.php') OR file_exists($file_path = COMMONPATH.'libraries/Session/drivers/'.$class.'.php') OR file_exists($file_path = BASEPATH.'libraries/Session/drivers/'.$class.'.php'))
            //
            {
                require_once($file_path);
            }

            if ( ! class_exists('CI_'.$class, FALSE) && ! class_exists($class, FALSE))
            {
                throw new UnexpectedValueException("Session: Configured driver '".$driver."' was not found. Aborting.");
            }
        }

        // Modified by Ivan Tcholakov, 12-DEC-2014.
        //if ( ! class_exists($prefix.$class, FALSE) && file_exists($file_path = APPPATH.'libraries/Session/drivers/'.$prefix.$class.'.php'))
        if ( ! class_exists($prefix.$class, FALSE) && (file_exists($file_path = APPPATH.'libraries/Session/drivers/'.$prefix.$class.'.php') OR file_exists($file_path = COMMONPATH.'libraries/Session/drivers/'.$prefix.$class.'.php')))
        //
        {
            require_once($file_path);
            if (class_exists($prefix.$class, FALSE))
            {
                return $prefix.$class;
            }
            else
            {
                log_message('debug', 'Session: '.$prefix.$class.".php found but it doesn't declare class ".$prefix.$class.'.');
            }
        }

        return 'CI_'.$class;
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
