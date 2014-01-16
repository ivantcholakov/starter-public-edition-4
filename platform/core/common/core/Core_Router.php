<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// SEO Friendly URLS in CodeIgniter 2.0 + HMVC
// http://www.einsteinseyes.com/blog/techno-babble/seo-friendly-urls-in-codeigniter-2-0-hmvc/

// Controller location logic has been modified by Ivan Tcholakov, 2013.
class Core_Router extends MX_Router {

    public function __construct() {

        parent::__construct();
    }

    // Added by Ivan Tcholakov, 12-OCT-2013.
    // If you need slug support, extend this class to MY_Router and alter this method.
    protected function relocate($segments) {

        return $segments;
    }

    /** Locate the controller **/
    public function locate($segments) {

        $segments = $this->relocate($segments);

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
                    } elseif ($is_module_directory_controller) {
                        $result = array_slice($segments, 2);
                    }
                } elseif ($is_module_controller) {
                    $result = array_slice($segments, 1);
                } elseif ($is_module_directory) {
                    $this->directory = $subdirectory;
                    if ($is_module_directory_controller) {
                        $result = array_slice($segments, 2);
                    } elseif ($is_module_directory_default_controller) {
                        $result = array_slice($segments, 1);
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
                $this->set_directory(trim($this->uri->filter_uri($_GET[$this->config->item('directory_trigger')])));
                $segments[] = $this->directory;
            }

            $this->set_class(trim($this->uri->filter_uri($_GET[$this->config->item('controller_trigger')])));
            $segments[] = $this->class;

            if ( ! empty($_GET[$this->config->item('function_trigger')]) && is_string($_GET[$this->config->item('function_trigger')]))
            {
                $this->set_method(trim($this->uri->filter_uri($_GET[$this->config->item('function_trigger')])));
                $segments[] = $this->method;
            }
        }

        // Load the routes.php file.
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

        // Were there any query string segments? If so, we'll validate them and bail out since we're done.
        if (count($segments) > 0)
        {
            return $this->_validate_request($segments);
        }

        // Fetch the complete URI string
        $this->uri->_fetch_uri_string();

        // Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
        if ($this->uri->uri_string == '')
        {
            return $this->_set_default_controller();
        }

        $this->uri->_remove_url_suffix(); // Remove the URL suffix
        $this->uri->_explode_segments(); // Compile the segments into an array
        $this->_parse_routes(); // Parse any custom routing that may exist
        $this->uri->_reindex_segments(); // Re-index the segment array so that it starts with 1 rather than 0
    }

}
