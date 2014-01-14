<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package         CodeIgniter
 * @author          EllisLab Dev Team
 * @copyright       Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license         http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link            http://codeigniter.com
 * @since           Version 1.0
 * @filesource
 */


/*
 *---------------------------------------------------------------
 * The Bootstrap folder, for a custom initialization.
 *---------------------------------------------------------------
 */
define('BOOTSTRAPPATH', rtrim(str_replace('\\', '/', realpath(dirname(__FILE__).'/core/bootstrap')), '/').'/');

if (BOOTSTRAPPATH == '' || BOOTSTRAPPATH == '/' || !is_dir(BOOTSTRAPPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your bootstrap folder path (BOOTSTRAPPATH) does not appear to be set correctly. Please, make corrections within the following file: '.__FILE__;
    exit(3); // EXIT_* constants not yet defined; 3 is EXIT_CONFIG.
}


/*
 *---------------------------------------------------------------
 * Get version data.
 *---------------------------------------------------------------
 */
require BOOTSTRAPPATH.'versions.php';


/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */

if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
}


/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT)
{
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;

    case 'testing':
    case 'production':
        error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
        ini_set('display_errors', 0);
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        exit('The application environment is not set correctly.');
}


/*
 * --------------------------------------------------------------------
 * Mark the initialization type. Do not modify this setting.
 * --------------------------------------------------------------------
 */
if (!defined('NORMAL_MVC_EXECUTION')) {
    define('NORMAL_MVC_EXECUTION', FALSE);
}


/*
 *---------------------------------------------------------------
 * Do our custom initialization first.
 *---------------------------------------------------------------
 */
require BOOTSTRAPPATH.'bootstrap.php';


// Added here by Ivan Tcholakov.
/*
 * --------------------------------------------------------------------
 * Load the base controller class definition.
 * --------------------------------------------------------------------
 */
require BASEPATH.'core/Controller.php';
//


/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
{
    require APPPATH.'config/'.ENVIRONMENT.'/constants.php';
}

if (file_exists(APPPATH.'config/constants.php'))
{
    require APPPATH.'config/constants.php';
}

if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/constants.php'))
{
    require COMMONPATH.'config/'.ENVIRONMENT.'/constants.php';
}

require COMMONPATH.'config/constants.php';


/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
if (file_exists(APPPATH.'core/Common.php')) {
    require APPPATH.'core/Common.php';
}

require COMMONPATH.'core/Common.php';
require BASEPATH.'core/Common.php';


/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
set_error_handler('_exception_handler');
register_shutdown_function('_shutdown_handler');

// Kill magic quotes
is_php('5.4') OR @ini_set('magic_quotes_runtime', 0);


/*
 * ------------------------------------------------------
 *  Set the subclass_prefix
 * ------------------------------------------------------
 *
 * Normally the "subclass_prefix" is set in the config file.
 * The subclass prefix allows CI to know if a core class is
 * being extended via a library in the local application
 * "libraries" folder. Since CI allows config items to be
 * overriden via data set in the main index.php file,
 * before proceeding we need to know if a subclass_prefix
 * override exists. If so, we will set this value now,
 * before any classes are loaded
 * Note: Since the config file data is cached it doesn't
 * hurt to load it here.
 */
if ( ! empty($assign_to_config['subclass_prefix']))
{
    get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
}


/*
 * ------------------------------------------------------
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
$BM =& load_class('Benchmark', 'core');
$BM->mark('total_execution_time_start');
$BM->mark('loading_time:_base_classes_start');


/*
 * ------------------------------------------------------
 *  Instantiate the hooks class
 * ------------------------------------------------------
 */
$EXT =& load_class('Hooks', 'core');

/*
 * ------------------------------------------------------
 *  Is there a "pre_system" hook?
 * ------------------------------------------------------
 */
$EXT->call_hook('pre_system');

/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 */
$CFG =& load_class('Config', 'core');

// Do we have any manually set config items in the index.php file?
if (isset($assign_to_config) && is_array($assign_to_config))
{
    foreach ($assign_to_config as $key => $value)
    {
        $CFG->set_item($key, $value);
    }
}


/*
 * ------------------------------------------------------
 *  Initialize writable folders.
 * ------------------------------------------------------
 */

// CodeIgniter's cache folder.
$cache_path = $CFG->item('cache_path') == '' ? APPPATH.'cache/' : $CFG->item('cache_path');
file_exists($cache_path) OR @mkdir($cache_path, DIR_WRITE_MODE, TRUE);

// For HTMLPurifier, no trailing slash.
define('HTMLPURIFIER_CACHE_SERIALIZER_PATH', WRITABLEPATH.'htmlpurifier');
file_exists(HTMLPURIFIER_CACHE_SERIALIZER_PATH) OR @mkdir(HTMLPURIFIER_CACHE_SERIALIZER_PATH, DIR_WRITE_MODE, TRUE);

// For Mustache, with trailing slash.
define('MUSTACHE_CACHE', WRITABLEPATH.'mustache/'.APPNAME.'/');
file_exists(MUSTACHE_CACHE) OR @mkdir(MUSTACHE_CACHE, DIR_WRITE_MODE, TRUE);

// For the LESS-compiler, with trailing slash.
define('LESS_CACHE', WRITABLEPATH.'less/'.APPNAME.'/');
file_exists(LESS_CACHE) OR @mkdir(LESS_CACHE, DIR_WRITE_MODE, TRUE);

/*
 * ------------------------------------------------------
 *  Instantiate the UTF-8 class
 * ------------------------------------------------------
 *
 * Note: Order here is rather important as the UTF-8
 * class needs to be used very early on, but it cannot
 * properly determine if UTF-8 can be supported until
 * after the Config class is instantiated.
 *
 */
$UNI =& load_class('Utf8', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the URI class
 * ------------------------------------------------------
 */
$URI =& load_class('URI', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the routing class and set the routing
 * ------------------------------------------------------
 */
$RTR =& load_class('Router', 'core');
// Added by Ivan Tcholakov, 01-NOV-2013.
if (NORMAL_MVC_EXECUTION) {
    $RTR->_set_routing();
}
//

// Added by Ivan Tcholakov, 14-JAN-2014.
// Set any routing overrides that may exist in the main index file
if (isset($routing) && is_array($routing))
{
    if (isset($routing['directory']))
    {
        $RTR->set_directory($routing['directory']);
    }

    if ( ! empty($routing['controller']))
    {
        $RTR->set_class($routing['controller']);
    }

    if (isset($routing['function']))
    {
        $routing['function'] = empty($routing['function']) ? 'index' : $routing['function'];
        $RTR->set_method($routing['function']);
    }
}
//


// Added by Ivan Tcholakov.
//--------------------------------------------------------------------------

if (!NORMAL_MVC_EXECUTION) {
    $base_class_name = 'Dummy';
    $class  = $base_class_name.$CFG->config['controller_suffix'];
    $method = 'index';
    $RTR->set_class($base_class_name);
}

//--------------------------------------------------------------------------
//


/*
 * ------------------------------------------------------
 *  Instantiate the output class
 * ------------------------------------------------------
 */
$OUT =& load_class('Output', 'core');

/*
 * ------------------------------------------------------
 *    Is there a valid cache file? If so, we're done...
 * ------------------------------------------------------
 */
// Modified by Ivan Tcholakov.
//if ($EXT->call_hook('cache_override') === FALSE
// Disable cache when core is not initialized normally.
if (NORMAL_MVC_EXECUTION
    && $EXT->call_hook('cache_override') === FALSE
//
    && $OUT->_display_cache($CFG, $URI) === TRUE)
{
    exit;
}


/*
 * -----------------------------------------------------
 * Load the security class for xss and csrf support
 * -----------------------------------------------------
 */
$SEC =& load_class('Security', 'core');

/*
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
$IN =& load_class('Input', 'core');

/*
 * ------------------------------------------------------
 *  Load the Language class
 * ------------------------------------------------------
 */
$LANG =& load_class('Lang', 'core');


/*
 * ------------------------------------------------------
 *  Load the app controller and local controller
 * ------------------------------------------------------
 *
 */
// Removed by Ivan Tcholakov.
//// Load the base controller class
//require BASEPATH.'core/Controller.php';
//


/**
 * Reference to the CI_Controller method.
 *
 * Returns current CI instance object
 *
 * @return object
 */
function &get_instance()
{
    return CI_Controller::get_instance();
}

// Added by Ivan Tcholakov, 07-OCT-2013.
// ci() - a handy alias of get_instance()
function &ci()
{
    return get_instance();
}
//


// Many modifications by Ivan Tcholakov.
//--------------------------------------------------------------------------

if (NORMAL_MVC_EXECUTION) {

    // Modified by Ivan Tcholakov, 25-JUL-2013.
    $class = ucfirst($RTR->class);
    //$class  = $RTR->class;
    //

    // Added by Ivan Tcholakov, 08-OCT-2013.
    $class_no_suffix = str_replace($CFG->config['controller_suffix'], '', $class);
    $class_lcfirst = lcfirst($class);
    $class_lcfirst_no_suffix = str_replace($CFG->config['controller_suffix'], '', $class_lcfirst);
    $class_include_path = null;

    $app_search_dir = realpath(resolve_path(APPPATH.'controllers/'.$RTR->directory));
    if ($app_search_dir !== false) {
        $app_search_dir = rtrim(str_replace('\\', '/', $app_search_dir), '/').'/';
    }

    $common_search_dir = realpath(resolve_path(COMMONPATH.'controllers/'.$RTR->directory));
    if ($common_search_dir !== false) {
        $common_search_dir = rtrim(str_replace('\\', '/', $common_search_dir), '/').'/';
    }
    //

    // Load the local application controller
    // Note: The Router class automatically validates the controller path using the router->_validate_request().
    // If this include fails it means that the default controller in the Routes.php file is not resolving to something valid.
    // Modified by Ivan Tcholakov, 28-FEB-2012.
    //if ( ! file_exists(APPPATH.'controllers/'.$RTR->directory.$RTR->class.'.php'))
    //{
    //    show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
    //}
    //
    //include(APPPATH.'controllers/'.$RTR->directory.$RTR->class.'.php');
    //
    if ($app_search_dir != '' && file_exists($app_search_dir.$class.'.php'))
    {
        $class_include_path = $app_search_dir.$class.'.php';
    }
    elseif ($app_search_dir != '' && file_exists($app_search_dir.$class_no_suffix.'.php'))
    {
        $class = $class_no_suffix;
        $class_include_path = $app_search_dir.$class.'.php';
    }
    elseif ($app_search_dir != '' && file_exists($app_search_dir.$class_lcfirst.'.php'))
    {
        $class = $class_lcfirst;
        $class_include_path = $app_search_dir.$class.'.php';
    }
    elseif ($app_search_dir != '' && file_exists($app_search_dir.$class_lcfirst_no_suffix.'.php'))
    {
        $class = $class_lcfirst_no_suffix;
        $class_include_path = $app_search_dir.$class.'.php';
    }
    elseif ($common_search_dir != '' && file_exists($common_search_dir.$class.'.php'))
    {
        $class_include_path = $common_search_dir.$class.'.php';
    }
    elseif ($common_search_dir != '' && file_exists($common_search_dir.$class_no_suffix.'.php'))
    {
        $class = $class_no_suffix;
        $class_include_path = $common_search_dir.$class.'.php';
    }
    elseif ($common_search_dir != '' && file_exists($common_search_dir.$class_lcfirst.'.php'))
    {
        $class = $class_lcfirst;
        $class_include_path = $common_search_dir.$class.'.php';
    }
    elseif ($common_search_dir != '' && file_exists($common_search_dir.$class_lcfirst_no_suffix.'.php'))
    {
        $class = $class_lcfirst_no_suffix;
        $class_include_path = $common_search_dir.$class.'.php';
    }
    else
    {
        show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
    }

    require $class_include_path;
    //

} else {

    require COMMONPATH.'controllers/'.$class.'.php';
}

//--------------------------------------------------------------------------
//


// Set a mark point for benchmarking
$BM->mark('loading_time:_base_classes_end');


//--------------------------------------------------------------------------

if (NORMAL_MVC_EXECUTION) {

/*
 * ------------------------------------------------------
 *  Security check
 * ------------------------------------------------------
 *
 *  None of the methods in the app controller or the
 *  loader class can be called via the URI, nor can
 *  controller methods that begin with an underscore.
 */
    $method = $RTR->method;

    if ( ! class_exists($class, FALSE) OR $method[0] === '_' OR method_exists('CI_Controller', $method))
    {
        if ( ! empty($RTR->routes['404_override']))
        {
            if (sscanf($RTR->routes['404_override'], '%[^/]/%s', $class, $method) !== 2)
            {
                $method = 'index';
            }

            // Removed by Ivan Tcholakov, 25-JUL-2013.
            //$class = ucfirst($class);
            //

            if ( ! class_exists($class, FALSE))
            {
                if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
                {
                    show_404($class.'/'.$method);
                }

                include_once(APPPATH.'controllers/'.$class.'.php');
            }
        }
        else
        {
            show_404($class.'/'.$method);
        }
    }

    if (method_exists($class, '_remap'))
    {
        $params = array($method, array_slice($URI->rsegments, 2));
        $method = '_remap';
    }
    else
    {
        // WARNING: It appears that there are issues with is_callable() even in PHP 5.2!
        // Furthermore, there are bug reports and feature/change requests related to it
        // that make it unreliable to use in this context. Please, DO NOT change this
        // work-around until a better alternative is available.
        if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($class)), TRUE))
        {
            if (empty($RTR->routes['404_override']))
            {
                show_404($class.'/'.$method);
            }
            elseif (sscanf($RTR->routes['404_override'], '%[^/]/%s', $class, $method) !== 2)
            {
                $method = 'index';
            }

            // Removed by Ivan Tcholakov, 25-JUL-2013.
            //$class = ucfirst($class);
            //

            if ( ! class_exists($class, FALSE))
            {
                if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
                {
                    show_404($class.'/'.$method);
                }

                include_once(APPPATH.'controllers/'.$class.'.php');
            }
        }

        $params = array_slice($URI->rsegments, 2);
    }

}

//--------------------------------------------------------------------------


/*
 * ------------------------------------------------------
 *  Is there a "pre_controller" hook?
 * ------------------------------------------------------
 */
$EXT->call_hook('pre_controller');

/*
 * ------------------------------------------------------
 *  Instantiate the requested controller
 * ------------------------------------------------------
 */

// Mark a start point so we can benchmark the controller
$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_start');

$CI = new $class();

/*
 * ------------------------------------------------------
 *  Is there a "post_controller_constructor" hook?
 * ------------------------------------------------------
 */
$EXT->call_hook('post_controller_constructor');

// Here the controller gets in charge...
