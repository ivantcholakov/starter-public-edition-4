<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

global $CFG;

/* get module locations from config settings or use the default module location and offset */
is_array(Modules::$locations = $CFG->item('modules_locations')) OR Modules::$locations = array(
    APPPATH.'modules/' => '../modules/',
    // Added by Ivan Tcholakov, FEB-2016.
    COMMONPATH.'modules/' => '../../common/modules/',
    //
);

/* PHP5 spl_autoload */
// Removed by Ivan Tcholakov, 11-OCT-2013.
//spl_autoload_register('Modules::autoload');
//

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link        https://codeigniter.com
 *
 * Description:
 * This library provides functions to load and instantiate controllers
 * and module controllers allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Modules.php
 *
 * @copyright   Copyright (c) 2011 Wiredesignz
 * @version     5.4
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class Modules
{
    public static $routes, $registry, $locations;

    /**
    * Run a module controller method
    * Output from module is buffered and returned.
    **/
    public static function run($module) {

        // Added by Ivan Tcholakov, 25-JUN-2014.
        $old_module = get_instance()->load->get_module();
        //

        $method = 'index';

        if (($pos = strrpos($module, '/')) !== FALSE) {

            $method = substr($module, $pos + 1);
            $module = substr($module, 0, $pos);
        }

        if ($class = self::load($module)) {

            if (method_exists($class, $method)) {

                ob_start();
                $args = func_get_args();
                $output = call_user_func_array(array($class, $method), array_slice($args, 1));
                $buffer = ob_get_clean();

                // Added by Ivan Tcholakov, 25-JUN-2014.
                get_instance()->load->set_module($old_module);
                //

                return ($output !== NULL) ? $output : $buffer;
            }
        }

        // Added by Ivan Tcholakov, 25-JUN-2014.
        get_instance()->load->set_module($old_module);
        //

        log_message('error', "Module controller failed to run: {$module}/{$method}");
    }

    /** Load a module controller **/
    public static function load($module) {

        // Modified by Ivan Tcholakov, 21-JAN-2017.
        //(is_array($module)) ? list($module, $params) = each($module) : $params = NULL;
        if (is_array($module)) {
            list($params, $module) = array(reset($module), key($module));
        } else {
            $params = NULL;
        }
        //

        //
        // Removed by Ivan Tcholakov, 03-APR-2014.
        // Uniqueness is not distinguished this way.
        //
        /* get the requested controller class name */
        //$alias = strtolower(basename($module));

        /* create or return an existing controller from the registry */
        //if ( ! isset(self::$registry[$alias])) {
        //

        /* find the controller */
        // Modified by Ivan Tcholakov, 21-JAN-2014.
        //list($class) = CI::$APP->router->locate(explode('/', $module));
        list($class) = CI::$APP->router->locate(explode('/', $module), false);
        //

        /* controller cannot be located */
        if (empty($class)) {
            return;
        }

        /* set the module directory */
        // Modified by Ivan Tcholakov, 16-DEC-2013, 31-MAY-2016.
        //$path = APPPATH.'controllers/'.CI::$APP->router->directory;
        $path = resolve_path(APPPATH.'controllers/'.str_replace('../../common/modules', '../modules', CI::$APP->router->directory)).'/';
        $path_common = resolve_path(COMMONPATH.'controllers/'.str_replace('../modules', '../../common/modules', CI::$APP->router->directory)).'/';
        //

        /* load the controller class */
        // Modified by Ivan Tcholakov, 16-DEC-2013.
        //$class = $class.CI::$APP->config->item('controller_suffix');
        if (self::test_load_file(ucfirst($class).CI::$APP->config->item('controller_suffix'), $path)) {
            $class = ucfirst($class).CI::$APP->config->item('controller_suffix');
        }
        elseif (self::test_load_file($class.CI::$APP->config->item('controller_suffix'), $path)) {
            $class = $class.CI::$APP->config->item('controller_suffix');
        }
        elseif (self::test_load_file(ucfirst($class), $path)) {
            $class = ucfirst($class);
        }
        elseif (self::test_load_file($class, $path)) {
            // Do nothing.
        }
        elseif (self::test_load_file(ucfirst($class).CI::$APP->config->item('controller_suffix'), $path_common)) {
            $class = ucfirst($class).CI::$APP->config->item('controller_suffix');
            $path = $path_common;
        }
        elseif (self::test_load_file($class.CI::$APP->config->item('controller_suffix'), $path_common)) {
            $class = $class.CI::$APP->config->item('controller_suffix');
            $path = $path_common;
        }
        elseif (self::test_load_file(ucfirst($class), $path_common)) {
            $class = ucfirst($class);
            $path = $path_common;
        }
        elseif (self::test_load_file($class, $path_common)) {
            $path = $path_common;
        }
        //

        // Modifications by Ivan Tcholakov, 03-APR-2014.
        // The previous check for loaded controller was not precise.

        $location = realpath($path.$class.'.php');
        $key = strtolower($location);

        // Check whether the controller has been loaded, based on its system path.
        if (!isset(self::$registry[$key])) {

            self::load_file($class, $path);

            /* create and register the new controller */
            $controller = ucfirst($class);
            self::$registry[$key] = new $controller($params);
            self::$registry[$key]->path = $location;
        }

        // Added by Ivan Tcholakov, 03-APR-2014.
        // A dirty workaround that is needed for Starter 4.
        self::$registry[$key]->load->set_module(CI::$APP->router->fetch_module());
        //

        return self::$registry[$key];
    }

    /** Library base class autoload **/
    public static function autoload($class) {

        /* don't autoload CI_ prefixed classes or those using the config subclass_prefix */
        if (strstr($class, 'CI_') OR strstr($class, config_item('subclass_prefix'))) {
            return;
        }

        /* autoload Modular Extensions MX core classes */
        if (strstr($class, 'MX_') AND is_file($location = dirname(__FILE__).'/'.substr($class, 3).'.php')) {

            include_once $location;
            return;
        }

        /* autoload core classes */
        if (is_file($location = APPPATH.'core/'.$class.'.php')) {

            include_once $location;
            return;
        }

        /* autoload library classes */
        if (is_file($location = APPPATH.'libraries/'.$class.'.php')) {

            include_once $location;
            return;
        }
    }

    /** Load a module file **/
    public static function load_file($file, $path, $type = 'other', $result = TRUE)    {

        $file = str_replace('.php', '', $file);
        $location = $path.$file.'.php';

        if ($type === 'other') {

            if (class_exists($file, FALSE)) {

                log_message('debug', "File already loaded: {$location}");
                return $result;
            }

            include_once $location;

        } else {

            /* load config or language array */
            include $location;

            if ( ! isset($$type) OR ! is_array($$type)) {
                show_error("{$location} does not contain a valid {$type} array");
            }

            $result = $$type;
        }

        log_message('debug', "File loaded: {$location}");

        return $result;
    }

    // Added by Ivan Tcholakov, FEB-2012.
    protected static function test_load_file($file, $path) {

        $file = str_replace('.php', '', $file);
        $location = $path.$file.'.php';

        return is_file($location);
    }
    //

    /**
    * Find a file
    * Scans for files located within modules directories.
    * Also scans application directories for models, plugins and views.
    * Generates fatal error if file not found.
    **/
    public static function find($file, $module, $base, $fail_gracefully = false) {

        $segments = explode('/', $file);

        $file = array_pop($segments);
        $file_ext = (pathinfo($file, PATHINFO_EXTENSION)) ? $file : $file.'.php';

        $path = ltrim(implode('/', $segments).'/', '/');
        $module ? $modules[$module] = $path : $modules = array();

        if ( ! empty($segments)) {
            $modules[array_shift($segments)] = ltrim(implode('/', $segments).'/','/');
        }

        foreach (Modules::$locations as $location => $offset) {

            foreach($modules as $module => $subpath) {

                $fullpath = $location.$module.'/'.$base.$subpath;

                if ($base == 'libraries/' AND is_file($fullpath.ucfirst($file_ext))) {
                    return array($fullpath, ucfirst($file));
                }

                // Added by Ivan Tcholakov, 17-FEB-2017.
                if ($base == 'models/' AND is_file($fullpath.ucfirst($file_ext))) {
                    return array($fullpath, ucfirst($file));
                }
                //

                // Added by Ivan Tcholakov, 31-JAN-2015.
                if ($base == 'helpers/' && is_file($fullpath.config_item('subclass_prefix').$file_ext)) {
                    return array($fullpath, config_item('subclass_prefix').$file);
                }
                //

                // Added by Ivan Tcholakov, 16-JAN-2016.
                if ($base == 'views/') {

                    if (($file_found = CI::$APP->parser->find_file($fullpath.$file)) !== null) {
                        return array($fullpath, pathinfo($file_found, PATHINFO_BASENAME));
                    }
                }
                //

                if (is_file($fullpath.$file_ext)) {
                    return array($fullpath, $file);
                }
            }
        }

        /* is the file in an application directory? */
        if ($base == 'views/') {

            // Added by Ivan Tcholakov, 16-JAN-2016.
            if (($file_found = CI::$APP->parser->find_file(APPPATH.$base.$path.$file)) !== null) {
                return array(APPPATH.$base.$path, pathinfo($file_found, PATHINFO_BASENAME));
            }
            //

            if (is_file(APPPATH.$base.$path.$file_ext)) {
                return array(APPPATH.$base.$path, $file);
            }

            // Added by Ivan Tcholakov, 16-JAN-2016.
            if (($file_found = CI::$APP->parser->find_file(COMMONPATH.$base.$path.$file)) !== null) {
                return array(COMMONPATH.$base.$path, pathinfo($file_found, PATHINFO_BASENAME));
            }
            //

            // Added by Ivan Tcholakov, 25-JUN-2014.
            if (is_file(COMMONPATH.$base.$path.$file_ext)) {
                return array(COMMONPATH.$base.$path, $file);
            }
            //

            if ($fail_gracefully) {
                return array(FALSE, $file);
            }

            show_error("Unable to locate the {$base} file: {$path}{$file_ext}");
        }

        log_message('debug', "Unable to locate the {$base} file: {$path}{$file_ext}");

        return array(FALSE, $file);
    }

    /** Parse module routes **/
    public static function parse_routes($module, $uri) {

        /* load the route file */
        if ( ! isset(self::$routes[$module])) {

            if (list($path) = self::find('routes', $module, 'config/') AND $path) {
                self::$routes[$module] = self::load_file('routes', $path, 'route');
            }
        }

        if ( ! isset(self::$routes[$module])) {
            return;
        }

        /* parse module routes */
        foreach (self::$routes[$module] as $key => $val) {

            // Modified by Ivan Tcholakov, 31-OCT-2012.
            //$key = str_replace(array(':any', ':num'), array('.+', '[0-9]+'), $key);
            $key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);
            //

            if (preg_match('#^'.$key.'$#', $uri)) {

                if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE) {
                    $val = preg_replace('#^'.$key.'$#', $val, $uri);
                }

                return explode('/', $module.'/'.$val);
            }
        }
    }

}
