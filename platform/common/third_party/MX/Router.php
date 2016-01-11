<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX core module class */
require dirname(__FILE__).'/Modules.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link        https://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter router class.
 *
 * Install this file as application/third_party/MX/Router.php
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

// SEO Friendly URLS in CodeIgniter 2.0 + HMVC
// http://www.einsteinseyes.com/blog/techno-babble/seo-friendly-urls-in-codeigniter-2-0-hmvc/

// Controller location logic has been modified by Ivan Tcholakov, 2014.

class MX_Router extends CI_Router
{
    // A public property for assisting proper calculation of $ci->uri->ruri_string();
    public $rdir = '';

    protected $module;

    public function fetch_module() {

        return $this->module;
    }

    public function _validate_request($segments) {

        if (count($segments) == 0) {
            return $segments;
        }

        /* locate module controller */
        if ($located = $this->locate($segments)) {
            return $located;
        }

        /* use a default 404_override controller */
        if (isset($this->routes['404_override']) AND $this->routes['404_override']) {

            $segments = explode('/', $this->routes['404_override']);

            if ($located = $this->locate($segments, false)) {
                return $located;
            }
        }

        /* no controller found */
        // Modified by Ivan Tcholakov, 31-OCT-2012.
        //show_404();
        show_404(implode('/', $segments));
        //
    }

    // Override this method in an extension class.
    // You may use it for slug support.
    public function remap($segments, $router_initialization = true) {

        return $segments;
    }

    /** Locate the controller **/
    // Modified by Ivan Tcholakov, 21-JAN-2014.
    //public function locate($segments) {
    public function locate($segments, $router_initialization = true) {
    //

        // Resolving the language.
        if ($router_initialization) {

            if (!empty($segments) && $this->config->valid_language_uri_segment($segments[0])) {

                $language = $this->config->language_by_uri_segment($segments[0]);
                array_shift($segments);
                $this->config->set_current_language($language);

                if (empty($segments)) {
                    $segments = array($this->default_controller, 'index');
                }
            }
        }

        // Processing slugs, if there are any.
        if ($router_initialization) {
            $segments = $this->remap($segments, $router_initialization);
        }

        $this->module = '';
        $this->directory = '';

        // Use module route if available.
        if (isset($segments[0]) && $routes = Modules::parse_routes($segments[0], implode('/', $segments))) {
            $segments = $routes;
        }

        // Get the segments array elements.
        list($segment0, $segment1, $segment2) = array_pad($segments, 3, NULL);

        $segment0 = str_replace('-', '_', $segment0);
        $segment1 = str_replace('-', '_', $segment1);
        $segment2 = str_replace('-', '_', $segment2);

        // Check modules.
        foreach (Modules::$locations as $location => $offset) {

            // Module exists?
            if (is_dir($source = $location.$segment0.'/controllers/')) {

                $is_module_default_controller = false;
                $is_module_controller = false;
                $is_module_directory = false;
                $is_module_directory_default_controller = false;
                $is_module_directory_controller = false;

                $subdirectory = '';

                $this->module = $segment0;
                $this->directory = $offset.$segment0.'/controllers/';

                // module/controller
                if (
                        $segment1
                        &&
                        (
                            $this->is_controller($source.ucfirst($segment1))
                            ||
                            $this->is_controller($source.$segment1)
                        )
                    ) {
                    $is_module_controller = true;
                }

                // module/directory
                if ($segment1 && is_dir($source.$segment1.'/')) {

                    $is_module_directory = true;

                    $source = $source.$segment1.'/';
                    $subdirectory = $this->directory.$segment1.'/';

                    // module/directory (deault_controller = directory)
                    if (
                            $this->is_controller($source.ucfirst($segment1))
                            ||
                            $this->is_controller($source.$segment1)
                        ) {
                        $is_module_directory_default_controller = true;
                    }

                    // module/directory/controller
                    if (
                            $segment2
                            &&
                            (
                                $this->is_controller($source.ucfirst($segment2))
                                ||
                                $this->is_controller($source.$segment2)
                            )
                        ) {
                        $is_module_directory_controller = true;
                    }
                }

                // module (deault_controller = module)
                if (
                        $this->is_controller($source.ucfirst($segment0))
                        ||
                        $this->is_controller($source.$segment0)
                    ) {
                    $is_module_default_controller = true;
                }

                /*
                // This is the original logic.
                if ($is_module_controller) {
                    return array_slice($segments, 1);
                } elseif ($is_module_directory) {
                    $this->directory = $subdirectory;
                    if ($is_module_directory_default_controller) {
                        return array_slice($segments, 1);
                    } elseif ($is_module_directory_controller) {
                        return array_slice($segments, 2);
                    }
                } elseif ($is_module_default_controller) {
                    return $segments;
                }
                */

                // This is the modified logic, Ivan Tcholakov, 16-JUN-2012.
                $result = false;

                if ($is_module_controller && $is_module_directory && ($is_module_directory_default_controller || $is_module_directory_controller)) {
                    $this->directory = $subdirectory;
                    if ($is_module_directory_default_controller) {
                        $result = array_slice($segments, 1);
                        if ($router_initialization) {
                            $this->rdir = $segment0.'/';
                        }
                    } elseif ($is_module_directory_controller) {
                        $result = array_slice($segments, 2);
                        if ($router_initialization) {
                            $this->rdir = $segment0.'/'.$segment1.'/';
                        }
                    }
                } elseif ($is_module_controller) {
                    $result = array_slice($segments, 1);
                    if ($router_initialization) {
                        $this->rdir = $segment0.'/';
                    }
                } elseif ($is_module_directory) {
                    $this->directory = $subdirectory;
                    if ($is_module_directory_controller) {
                        $result = array_slice($segments, 2);
                        if ($router_initialization) {
                            $this->rdir = $segment0.'/'.$segment1.'/';
                        }
                    } elseif ($is_module_directory_default_controller) {
                        $result = array_slice($segments, 1);
                        if ($router_initialization) {
                            $this->rdir = $segment0.'/';
                        }
                    }
                } elseif ($is_module_default_controller) {
                    $result = $segments;
                }

                if ($result !== false) {
                    return $result;
                }
                //
            }
        }

        // Application controller exists?
        if (
                $this->is_controller(APPPATH.'controllers/'.ucfirst($segment0))
                ||
                $this->is_controller(APPPATH.'controllers/'.$segment0)
                // Added by Ivan Tcholakov, 08-OCT-2013.
                ||
                $this->is_controller(COMMONPATH.'controllers/'.ucfirst($segment0))
                ||
                $this->is_controller(COMMONPATH.'controllers/'.$segment0)
                //
            ) {
            return $segments;
        }

        // Application sub-directory controller exists?
        if (
                $segment1
                &&
                (
                    $this->is_controller(APPPATH.'controllers/'.$segment0.'/'.ucfirst($segment1))
                    ||
                    $this->is_controller(APPPATH.'controllers/'.$segment0.'/'.$segment1)
                    // Added by Ivan Tcholakov, 08-OCT-2013.
                    ||
                    $this->is_controller(COMMONPATH.'controllers/'.$segment0.'/'.ucfirst($segment1))
                    ||
                    $this->is_controller(COMMONPATH.'controllers/'.$segment0.'/'.$segment1)
                    //
                )
            ) {
            $this->directory = $segment0.'/';
            if ($router_initialization) {
                $this->rdir = $segment0.'/';
            }
            return array_slice($segments, 1);
        }

        // Application sub-directory default controller exists?
        if (
                $this->is_controller(APPPATH.'controllers/'.$segment0.'/'.ucfirst($this->default_controller))
                ||
                $this->is_controller(APPPATH.'controllers/'.$segment0.'/'.$this->default_controller)
                // Added by Ivan Tcholakov, 08-OCT-2013.
                ||
                $this->is_controller(COMMONPATH.'controllers/'.$segment0.'/'.ucfirst($this->default_controller))
                ||
                $this->is_controller(COMMONPATH.'controllers/'.$segment0.'/'.$this->default_controller)
                //
            ) {
            $this->directory = $segment0.'/';
            return array($this->default_controller);
        }
    }

    public function set_class($class) {

        //$this->class = $class.$this->config->item('controller_suffix');
        $this->class = str_replace('-', '_', $class).$this->config->item('controller_suffix');
    }

    public function set_method($method) {
        $this->method = str_replace('-', '_', $method);
    }

    protected function is_controller($base_path) {

        static $ext;

        if (!isset($ext)) {
            $ext = $this->config->item('controller_suffix').'.php';
        }

        return is_file($base_path.$ext) || is_file($base_path.'.php');
    }

    /**
     * Set route mapping
     *
     * Determines what should be served based on the URI request,
     * as well as any "routes" that have been set in the routing config file.
     *
     * @return    void
     */
    public function _set_routing()
    {
        // Load the routes.php file. It would be great if we could
        // skip this for enable_query_strings = TRUE, but then
        // default_controller would be empty ...

        // Added by Ivan Tcholakov, 08-OCT-2013.
        if (file_exists(COMMONPATH.'config/routes.php'))
        {
            include(COMMONPATH.'config/routes.php');
        }

        if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/routes.php'))
        {
            include(COMMONPATH.'config/'.ENVIRONMENT.'/routes.php');
        }
        //

        if (file_exists(APPPATH.'config/routes.php'))
        {
            include(APPPATH.'config/routes.php');
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
        {
            include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
        }

        // Validate & get reserved routes
        if (isset($route) && is_array($route))
        {
            isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
            isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
            unset($route['default_controller'], $route['translate_uri_dashes']);
            $this->routes = $route;
        }

        // Are query strings enabled in the config file? Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        $segments = array();
        if ($this->config->item('enable_query_strings') === TRUE
            && ! empty($_GET[$this->config->item('controller_trigger')])
            && is_string($_GET[$this->config->item('controller_trigger')])
        )
        {
            if (isset($_GET[$this->config->item('directory_trigger')]) && is_string($_GET[$this->config->item('directory_trigger')]))
            {
                $_d = trim($_GET[$this->config->item('directory_trigger')]);
                $this->uri->filter_uri($_d);
                $this->set_directory($_d);
                $segments[] = $this->directory;
            }

            $_c = trim($_GET[$this->config->item('controller_trigger')]);
            $this->uri->filter_uri($_c);
            $this->set_class($_c);
            $segments[] = $this->class;

            if ( ! empty($_GET[$this->config->item('function_trigger')]) && is_string($_GET[$this->config->item('function_trigger')]))
            {
                $_f = trim($_GET[$this->config->item('function_trigger')]);
                $this->uri->filter_uri($_f);
                $this->set_method($_f);
                $segments[] = $this->method;
            }
        }

        // Were there any query string segments? If so, we'll validate them and bail out since we're done.
        if (count($segments) > 0)
        {
            return $this->_validate_request($segments);
        }

        // Fetch the complete URI string

        // If it's a CLI request, ignore the configuration
        if (is_cli())
        {
            // Modified by Ivan Tcholakov, 19-FEB-2015.
            //$uri = $this->_parse_argv();
            $uri = $this->uri->_parse_argv();
            //
        }
        else
        {
            $protocol = strtoupper($this->uri->config->item('uri_protocol'));
            empty($protocol) && $protocol = 'REQUEST_URI';

            switch ($protocol)
            {
                case 'AUTO': // For BC purposes only
                case 'REQUEST_URI':
                    $uri = $this->uri->_parse_request_uri();
                    break;
                case 'QUERY_STRING':
                    $uri = $this->uri->_parse_query_string();
                    break;
                case 'PATH_INFO':
                default:
                    $uri = isset($_SERVER[$protocol])
                        ? $_SERVER[$protocol]
                        : $this->uri->_parse_request_uri();
                    break;
            }
        }

        $this->uri->_set_uri_string($uri);

        // Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
        if ($this->uri->uri_string == '')
        {
            return $this->_set_default_controller();
        }

        // Remove the URL suffix
        $suffix = (string) $this->uri->config->item('url_suffix');

        if ($suffix !== '')
        {
            $slen = strlen($suffix);

            if (substr($this->uri->uri_string, -$slen) === $suffix)
            {
                $this->uri->uri_string = substr($this->uri->uri_string, 0, -$slen);
            }
        }

        // Compile the segments into an array
        foreach (explode('/', preg_replace('|/*(.+?)/*$|', '\\1', $this->uri->uri_string)) as $val)
        {
            $val = trim($val);
            // Filter segments for security
            $this->uri->filter_uri($val);

            if ($val !== '')
            {
                $this->uri->segments[] = $val;
            }
        }

        $this->_parse_routes(); // Parse any custom routing that may exist

        // Re-index the segment array so that it starts with 1 rather than 0
        array_unshift($this->uri->segments, NULL);
        array_unshift($this->uri->rsegments, NULL);
        unset($this->uri->segments[0]);
        unset($this->uri->rsegments[0]);
    }

    /**
     * Parse Routes
     *
     * Matches any routes that may exist in the config/routes.php file
     * against the URI to determine if the class/method need to be remapped.
     *
     * @return    void
     */
    protected function _parse_routes()
    {
        // Added by Ivan Tcholakov, 14-MAR-2014.
        // Resolving the language.
        // The same check has been placed in locate() method too.
        $segments = $this->uri->segments;

        if (!empty($segments)) {

            if ($this->config->valid_language_uri_segment($segments[0])) {

                $this->config->set_current_language($this->config->language_by_uri_segment($segments[0]));
                array_shift($segments);

                // Added by Ivan Tcholakov, 11-JAN-2016.
                // See https://github.com/ivantcholakov/starter-public-edition-4/issues/66
                $this->uri->segments = $segments;
                //

                if (empty($segments)) {
                    $segments = array($this->default_controller, 'index');
                }
            }
        }
        //

        // Turn the segment array into a URI string
        // Modified by Ivan Tcholakov, 14-MAR-2014.
        //$uri = implode('/', $this->uri->segments);
        $uri = implode('/', $segments);
        //

        // Get HTTP verb
        $http_verb = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';

        // Is there a literal match?  If so we're done
        if (isset($this->routes[$uri]))
        {
            // Check default routes format
            if (is_string($this->routes[$uri]))
            {
                $this->_set_request(explode('/', $this->routes[$uri]));
                return;
            }
            // Is there a matching http verb?
            elseif (is_array($this->routes[$uri]) && isset($this->routes[$uri][$http_verb]))
            {
                $this->_set_request(explode('/', $this->routes[$uri][$http_verb]));
                return;
            }
        }

        // Loop through the route array looking for wildcards
        foreach ($this->routes as $key => $val)
        {
            // Check if route format is using http verb
            if (is_array($val))
            {
                if (isset($val[$http_verb]))
                {
                    $val = $val[$http_verb];
                }
                else
                {
                    continue;
                }
            }

            // Convert wildcards to RegEx
            $key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

            // Does the RegEx match?
            if (preg_match('#^'.$key.'$#', $uri, $matches))
            {
                // Are we using callbacks to process back-references?
                if ( ! is_string($val) && is_callable($val))
                {
                    // Remove the original string from the matches array.
                    array_shift($matches);

                    // Execute the callback using the values in matches as its parameters.
                    $val = call_user_func_array($val, $matches);
                }
                // Are we using the default routing method for back-references?
                elseif (strpos($val, '$') !== FALSE && strpos($key, '(') !== FALSE)
                {
                    $val = preg_replace('#^'.$key.'$#', $val, $uri);
                }

                $this->_set_request(explode('/', $val));
                return;
            }
        }

        // If we got this far it means we didn't encounter a
        // matching route so we'll set the site default route
        $this->_set_request(array_values($this->uri->segments));
    }

}
