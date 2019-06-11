<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Events
 *
 * A simple events system for CodeIgniter.
 *
 * @package         CodeIgniter
 * @subpackage      Events
 * @version         1.0
 * @author          Dan Horrigan <http://dhorrigan.com>
 * @author          Eric Barnes <http://ericlbarnes.com>
 * @license         Apache License v2.0
 * @copyright       2010 Dan Horrigan
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Events Library
 */
class Events {

    /**
     * @var         array       An array of listeners
     */
    protected static $_listeners = array();

    //------- Additional piece of code by Ivan Tcholakov, 2013-2015 ------------

    protected static $_initialized = false;

    public function __construct($config = array())
    {
        if (!self::$_initialized)
        {
            if (!empty($config['event_registration_classes']) && is_array($config['event_registration_classes']))
            {
                foreach ($config['event_registration_classes'] as $file_name)
                {
                    self::_load_class($file_name);
                }
            }

            self::_scan_modules();
            self::_scan_common_modules();
            self::$_initialized = true;
        }
    }

    private static function _scan_modules()
    {
        $ci = get_instance();

        $ci->load->helper('directory');

        $module_dirs = array();

        $dir_map = directory_map(APPPATH.'modules', 1);

        if (!empty($dir_map))
        {
            foreach ($dir_map as $key => $name)
            {
                if (strpos($name, '.') !== false)
                {
                    continue;   // Skip files.
                }

                $module_dirs[] = rtrim($name, DIRECTORY_SEPARATOR);
            }
        }

        @ sort($module_dirs);

        if (!empty($module_dirs))
        {
            foreach ($module_dirs as $dir)
            {
                self::_load_class(APPPATH.'modules/'.$dir.'/events.php');
            }
        }

        return true;
    }

    private static function _scan_common_modules()
    {
        $ci = get_instance();

        $ci->load->helper('directory');

        $module_dirs = array();

        $dir_map = directory_map(COMMONPATH.'modules', 1);

        if (!empty($dir_map))
        {
            foreach ($dir_map as $key => $name)
            {
                if (strpos($name, '.') !== false)
                {
                    continue;   // Skip files.
                }

                $module_dirs[] = rtrim($name, DIRECTORY_SEPARATOR);
            }
        }

        @ sort($module_dirs);

        if (!empty($module_dirs))
        {
            foreach ($module_dirs as $dir)
            {
                self::_load_class(COMMONPATH.'modules/'.$dir.'/events.php');
            }
        }

        return true;
    }

    private static function _load_class($events_file)
    {
        // Modified by Ivan Tcholakov, 05-AUG-2015.
        // See https://github.com/ivantcholakov/starter-public-edition-4/issues/59
        //$class = 'Events_'.ucfirst(strtolower($dir));
        //
        //if (is_file($events_file) && !class_exists($class, false))
        //{
        //    include_once $events_file;
        //
        //    if (class_exists($class, false))
        //    {
        //        new $class;
        //    }
        //}
        if (is_file($events_file))
        {
            $classes = get_declared_classes();
            include_once $events_file;
            $classes = array_diff(get_declared_classes(), $classes);

            if (!empty($classes))
            {
                // No class name convention is enforced.
                // Choose class names carefully for avoiding name collisions.
                $class = array_shift($classes);
                new $class;
            }
        }
        //
    }

    //--------------------------------------------------------------------------

    /**
     * Return all registered event keys
     */
    public static function registered()
    {
        return array_keys(self::$_listeners);
    }

    /**
     * Register
     *
     * Registers a Callback for a given event
     *
     * @access      public
     * @param       string      The name of the event
     * @param       array       The callback for the Event
     * @return      void
     */
    public static function register($event, array $callback)
    {
        $key = get_class($callback[0]).'::'.$callback[1];
        self::$_listeners[$event][$key] = $callback;
        log_message('debug', 'Events::register() - Registered "'.$key.' with event "'.$event.'"');
    }

    /**
     * Trigger
     *
     * Triggers an event and returns the results.  The results can be returned
     * in the following formats:
     *
     * 'array'
     * 'json'
     * 'serialized'
     * 'string'
     *
     * @access      public
     * @param       string      The name of the event
     * @param       mixed       Any data that is to be passed to the listener
     * @param       string      The return type
     * @return      mixed       The return of the listeners, in the return type
     */
    public static function trigger($event, $data = '', $return_type = 'string')
    {
        log_message('debug', 'Events::trigger() - Triggering event "'.$event.'"');

        $calls = array();

        if (self::has_listeners($event))
        {
            foreach (self::$_listeners[$event] as $listener)
            {
                if (is_callable($listener))
                {
                    $calls[] = call_user_func($listener, $data);
                }
            }
        }

        return self::_format_return($calls, $return_type);
    }

    /**
     * Format Return
     *
     * Formats the return in the given type
     *
     * @access      protected
     * @param       array       The array of returns
     * @param       string      The return type
     * @return      mixed       The formatted return
     */
    protected static function _format_return(array $calls, $return_type)
    {
        log_message('debug', 'Events::_format_return() - Formating calls in type "'.$return_type.'"');

        switch ($return_type)
        {
            case 'array':
                return $calls;
                break;
            case 'json':
                return json_encode($calls);
                break;
            case 'serialized':
                return serialize($calls);
                break;
            case 'string':
                $str = '';
                foreach ($calls as $call)
                {
                    // Keep the evil @
                    $str .= @ (string) $call;
                }
                return $str;
                break;
            default:
                return $calls;
                break;
        }

        // Does not do anything, so send null. false would suggest an error
        return null;
    }

    /**
     * Has Listeners
     *
     * Checks if the event has listeners
     *
     * @access      public
     * @param       string      The name of the event
     * @return      bool        Whether the event has listeners
     */
    public static function has_listeners($event)
    {
        log_message('debug', 'Events::has_listeners() - Checking if event "'.$event.'" has listeners.');

        if (isset(self::$_listeners[$event]) AND count(self::$_listeners[$event]) > 0)
        {
            return TRUE;
        }
        return FALSE;
    }
}
