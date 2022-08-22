<?php defined('BASEPATH') OR exit('No direct script access allowed');

// CLI -------------------------------------------------------------------------

if (!function_exists('escape_shell_arg')) {

    /**
     * Escapes command line shell arguments, this is an alternative
     * to the built-in PHP function escapeshellarg($arg).
     *
     * @param string $arg   The input string.
     * @return string
     *
     * @see https://www.php.net/manual/en/function.escapeshellarg.php
     * @see http://stackoverflow.com/questions/6427732/how-can-i-escape-an-arbitrary-string-for-use-as-a-command-line-argument-in-windo
     * @see http://markushedlund.com/dev-tech/php-escapeshellarg-with-unicodeutf-8-support
     *
     * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016-2020.
     * @license The MIT License (MIT)
     * @link http://opensource.org/licenses/MIT
     */
    function escape_shell_arg($arg)
    {
        if (stripos(PHP_OS, 'win') === 0) { // Beware about 'Darwin', etc.

            // PHP engine is built for Windows.

            // Sequence of backslashes followed by a double quote:
            // double up all the backslashes and escape the double quote
            $arg = preg_replace('/(\\*)"/', '$1$1\\"', $arg);

            // Sequence of backslashes followed by the end of the arg,
            // which will become a double quote later:
            // double up all the backslashes
            $arg = preg_replace('/(\\*)$/', '$1$1', $arg);

            // All other backslashes do not need modifying

            // Double-quote the whole thing
            $arg = '"'.$arg.'"';

            // Escape shell metacharacters.
            $arg = preg_replace('/([\(\)%!^"<>&|;, ])/', '^$1', $arg);

            return $arg;
        }

        // PHP engine is built for Linux or similar.

        return "'" . str_replace("'", "'\\''", $arg) . "'";
    }

}

// -----------------------------------------------------------------------------

if ( ! function_exists('get_config'))
{
    /**
     * Loads the main config.php file
     *
     * This function lets us grab the config file even if the Config class
     * hasn't been instantiated yet
     *
     * @param     array
     * @return    array
     */
    function &get_config(Array $replace = array())
    {
        static $config;

        if (empty($config))
        {
            // Added by Ivan Tcholakov, 02-OCT-2013.
            // Loading the common configuration file first.
            $file_path = COMMONPATH.'config/config.php';
            $found = FALSE;
            if (file_exists($file_path))
            {
                $found = TRUE;
                require($file_path);
            }
            if (file_exists($file_path = COMMONPATH.'config/'.ENVIRONMENT.'/config.php'))
            {
                require($file_path);
            }
            //

            $file_path = APPPATH.'config/config.php';
            // Removed by Ivan Tcholakov, 02-OCT-2013.
            //$found = FALSE;
            //
            if (file_exists($file_path))
            {
                $found = TRUE;
                require($file_path);
            }

            // Is the config file in the environment folder?
            if (file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
            {
                require($file_path);
            }
            elseif ( ! $found)
            {
                set_status_header(503);
                echo 'The configuration file does not exist.';
                exit(3); // EXIT_CONFIG
            }

            // Does the $config array exist in the file?
            if ( ! isset($config) OR ! is_array($config))
            {
                set_status_header(503);
                echo 'Your config file does not appear to be formatted correctly.';
                exit(3); // EXIT_CONFIG
            }
        }

        // Are any values being dynamically added or replaced?
        foreach ($replace as $key => $val)
        {
            $config[$key] = $val;
        }

        return $config;
    }
}

// -----------------------------------------------------------------------------

if ( ! function_exists('load_class'))
{
    /**
     * Class registry
     *
     * This function acts as a singleton. If the requested class does not
     * exist it is instantiated and set to a static variable. If it has
     * previously been instantiated the variable is returned.
     *
     * @param       string      the class name being requested
     * @param       string      the directory where the class should be found
     * @param       mixed       an optional argument to pass to the class constructor
     * @return      object
     */
    function &load_class($class, $directory = 'libraries', $param = NULL)
    {
        static $_classes = array();

        // Does the class exist? If so, we're done...
        if (isset($_classes[$class]))
        {
            return $_classes[$class];
        }

        $name = FALSE;

        // Look for the class first in the local application/libraries folder
        // then in the native system/libraries folder
        foreach (array(APPPATH, BASEPATH) as $path)
        {
            if (file_exists($path.$directory.'/'.$class.'.php'))
            {
                $name = 'CI_'.$class;

                if (!class_exists($name, FALSE))
                {
                    require_once $path.$directory.'/'.$class.'.php';
                }

                break;
            }
        }

        // Added by Ivan Tcholakov, 11-OCT-2013.
        // Load customized core classes.
        if (file_exists(COMMONPATH."$directory/Core_$class.php"))
        {
            $name = 'Core_'.$class;

            if (!class_exists($name, FALSE))
            {
                require_once COMMONPATH."$directory/Core_$class.php";
            }
        }
        //

        // Is the request a class extension? If so we load it too
        if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
        {
            $name = config_item('subclass_prefix').$class;

            if (!class_exists($name, FALSE))
            {
                require_once APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php';
            }
        }

        // Did we find the class?
        if ($name === FALSE)
        {
            // Note: We use exit() rather then show_error() in order to avoid a
            // self-referencing loop with the Exceptions class
            set_status_header(503);
            echo 'Unable to locate the specified class: '.$class.'.php';
            exit(5); // EXIT_UNK_CLASS
        }

        // Keep track of what we just loaded
        is_loaded($class);

        $_classes[$class] = new $name();
        return $_classes[$class];
    }
}

// -----------------------------------------------------------------------------

if ( ! function_exists('get_mimes'))
{
    /**
     * Returns the MIME types array from config/mimes.php
     *
     * @return    array
     */
    function &get_mimes()
    {
        static $_mimes;

        if (empty($_mimes))
        {
            $_mimes = file_exists(COMMONPATH.'config/mimes.php')
                ? include(COMMONPATH.'config/mimes.php')
                : array();

            if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/mimes.php'))
            {
                $_mimes = array_merge($_mimes, include(COMMONPATH.'config/'.ENVIRONMENT.'/mimes.php'));
            }

            if (file_exists(APPPATH.'config/mimes.php'))
            {
                $_mimes = array_merge($_mimes, include(APPPATH.'config/mimes.php'));
            }

            if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
            {
                $_mimes = array_merge($_mimes, include(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'));
            }
        }

        return $_mimes;
    }
}

// -----------------------------------------------------------------------------

if ( ! function_exists('_error_handler'))
{
    /**
     * Error Handler
     *
     * This is the custom error handler that is declared at the (relative)
     * top of CodeIgniter.php. The main reason we use this is to permit
     * PHP errors to be logged in our own log files since the user may
     * not have access to server logs. Since this function effectively
     * intercepts PHP errors, however, we also need to display errors
     * based on the current error_reporting level.
     * We do that with the use of a PHP error template.
     *
     * @param       int         $severity
     * @param       string      $message
     * @param       string      $filepath
     * @param       int         $line
     * @return      void
     */
    function _error_handler($severity, $message, $filepath, $line)
    {
        // We don't bother with "strict" notices since they tend to fill up
        // the log file with excess information that isn't normally very helpful.
        // For example, if you are running PHP 5 and you use version 4 style
        // class functions (without prefixes like "public", "private", etc.)
        // you'll get notices telling you that these have been deprecated.
        if ($severity == E_STRICT)
        {
            return;
        }

        $is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

        // When an error occurred, set the status header to '500 Internal Server Error'
        // to indicate to the client something went wrong.
        // This can't be done within the $_error->show_php_error method because
        // it is only called when the display_errors flag is set (which isn't usually
        // the case in a production environment) or when errors are ignored because
        // they are above the error_reporting threshold.
        if ($is_error)
        {
            set_status_header(500);
        }

        // Should we ignore the error? We'll get the current error_reporting
        // level and add its bits with the severity bits to find out.
        if (($severity & error_reporting()) !== $severity)
        {
            return;
        }

        $_error =& load_class('Exceptions', 'core');
        $_error->log_exception($severity, $message, $filepath, $line);

        // Should we display the error?
        if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
        {
            $_error->show_php_error($severity, $message, $filepath, $line);
        }

        // If the error is fatal, the execution of the script should be stopped because
        // errors can't be recovered from. Halting the script conforms with PHP's
        // default error handling. See http://www.php.net/manual/en/errorfunc.constants.php
        if ($is_error)
        {
            exit(1); // EXIT_ERROR
        }
    }
}

// -----------------------------------------------------------------------------

// Escapers

// Added by Ivan Tcholakov, 26-APR-2016.
if (!function_exists('html_attr_escape')) {

    function html_attr_escape($string) {

        $twig = & _get_simple_twig_instance();

        return call_user_func($twig->getFilter('escape')->getCallable(), $twig, $string, 'html_attr');
    }

}

// Added by Ivan Tcholakov, 26-APR-2016.
if (!function_exists('js_escape')) {

    function js_escape($string) {

        $twig = & _get_simple_twig_instance();

        return call_user_func($twig->getFilter('escape')->getCallable(), $twig, $string, 'js');
    }

}

// Added by Ivan Tcholakov, 26-APR-2016.
if (!function_exists('css_escape')) {

    function css_escape($string) {

        $twig = & _get_simple_twig_instance();

        return call_user_func($twig->getFilter('escape')->getCallable(), $twig, $string, 'css');
    }

}

// Added by Ivan Tcholakov, 26-APR-2016.
if (!function_exists('url_escape')) {

    function url_escape($string) {

        $twig = & _get_simple_twig_instance();

        return call_user_func($twig->getFilter('escape')->getCallable(), $twig, $string, 'url');
    }

}

// Added by Ivan Tcholakov, 28-JUN-2016.
// An implementation of the function esc(), introduced in CodeIgniter 4.
// The original CI4 function will be watched further for possible changes.
// Valid context values: 'html', 'js', 'css', 'url', 'attr', 'raw', null
if (!function_exists('esc')) {

    function esc($data, $context = 'html', $charset = null) {

        if (is_array($data)) {

            foreach ($data as $key => & $value) {
                $value = esc($value, $context, $charset);
            }

        } elseif (is_string($data)) {

            $context = strtolower($context);

            if (empty($context) || $context == 'raw') {
                return $data;
            }

            if (!in_array($context, array('html', 'js', 'css', 'url', 'attr'))) {
                throw new InvalidArgumentException('Invalid escape context provided.');
            }

            if ($context == 'attr') {
                $context = 'html_attr';
            }

            $twig = & _get_simple_twig_instance($charset);

            $data = call_user_func($twig->getFilter('escape')->getCallable(), $twig, $data, $context);
        }

        return $data;
    }

}

// Added by Ivan Tcholakov, 26-APR-2016.
if (!function_exists('_get_simple_twig_instance')) {

    function & _get_simple_twig_instance($charset = null) {

        static $instance = array();

        $charset = (string) $charset;

        if ($charset == '') {
            $charset = config_item('charset');
        }

        $charset = strtoupper($charset);

        if (!isset($instance[$charset])) {

            $instance[$charset] = new \Twig\Environment(
                new \Parser_Twig_Loader_Filesystem([]),
                array(
                    'debug' => false,
                    'charset' => $charset,
                    'strict_variables' => false,
                    'autoescape' => 'html',
                    'cache' => false,
                    'auto_reload' => null,
                    'optimizations' => -1,
                )
            );
        }

        return $instance[$charset];
    }

}

// End Escapers

// -----------------------------------------------------------------------------

if ( ! function_exists('_stringify_attributes'))
{
    /**
     * Stringify attributes for use in HTML tags.
     *
     * Helper function used to convert a string, array, or object
     * of attributes to a string.
     *
     * @param       mixed       string, array, object
     * @param       bool
     * @return      string
     */
    function _stringify_attributes($attributes, $js = FALSE)
    {
        if (empty($attributes))
        {
            return NULL;
        }

        // Added by Ivan Tcholakov, 03-JAN-2016.
        if (!$js)
        {
            return html_attr($attributes);
        }
        //

        if (is_string($attributes))
        {
            return ' '.$attributes;
        }

        $attributes = (array) $attributes;

        $atts = '';
        foreach ($attributes as $key => $val)
        {
            $atts .= ($js) ? $key.'='.$val.',' : ' '.$key.'="'.$val.'"';
        }

        return rtrim($atts, ',');
    }
}

if ( ! function_exists('html_code'))
{
    // Added by Ivan Tcholakov, 22-JAN-2016.
    function html_code($string, $begin = null, $end = null)
    {
        if ($begin === null)
        {
            $begin = '<pre><code>';
        }

        if ($end === null)
        {
            $end = '</code></pre>';
        }

        return $begin.html_escape($string).$end;
    }
}

// -----------------------------------------------------------------------------

// Processing HTML Attributes
// Ivan Tcholakov, 2016.

if (!function_exists('html_attr')) {

    function html_attr($attributes, $return_as_array = false) {

        $attr = new HTML_Attributes($attributes);

        return $attr->getAttributes( ! $return_as_array);
    }

}

if (!function_exists('html_attr_has')) {

    function html_attr_has($attributes, $name) {

        $attr = new HTML_Attributes($attributes);

        return $attr->getAttribute($name) !== null;
    }

}

if (!function_exists('html_attr_has_empty')) {

    function html_attr_has_empty($attributes, $name) {

        $attr = new HTML_Attributes($attributes);

        return $attr->getAttribute($name) == '';
    }

}

if (!function_exists('html_attr_get')) {

    function html_attr_get($attributes, $name) {

        $attr = new HTML_Attributes($attributes);

        return $attr->getAttribute($name);
    }

}

if (!function_exists('html_attr_set')) {

    function html_attr_set($attributes, $name, $value = null, $return_as_array = false) {

        $attr = new HTML_Attributes($attributes);

        $attr->setAttribute($name, $value);

        return $attr->getAttributes( ! $return_as_array);
    }

}

if (!function_exists('html_attr_merge')) {

    function html_attr_merge($attributes1, $attributes2, $return_as_array = false) {

        $attr1 = new HTML_Attributes($attributes1);
        $attr2 = new HTML_Attributes($attributes2);

        $class2 = $attr2->getAttribute('class');
        $attr2->removeAttribute('class');
        $attr1->addClass($class2);

        $attr1->mergeAttributes($attr2->getAttributes());

        if (trim($attr1->getAttribute('class')) == '') {
            $attr1->removeAttribute('class');
        }

        return $attr1->getAttributes( ! $return_as_array);
    }

}

if (!function_exists('html_attr_remove')) {

    function html_attr_remove($attributes, $name, $return_as_array = false) {

        $attr = new HTML_Attributes($attributes);

        $attr->removeAttribute($name);

        return $attr->getAttributes( ! $return_as_array);
    }

}

if (!function_exists('html_attr_has_class')) {

    function html_attr_has_class($attributes, $class) {

        $attr = new HTML_Attributes($attributes);

        return $attr->hasClass($class);
    }

}

if (!function_exists('html_attr_add_class')) {

    function html_attr_add_class($attributes, $class, $return_as_array = false) {

        $attr = new HTML_Attributes($attributes);

        $attr->addClass($class);

        return $attr->getAttributes( ! $return_as_array);
    }

}

if (!function_exists('html_attr_remove_class')) {

    function html_attr_remove_class($attributes, $class, $return_as_array = false) {

        $attr = new HTML_Attributes($attributes);

        $attr->removeClass($class);

        if (trim($attr->getAttribute('class')) == '') {
            $attr->removeAttribute('class');
        }

        return $attr->getAttributes( ! $return_as_array);
    }

}

// End Processing HTML Attributes

// -----------------------------------------------------------------------------

// HTML Tags

// Added by Ivan Tcholakov, 03-JAN-2016.
if (!function_exists('html_tag')) {

    function html_tag($tag = null, $attributes = array(), $content = false) {

        $tag = trim(@ (string) $tag);

        $has_content = $content !== false && $content !== null;

        switch (strtolower($tag)) {

            case 'script':

                $has_content = true;
                break;
        }

        return '<'.$tag.html_attr($attributes).($has_content ? '>'.$content.'</'.$tag.'>' : ' />');
    }

}

// Added by Ivan Tcholakov, 03-JAN-2016.
if (!function_exists('html_tag_open')) {

    function html_tag_open($tag, $attributes = array()) {

        $tag = trim(@ (string) $tag);

        return '<'.$tag.html_attr($attributes).'>';
    }

}

// Added by Ivan Tcholakov, 03-JAN-2016.
if (!function_exists('html_tag_close')) {

    function html_tag_close($tag) {

        $tag = trim(@ (string) $tag);

        return '</'.$tag.'>';
    }

}

// Added by Ivan Tcholakov, 03-JAN-2016.
// See http://stackoverflow.com/questions/2519845/how-to-check-if-string-is-a-valid-xml-element-name
if (!function_exists('xml_tag_valid_name')) {

    function xml_tag_valid_name($name) {

        static $pattern = '~
# XML 1.0 Name symbol PHP PCRE regex <http://www.w3.org/TR/REC-xml/#NT-Name>
(?(DEFINE)
    (?<NameStartChar> [:A-Z_a-z\\xC0-\\xD6\\xD8-\\xF6\\xF8-\\x{2FF}\\x{370}-\\x{37D}\\x{37F}-\\x{1FFF}\\x{200C}-\\x{200D}\\x{2070}-\\x{218F}\\x{2C00}-\\x{2FEF}\\x{3001}-\\x{D7FF}\\x{F900}-\\x{FDCF}\\x{FDF0}-\\x{FFFD}\\x{10000}-\\x{EFFFF}])
    (?<NameChar>      (?&NameStartChar) | [.\\-0-9\\xB7\\x{0300}-\\x{036F}\\x{203F}-\\x{2040}])
    (?<Name>          (?&NameStartChar) (?&NameChar)*)
)
^(?&Name)$
~ux';

        return 1 === preg_match($pattern, $name);
    }

}

// End HTM Tags

// -----------------------------------------------------------------------------
