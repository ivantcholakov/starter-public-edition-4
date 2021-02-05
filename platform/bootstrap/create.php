<?php

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
 * The Bootstrap folder, for our custom initialization.
 *---------------------------------------------------------------
 */
define('BOOTSTRAPPATH', rtrim(str_replace('\\', '/', realpath(dirname(__FILE__))), '/').'/');

if (BOOTSTRAPPATH == '' || BOOTSTRAPPATH == '/' || !is_dir(BOOTSTRAPPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your bootstrap folder path (BOOTSTRAPPATH) does not appear to be set correctly. Please, make corrections within the following file: '.__FILE__;
    exit(3); // EXIT_* constants not yet defined; 3 is EXIT_CONFIG.
}


/*
 *---------------------------------------------------------------
 * Do our custom initialization first.
 *---------------------------------------------------------------
 */
require_once BOOTSTRAPPATH.'bootstrap.php';


// Added here by Ivan Tcholakov.
/*
 * --------------------------------------------------------------------
 * Load the base controller class definition.
 * --------------------------------------------------------------------
 */
require_once BASEPATH.'core/Controller.php';
//


/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
{
    require_once APPPATH.'config/'.ENVIRONMENT.'/constants.php';
}

if (file_exists(APPPATH.'config/constants.php'))
{
    require_once APPPATH.'config/constants.php';
}

if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/constants.php'))
{
    require_once COMMONPATH.'config/'.ENVIRONMENT.'/constants.php';
}

require COMMONPATH.'config/constants.php';


/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
if (file_exists(APPPATH.'core/Common.php')) {
    require_once APPPATH.'core/Common.php';
}

require COMMONPATH.'core/Common.php';
require_once BASEPATH.'core/Common.php';


/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
set_error_handler('_error_handler');
set_exception_handler('_exception_handler');
register_shutdown_function('_shutdown_handler');

/*
 * ------------------------------------------------------
 *  Set the subclass_prefix
 * ------------------------------------------------------
 *
 * Normally the "subclass_prefix" is set in the config file.
 * The subclass prefix allows CI to know if a core class is
 * being extended via a library in the local application
 * "libraries" folder. Since CI allows config items to be
 * overridden via data set in the main index.php file,
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
 *  Should we use a Composer autoloader?
 * ------------------------------------------------------
 */
// See https://getcomposer.org/doc/00-intro.md#system-requirements
if ($composer_autoload = config_item('composer_autoload'))
{
    if ($composer_autoload === TRUE)
    {
        file_exists(PLATFORMPATH.'vendor/autoload.php')
            ? require_once(PLATFORMPATH.'vendor/autoload.php')
            : log_message('error', '$config[\'composer_autoload\'] is set to TRUE but '.PLATFORMPATH.'vendor/autoload.php was not found.');
    }
    elseif (file_exists($composer_autoload))
    {
        require_once($composer_autoload);
    }
    else
    {
        log_message('error', 'Could not find the specified $config[\'composer_autoload\'] path: '.$composer_autoload);
    }
}

/*
 * ------------------------------------------------------
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
$BM =& load_class('Benchmark', 'core');
$BM->mark('total_execution_time_start');
$BM->mark('loading_time:_base_classes_start');


/**
 * Reference to the CI_Controller method.
 *
 * Returns current CI instance object
 *
 * @return CI_Controller
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


/*
 * ------------------------------------------------------
 *  DB Connections Before a Controller Has Been Created
 * ------------------------------------------------------
 */

// See https://github.com/ivantcholakov/starter-public-edition-4/issues/67

// CodeIgniter's database cache folder.
define('CACHE_DB_PATH', WRITABLEPATH.'cache_db/'.APPNAME.'/');
file_exists(CACHE_DB_PATH) OR @mkdir(CACHE_DB_PATH, DIR_WRITE_MODE, TRUE);

// Added by Ivan Tcholakov, 28-MAY-2016.
// Corrected by Ivan Tcholakov, 29-JUN-2016.
function & get_db_instance($connection_group = null)
{
    static $connections = array();

    $connection_group = (string) $connection_group;

    if ($connection_group == '')
    {
        $connection_group = 'default';
    }

    if (array_key_exists($connection_group, $connections))
    {
        return $connections[$connection_group];
    }

    $connections[$connection_group] = null;

    if (!function_exists('DB'))
    {
        // See https://github.com/ivantcholakov/starter-public-edition-4/issues/5
        if (file_exists(APPPATH.'database/DB.php'))
        {
            require_once APPPATH.'database/DB.php';
        }
        elseif (file_exists(COMMONPATH.'database/DB.php'))
        {
            require_once COMMONPATH.'database/DB.php';
        }
        else
        {
            require_once BASEPATH.'database/DB.php';
        }
    }

    $connections[$connection_group] = & DB($connection_group);

    // Break code execution when establishing database connection fails, prevent infinite looping.
    if (!is_object($connections[$connection_group]) || empty($connections[$connection_group]->conn_id))
    {
        exit(8); // EXIT_DATABASE
    }
    //

    return $connections[$connection_group];
}
//

// Note: This is the earliest tested place where
// the function get_db_instance() can be called.


/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 *
 * Note: It is important that Config is loaded first as
 * most other classes depend on it either directly or by
 * depending on another class that uses it.
 *
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

$restrictAccessToTrustedHostsOnly = $CFG->item('restrictAccessToTrustedHostsOnly');

if (!empty($restrictAccessToTrustedHostsOnly) && !IS_CLI)
{
    $detectedHost = detect_url('server_name');
    $trustedHosts = $CFG->item('trustedHosts');

    if (empty($trustedHosts) || !is_array($trustedHosts))
    {
        $trustedHosts = array('localhost');
    }

    $trustedHostFound = false;

    foreach ($trustedHosts as $trustedHost)
    {
        if (!is_string($trustedHost))
        {
            continue;
        }

        if (strpos($trustedHost, '/') === 0)
        {
            // The setting is a pattern.
            if (preg_match($trustedHost, $detectedHost))
            {
                $trustedHostFound = true;
                break;
            }
        }
        else
        {
            // The setting is a string to be matched exactly.
            if ($trustedHost === $detectedHost)
            {
                $trustedHostFound = true;
                break;
            }
        }
    }

    if (!$trustedHostFound)
    {
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'Not trusted host/server/domain name.';
        exit;
    }

    unset($detectedHost);
    unset($trustedHosts);
    unset($trustedHostFound);
    unset($trustedHost);
}

unset($restrictAccessToTrustedHostsOnly);

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
 *  Initialize writable folders.
 * ------------------------------------------------------
 */

// A folder that is to contain temporary files only, with a trailing slash.
define('TMP_PATH', WRITABLEPATH.'tmp/');
file_exists(TMP_PATH) OR @mkdir(TMP_PATH, DIR_WRITE_MODE, TRUE);

// CodeIgniter's cache folder.
$cache_path = $CFG->item('cache_path') == '' ? APPPATH.'cache/' : $CFG->item('cache_path');
file_exists($cache_path) OR @mkdir($cache_path, DIR_WRITE_MODE, TRUE);

// For HTMLPurifier, no trailing slash.
define('HTMLPURIFIER_CACHE_SERIALIZER_PATH', WRITABLEPATH.'htmlpurifier');
file_exists(HTMLPURIFIER_CACHE_SERIALIZER_PATH) OR @mkdir(HTMLPURIFIER_CACHE_SERIALIZER_PATH, DIR_WRITE_MODE, TRUE);

// For Handlebars, with a trailing slash.
define('HANDLEBARS_CACHE', WRITABLEPATH.'handlebars/'.APPNAME.'/');
file_exists(HANDLEBARS_CACHE) OR @mkdir(HANDLEBARS_CACHE, DIR_WRITE_MODE, TRUE);

// For Mustache, with a trailing slash.
define('MUSTACHE_CACHE', WRITABLEPATH.'mustache/'.APPNAME.'/');
file_exists(MUSTACHE_CACHE) OR @mkdir(MUSTACHE_CACHE, DIR_WRITE_MODE, TRUE);

// For the LESS-compiler, with a trailing slash.
define('LESS_CACHE', WRITABLEPATH.'less/'.APPNAME.'/');
file_exists(LESS_CACHE) OR @mkdir(LESS_CACHE, DIR_WRITE_MODE, TRUE);

// For Twig template engine, with a trailing slash.
define('TWIG_CACHE', WRITABLEPATH.'twig/'.APPNAME.'/');
file_exists(TWIG_CACHE) OR @mkdir(TWIG_CACHE, DIR_WRITE_MODE, TRUE);

/*
 * ------------------------------------------------------
 * Important charset-related stuff
 * ------------------------------------------------------
 *
 * Configure mbstring and/or iconv if they are enabled
 * and set MB_ENABLED and ICONV_ENABLED constants, so
 * that we don't repeatedly do extension_loaded() or
 * function_exists() calls.
 *
 * Note: UTF-8 class depends on this. It used to be done
 * in it's constructor, but it's _not_ class-specific.
 *
 */
$charset = strtoupper(config_item('charset'));
ini_set('default_charset', $charset);

if (extension_loaded('mbstring'))
{
    define('MB_ENABLED', TRUE);
    // mbstring.internal_encoding is deprecated starting with PHP 5.6
    // and it's usage triggers E_DEPRECATED messages.
    @ini_set('mbstring.internal_encoding', $charset);
    // This is required for mb_convert_encoding() to strip invalid characters.
    // That's utilized by CI_Utf8, but it's also done for consistency with iconv.
    mb_substitute_character('none');
}
else
{
    define('MB_ENABLED', FALSE);
}

// There's an ICONV_IMPL constant, but the PHP manual says that using
// iconv's predefined constants is "strongly discouraged".
if (extension_loaded('iconv'))
{
    define('ICONV_ENABLED', TRUE);
    // iconv.internal_encoding is deprecated starting with PHP 5.6
    // and it's usage triggers E_DEPRECATED messages.
    @ini_set('iconv.internal_encoding', $charset);
}
else
{
    define('ICONV_ENABLED', FALSE);
}

if (is_php('5.6'))
{
    ini_set('php.internal_encoding', $charset);
}

/*
 * ------------------------------------------------------
 *  Load compatibility features
 * ------------------------------------------------------
 */

require_once(BASEPATH.'core/compat/mbstring.php');
require_once(BASEPATH.'core/compat/hash.php');
require_once(BASEPATH.'core/compat/password.php');

/*
 * ------------------------------------------------------
 *  Instantiate the UTF-8 class
 * ------------------------------------------------------
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
$RTR =& load_class('Router', 'core', isset($routing) ? $routing : NULL);

// Added by Ivan Tcholakov, 01-NOV-2013.
if (NORMAL_MVC_EXECUTION)
{

    $RTR->_set_routing();

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
}
else
{
    $base_class_name = 'Dummy';
    $class  = $base_class_name.$CFG->config['controller_suffix'];
    $method = 'index';
    $RTR->set_class($base_class_name);
}
//

/*
 * ------------------------------------------------------
 *  Define constants after the target route is known
 * ------------------------------------------------------
 */
defined('CURRENT_SITE_URL') or define('CURRENT_SITE_URL', $CFG->site_url());
defined('CURRENT_SITE_URI') or define('CURRENT_SITE_URI', $CFG->site_uri());

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
//if ($EXT->call_hook('cache_override') === FALSE && $OUT->_display_cache($CFG, $URI) === TRUE)
// Disable cache when core is not initialized normally.
if (NORMAL_MVC_EXECUTION && $EXT->call_hook('cache_override') === FALSE && $OUT->_display_cache($CFG, $URI) === TRUE)
//
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
//require_once BASEPATH.'core/Controller.php';
//

// Set a mark point for benchmarking
$BM->mark('loading_time:_base_classes_end');

// Many modifications by Ivan Tcholakov.
//--------------------------------------------------------------------------

function _find_controller_file($class, $directory, & $found_class, & $found_path) {

    global $CFG;
    $suffix_pattern = '/'.preg_quote($CFG->config['controller_suffix'], '/').'$/';

    $search_dir = realpath(resolve_path(APPPATH.'controllers/'.$directory));

    if ($search_dir !== false) {

        $search_dir = rtrim(str_replace('\\', '/', $search_dir), '/').'/';

        $found_class = ucfirst($class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }

        $found_class = preg_replace($suffix_pattern, '', $found_class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }

        $found_class = lcfirst($class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }

        $found_class = preg_replace($suffix_pattern, '', $found_class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }
    }

    $search_dir = realpath(resolve_path(COMMONPATH.'controllers/'.$directory));

    if ($search_dir !== false) {

        $search_dir = rtrim(str_replace('\\', '/', $search_dir), '/').'/';

        $found_class = ucfirst($class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }

        $found_class = preg_replace($suffix_pattern, '', $found_class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }

        $found_class = lcfirst($class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }

        $found_class = preg_replace($suffix_pattern, '', $found_class);

        if (file_exists($search_dir.$found_class.'.php')) {

            $found_path = $search_dir.$found_class.'.php';
            return true;
        }
    }

    $found_class = $class;
    $found_path = '';

    return false;
}

/*
 * ------------------------------------------------------
 *  Sanity checks
 * ------------------------------------------------------
 *
 *  The Router class has already validated the request,
 *  leaving us with 3 options here:
 *
 *    1) an empty class name, if we reached the default
 *       controller, but it didn't exist;
 *    2) a query string which doesn't go through a
 *       file_exists() check
 *    3) a regular request for a non-existing page
 *
 *  We handle all of these as a 404 error.
 *
 *  Furthermore, none of the methods in the app controller
 *  or the loader class can be called via the URI, nor can
 *  controller methods that begin with an underscore.
 */
if (NORMAL_MVC_EXECUTION) {

    $e404 = FALSE;
    $class = ucfirst($RTR->class);
    $method = $RTR->method;

    if (empty($class) OR ! _find_controller_file($class, $RTR->directory, $found_class, $found_path))
    {
        $e404 = TRUE;
    }
    else
    {
        $class = $found_class;
        require_once $found_path;

        if ( ! class_exists($class, FALSE) OR $method[0] === '_' OR method_exists('CI_Controller', $method))
        {
            $e404 = TRUE;
        }
        elseif (method_exists($class, '_remap'))
        {
            $params = array($method, array_slice($URI->rsegments, 2));
            $method = '_remap';
        }
        elseif ( ! method_exists($class, $method))
        {
            $e404 = TRUE;
        }
        /**
         * DO NOT CHANGE THIS, NOTHING ELSE WORKS!
         *
         * - method_exists() returns true for non-public methods, which passes the previous elseif
         * - is_callable() returns false for PHP 4-style constructors, even if there's a __construct()
         * - method_exists($class, '__construct') won't work because CI_Controller::__construct() is inherited
         * - People will only complain if this doesn't work, even though it is documented that it shouldn't.
         *
         * ReflectionMethod::isConstructor() is the ONLY reliable check,
         * knowing which method will be executed as a constructor.
         */
        else
        {
            $reflection = new ReflectionMethod($class, $method);
            if ( ! $reflection->isPublic() OR $reflection->isConstructor())
            {
                $e404 = TRUE;
            }
        }
    }

    if ($e404)
    {
        if ( ! empty($RTR->routes['404_override']))
        {
            if (sscanf($RTR->routes['404_override'], '%[^/]/%s', $error_class, $error_method) !== 2)
            {
                $error_method = 'index';
            }

            $error_class = ucfirst($error_class);

            if ( ! class_exists($error_class, FALSE))
            {
                if (_find_controller_file($error_class, $RTR->directory, $found_class, $found_path))
                {
                    $error_class = $found_class;
                    require_once $found_path;
                    $e404 = ! class_exists($error_class, FALSE);
                }
                // Were we in a directory? If so, check for a global override
                elseif ( ! empty($RTR->directory) && _find_controller_file($error_class, '', $found_class, $found_path))
                {
                    $error_class = $found_class;
                    require_once $found_path;
                    if (($e404 = ! class_exists($error_class, FALSE)) === FALSE)
                    {
                        $RTR->directory = '';
                    }
                }
            }
            else
            {
                $e404 = FALSE;
            }
        }

        // Did we reset the $e404 flag? If so, set the rsegments, starting from index 1
        if ( ! $e404)
        {
            $class = $error_class;
            $method = $error_method;

            $URI->rsegments = array(
                1 => $class,
                2 => $method
            );
        }
        else
        {
            show_404($RTR->directory.$class.'/'.$method);
        }
    }

    if ($method !== '_remap')
    {
        $params = array_slice($URI->rsegments, 2);
    }

} else {

    $found_path = COMMONPATH.'controllers/'.$class.'.php';
    require $found_path;
}

//--------------------------------------------------------------------------
//

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

// Added by Ivan Tcholakov, 03-APR-2014.
$CI->path = realpath($found_path);
Modules::$registry[strtolower($CI->path)] = $CI;
//

/*
 * ------------------------------------------------------
 *  Is there a "post_controller_constructor" hook?
 * ------------------------------------------------------
 */
$EXT->call_hook('post_controller_constructor');

// Here the controller gets in charge...
