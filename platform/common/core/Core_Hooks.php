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

        log_message('info', 'Hooks Class Initialized');

        if ($CFG->item('enable_hooks') === FALSE) {
            return;
        }

        if (file_exists(COMMONPATH.'config/hooks.php')) {
            include(COMMONPATH.'config/hooks.php');
        }

        if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/hooks.php')) {
            include(COMMONPATH.'config/'.ENVIRONMENT.'/hooks.php');
        }

        if (file_exists(APPPATH.'config/hooks.php')) {
            include(APPPATH.'config/hooks.php');
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/hooks.php')) {
            include(APPPATH.'config/'.ENVIRONMENT.'/hooks.php');
        }

        if (!isset($hook) || !is_array($hook)) {
            return;
        }

        $this->hooks =& $hook;
        $this->enabled = TRUE;
    }

    /**
     * Run Hook
     *
     * Runs a particular hook
     *
     * @param       array   $data       Hook details
     * @return      bool                TRUE on success or FALSE on failure
     */
    protected function _run_hook($data)
    {
        if ( ! is_array($data))
        {
            return FALSE;
        }

        // -----------------------------------
        // Safety - Prevents run-away loops
        // -----------------------------------

        // If the script being called happens to have the same
        // hook call within it a loop can happen
        if ($this->_in_progress === TRUE)
        {
            return;
        }

        // -----------------------------------
        // Set file path
        // -----------------------------------

        if ( ! isset($data['filepath'], $data['filename']))
        {
            return FALSE;
        }

        $filepath = APPPATH.$data['filepath'].'/'.$data['filename'];

        if ( ! file_exists($filepath))
        {
            // Modified by Ivan Tcholakov, 19-NOV-2013.
            //return FALSE;
            $filepath = COMMONPATH.$data['filepath'].'/'.$data['filename'];
            if ( ! file_exists($filepath))
            {
                return FALSE;
            }
            //
        }

        // Determine and class and/or function names
        $class      = empty($data['class']) ? FALSE : $data['class'];
        $function   = empty($data['function']) ? FALSE : $data['function'];
        $params     = isset($data['params']) ? $data['params'] : '';

        if ($class === FALSE && $function === FALSE)
        {
            return FALSE;
        }

        // Set the _in_progress flag
        $this->_in_progress = TRUE;

        // Call the requested class and/or function
        if ($class !== FALSE)
        {
            if ( ! class_exists($class, FALSE))
            {
                require($filepath);
            }

            $HOOK = new $class();
            $HOOK->$function($params);
        }
        else
        {
            if ( ! function_exists($function))
            {
                require($filepath);
            }

            $function($params);
        }

        $this->_in_progress = FALSE;
        return TRUE;
    }

}
