<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Template Class
 *
 * Build your CodeIgniter pages much easier with partials, breadcrumbs, layouts and themes
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Philip Sturgeon
 * @license         http://philsturgeon.co.uk/code/dbad-license
 * @link            http://philsturgeon.co.uk/code/codeigniter-template
 */
class Template
{
    private $_module = '';
    private $_controller = '';
    private $_method = '';

    private $_theme = null;
    private $_theme_path = null;
    private $_layout = false; // By default, dont wrap the view with anything
    private $_layout_subdir = ''; // Layouts and partials will exist in views/layouts
    // but can be set to views/foo/layouts with a subdirectory

    private $_title = '';
    private $_metadata = array();

    private $_partials = array();

    private $_breadcrumbs = array();

    private $_title_separator = ' | ';

    // Removed by Ivan Tcholakov, 27-DEC-2013.
    //private $_parser_enabled = true;
    //private $_parser_body_enabled = true;
    //

    // Added by Ivan Tcholakov, 27-DEC-2013.
    private $_parsers = array();
    private $_parsers_body = array();
    //

    private $_minify_enabled = false;

    private $_theme_locations = array();

    private $_is_mobile = false;

    // Seconds that cache will be alive for
    private $cache_lifetime = 0;//7200;

    private $_ci;

    private $_data = array();

    /**
     * Constructor - Sets Preferences
     *
     * The constructor can be passed an array of config values
     */
    public function __construct($config = array())
    {
        $this->_ci =& get_instance();

        $this->_ci->load->helper('asset');
        $this->_ci->load->helper('template');
        $this->_ci->load->helper('html');
        $this->_ci->load->library('user_agent');

        if ( ! empty($config))
        {
            $this->initialize($config);
        }

        log_message('debug', 'Template class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Initialize preferences
     *
     * @param    array    $config
     * @return    void
     */
    public function initialize($config = array())
    {
        foreach ($config as $key => $val)
        {
            if ($key == 'theme' and $val != '')
            {
                $this->set_theme($val);
                continue;
            }

            $this->{'_'.$key} = $val;
        }

        // No locations set in config?
        if ($this->_theme_locations === array())
        {
            // Let's use this obvious default
            $this->_theme_locations = array(APPPATH . 'themes/');
        }

        // Removed by Ivan Tcholakov, 27-DEC-2013.
        //// If the parse is going to be used, best make sure it's loaded
        //if ($this->_parser_enabled === true)
        //{
        //    $this->_ci->load->library('parser');
        //}
        //

        // Modular Separation / Modular Extensions has been detected
        if (method_exists( $this->_ci->router, 'fetch_module' ))
        {
            $this->_module = $this->_ci->router->fetch_module();
        }

        // What controllers or methods are in use
        $this->_controller    = $this->_ci->router->class;
        $this->_method        = $this->_ci->router->method;

        // We'll want to know this later
        $this->_is_mobile = $this->_ci->agent->is_mobile();
    }

    // --------------------------------------------------------------------

    /**
     * Set the module manually. Used when getting results from
     * another module with Modules::run('foo/bar')
     *
     * @param    string    $module The module slug
     * @return    mixed
     */
    public function set_module($module)
    {
        $this->_module = $module;

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Magic Get function to get data
     *
     * @param    string    $name
     * @return    mixed
     */
    public function __get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : null;
    }

    // --------------------------------------------------------------------

    /**
     * Magic Set function to set data
     *
     * @param    string    $name
     * @param    mixed    $value
     * @return    mixed
     */
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    // --------------------------------------------------------------------

    /**
     * Set data using a chainable metod. Provide two strings or an array of data.
     *
     * @param    string    $name
     * @param    mixed    $value
     * @return    object    $this
     */
    public function set($name, $value = null)
    {
        // Lots of things! Set them all
        if (is_array($name) or is_object($name))
        {
            foreach ($name as $item => $value)
            {
                $this->_data[$item] = $value;
            }
        }

        // Just one thing, set that
        else
        {
            $this->_data[$name] = $value;
        }

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Build the entire HTML output combining partials, layouts and views.
     *
     * @param    string    $view
     * @param    array    $data
     * @param    bool    $return
     * @param    bool    $IE_cache
     * @return    string
     */
    public function build($view, $data = array(), $return = false, $IE_cache = true)
    {
        // Added by Ivan Tcholakov, 25-OCT-2012.
        // Preliminary caching the variable $this->_ci->load->_ci_cached_vars['template_views'],
        // so the helper function file_partial() gets able to work.
        self::_find_view_folder();
        //

        // Set whatever values are given. These will be available to all view files
        is_array($data) OR $data = (array) $data;

        // Merge in what we already have with the specific data
        $this->_data = array_merge($this->_data, $data);

        // We don't need you any more buddy
        unset($data);

        if (empty($this->_title))
        {
            $this->_title = $this->_guess_title();
        }

        // Output template variables to the template
        $template['title']            = $this->_title;
        $template['breadcrumbs']    = $this->_breadcrumbs;
        $template['metadata']        = trim(implode("\n    ", $this->_metadata));
        if ($template['metadata'] != '')
        {
            $template['metadata'] = "\n    ".$template['metadata'];
        }
        $template['partials']        = array();

        // Assign by reference, as all loaded views will need access to partials
        $this->_data['template'] =& $template;

        foreach ($this->_partials as $name => $partial)
        {
            // We can only work with data arrays
            is_array($partial['data']) OR $partial['data'] = (array) $partial['data'];

            // If it uses a view, load it
            if (isset($partial['view']))
            {
                // Modified by Ivan Tcholakov, 28-DEC-2013.
                //$template['partials'][$name] = $this->_find_view($partial['view'], $partial['data']);
                $template['partials'][$name] = $this->_find_view($partial['view'], $partial['data'], $this->_parsers);
                //
            }

            // Otherwise the partial must be a string
            else
            {
                // Modified by Ivan Tcholakov, 27-DEC-2013.
                //if ($this->_parser_enabled === true)
                //{
                //    $partial['string'] = $this->_ci->parser->parse_string($partial['string'], $this->_data + $partial['data'], true, true);
                //}
                if (!empty($this->_parsers))
                {
                    $data = $this->_data + $partial['data'];

                    foreach ($this->_parsers as $parser => $config)
                    {
                        $this->_ci->load->parser($parser);
                        $partial['string'] = $this->_ci->{$parser}->parse_string($partial['string'], $data, true, $config);
                    }

                    unset($data);
                }
                //

                $template['partials'][$name] = $partial['string'];
            }
        }

        // Disable sodding IE7's constant cacheing!!
        // This is in a conditional because otherwise it errors when output is returned instead of output to browser.
        if ($IE_cache)
        {
            $this->_ci->output->set_header('Expires: Sat, 01 Jan 2000 00:00:01 GMT', true);
            $this->_ci->output->set_header('Cache-Control: no-store, no-cache, must-revalidate', true);
            $this->_ci->output->set_header('Cache-Control: post-check=0, pre-check=0, max-age=0', false);
            $this->_ci->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT', true);
            $this->_ci->output->set_header('Pragma: no-cache', true);
        }

        // Let CI do the caching instead of the browser
        $this->cache_lifetime > 0 && $this->_ci->output->cache( $this->cache_lifetime );

        // Test to see if this file
        // Modified by Ivan Tcholakov, 28-DEC-2013.
        //$this->_body = $this->_find_view( $view, array(), $this->_parser_body_enabled );
        $this->_body = $this->_find_view( $view, array(), $this->_parsers_body);
        //

        // Want this file wrapped with a layout file?
        if ($this->_layout)
        {
            // Added to $this->_data['template'] by refference
            $template['body'] = $this->_body;

            // Find the main body and 3rd param means parse if its a theme view (only if parser is enabled)
            // Modified by Ivan Tcholakov, 27-DEC-2013.
            //$this->_body = self::_load_view('layouts/'.$this->_layout, $this->_data, true, self::_find_view_folder());
            $this->_body = self::_load_view('layouts/'.$this->_layout, $this->_data, $this->_parsers, self::_find_view_folder());
            //
        }

        if ($this->_minify_enabled && function_exists('process_data_jmr1'))
        {
            $this->_body = process_data_jmr1($this->_body);
        }

        // Want it returned or output to browser?
        if ( ! $return)
        {
            $this->_ci->output->set_output($this->_body);
            // Added by Ivan Tcholakov, 29-MAR-2013.
            return;
            //
        }

        return $this->_body;
    }

    /**
     * Build the entire JSON output, setting the headers for response.
     *
     * @param    array    $data
     * @return    void
     */
    public function build_json($data = array())
    {
        $this->_ci->output->set_header('Content-Type: application/json; charset=utf-8', true);
        $this->_ci->output->set_output(json_encode((object) $data));
    }

    /**
     * Set the title of the page
     *
     * @return    object    $this
     */
    public function title()
    {
        // If we have some segments passed
        if ($title_segments = func_get_args())
        {
            $this->_title = implode($this->_title_separator, $title_segments);
        }

        return $this;
    }

    // Added by Ivan Tcholakov, 29-MAR-2013.
    public function append_title()
    {
        if ($title_segments = func_get_args())
        {
            if (is_array($title_segments)) {
                $title = implode($this->_title_separator, $title_segments);
            } else {
                $title = $title_segments;
            }

            $this->_title = trim($this->_title) != '' ? $this->_title.$this->_title_separator.$title : $title;
        }

        return $this;
    }

    // Added by Ivan Tcholakov, 09-NOV-2013.
    public function prepend_title() {

        if ($title_segments = func_get_args())
        {
            if (is_array($title_segments)) {
                $title = implode($this->_title_separator, $title_segments);
            } else {
                $title = $title_segments;
            }

            $this->_title = trim($this->_title) != '' ? $title.$this->_title_separator.$this->_title : $title;
        }

        return $this;
    }

    // Added by Ivan Tcholakov, 09-NOV-2013.
    public function set_title_separator($string) {

        $this->_title_separator = $string;

        return $this;
    }

    /**
     * Put extra javascipt, css, meta tags, etc before all other head data
     *
     * @param    string    $line    The line being added to head
     * @return    object    $this
     */
    public function prepend_metadata($line)
    {
        array_unshift($this->_metadata, $line);
        return $this;
    }


    /**
     * Put extra javascipt, css, meta tags, etc after other head data
     *
     * @param    string    $line    The line being added to head
     * @return    object    $this
     */
    public function append_metadata($line)
    {
        $this->_metadata[] = $line;
        return $this;
    }


    /**
     * Set metadata for output later
     *
     * @param    string    $name        keywords, description, etc
     * @param    string    $content    The content of meta data
     * @param    string    $type        Meta-data comes in a few types, links for example
     * @return    object    $this
     */
    public function set_metadata($name, $content, $type = 'meta')
    {
        $name = htmlspecialchars(strip_tags($name));
        $content = trim(htmlspecialchars(strip_tags($content)));

        // Keywords with no comments? ARG! comment them
        if ($name == 'keywords' and ! strpos($content, ','))
        {
            $content = preg_replace('/[\s]+/', ', ', trim($content));
        }

        // Added by Ivan Tcholakov, 29-JAN-2012.
        if (($name == 'keywords' || $name == 'description') && $content == '' && $type == 'meta') {
            unset($this->_metadata[$name]);
            return $this;
        }
        //

        switch($type)
        {
            case 'meta':
                $this->_metadata[$name] =
'<meta name="'.$name.'" content="'.$content.'" />';
            break;

            case 'link':
                $this->_metadata[$content] =
'<link rel="'.$name.'" href="'.$content.'" />';
            break;
        }

        return $this;
    }


    /**
     * Which theme are we using here?
     *
     * @param    string    $theme    Set a theme for the template library to use
     * @return    object    $this
     */
    public function set_theme($theme = null)
    {
        $this->_theme = $theme;
        foreach ($this->_theme_locations as $location)
        {
            if ($this->_theme and file_exists($location.$this->_theme))
            {
                $this->_theme_path = rtrim($location.$this->_theme.'/');
                break;
            }
        }

        return $this;
    }

    /**
     * Get the current theme path
     *
     * @return    string The current theme path
     */
    public function get_theme_path()
    {
        return $this->_theme_path;
    }

    /**
     * Get the current view path
     *
     * @param    bool    Set if should be returned the view path full (with theme path) or the view relative the theme path
     * @return    string    The current view path
     */
    public function get_views_path($relative = false)
    {
        return $relative ? substr($this->_find_view_folder(), strlen($this->get_theme_path())) : $this->_find_view_folder();
    }

    /**
     * Which theme layout should we using here?
     *
     * @param    string    $view
     * @param    string    $layout_subdir
     * @return    object    $this
     */
    public function set_layout($view, $layout_subdir = null)
    {
        $this->_layout = $view;

        if ($layout_subdir !== null)
        {
            $this->_layout_subdir = $layout_subdir;
        }

        return $this;
    }

    /**
     * Set a view partial
     *
     * @param    string    $name
     * @param    string    $view
     * @param    array    $data
     * @return    object    $this
     */
    public function set_partial($name, $view, $data = array())
    {
        $this->_partials[$name] = array('view' => $view, 'data' => $data);
        return $this;
    }

    /**
     * Set a view partial
     *
     * @param    string    $name
     * @param    string    $string
     * @param    array    $data
     * @return    object    $this
     */
    public function inject_partial($name, $string, $data = array())
    {
        $this->_partials[$name] = array('string' => $string, 'data' => $data);
        return $this;
    }


    /**
     * Helps build custom breadcrumb trails
     *
     * @param    string    $name    What will appear as the link text
     * @param    string    $uri    The URL segment
     * @return    object    $this
     */
    public function set_breadcrumb($name, $uri = '', $reset = false)
    {
        // perhaps they want to start over
        if ($reset)
        {
            $this->_breadcrumbs = array();
        }

        $this->_breadcrumbs[] = array('name' => $name, 'uri' => $uri );
        return $this;
    }

    /**
     * Set a the cache lifetime
     *
     * @param    int        $seconds
     * @return    object    $this
     */
    public function set_cache($seconds = 0)
    {
        $this->cache_lifetime = $seconds;
        return $this;
    }


    /**
     * enable_minify
     * Should be minify used or the output html files just delivered normally?
     *
     * @param    bool    $bool
     * @return    object    $this
     */
    public function enable_minify($bool)
    {
        $this->_minify_enabled = $bool;
        return $this;
    }

    private function _detect_parsers(& $parsers) {

        // BC: Detect a boolean value.

        if (!is_array($parsers)) {

            if (is_bool($parsers)) {

                $is_bool = true;

            } elseif (empty($parsers)) {

                $is_bool = true;
                $parsers = false;
                
            } elseif (is_numeric($parsers)) {

                $is_bool = true;
                $parsers = $parsers > 0;

            } else {

                $is_bool = false;
                $parsers = array((string) $parsers);
            }

        } else {

            $is_bool = false;
        }

        return $is_bool;
    }

    /**
     * enable_parser
     * Should be parser be used or the view files just loaded normally?
     *
     * @param     mixed     $parsers
     * @return    object    $this
     */
    public function enable_parser($parsers)
    {
        // Modified by Ivan Tcholakov, 27-DEC-2013.
        //$this->_parser_enabled = $parsers;
        //return $this;

        $is_bool = $this->_detect_parsers($parsers);

        if ($is_bool) {

            if ($parsers) {

                $this->_parsers['parser'] = array();

            } else {

                $this->_parsers = array();
            }

        } elseif (!empty($parsers)) {

            foreach ($parsers as $parser_key => $parser_value) {

                if (is_string($parser_key)) {

                    if ($parser_value !== false) {

                        $this->_parsers[$parser_key] = $parser_value;

                    } else {

                        if (array_key_exists($parser_key, $this->_parsers)) {

                            unset($this->_parsers[$parser_key]);
                        }
                    }

                } elseif (is_string($parser_value)) {

                    $this->_parsers[$parser_value] = array();
                }
            }
        }

        return $this;
    }

    /**
     * enable_parser_body
     * Should be parser be used or the body view files just loaded normally?
     *
     * @param     mixed     $parsers
     * @return    object    $this
     */
    public function enable_parser_body($parsers)
    {
        // Modified by Ivan Tcholakov, 27-DEC-2013.
        //$this->_parser_body_enabled = $parsers;
        //return $this;

        $is_bool = $this->_detect_parsers($parsers);

        if ($is_bool) {

            if ($parsers) {

                $this->_parsers_body['parser'] = array();

            } else {

                $this->_parsers_body = array();
            }

        } elseif (!empty($parsers)) {

            foreach ($parsers as $parser_key => $parser_value) {

                if (is_string($parser_key)) {

                    if ($parser_value !== false) {

                        $this->_parsers_body[$parser_key] = $parser_value;

                    } else {

                        if (array_key_exists($parser_key, $this->_parsers_body)) {

                            unset($this->_parsers_body[$parser_key]);
                        }
                    }

                } elseif (is_string($parser_value)) {

                    $this->_parsers_body[$parser_value] = array();
                }
            }
        }

        return $this;
    }

    /**
     * theme_locations
     * List the locations where themes may be stored
     *
     * @return    array
     */
    public function theme_locations()
    {
        return $this->_theme_locations;
    }

    /**
     * add_theme_location
     * Set another location for themes to be looked in
     *
     * @access    public
     * @param    string    $location
     * @return    array
     */
    public function add_theme_location($location)
    {
        $this->_theme_locations[] = $location;
    }

    /**
     * theme_exists
     * Check if a theme exists
     *
     * @param    string    $theme
     * @return    bool
     */
    public function theme_exists($theme = null)
    {
        $theme OR $theme = $this->_theme;

        foreach ($this->_theme_locations as $location)
        {
            if (is_dir($location.$theme))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * get_layouts
     * Get all current layouts (if using a theme you'll get a list of theme layouts)
     *
     * @return    array
     */
    public function get_layouts()
    {
        $layouts = array();

        foreach(glob(self::_find_view_folder().'layouts/*.*') as $layout)
        {
            $layouts[] = pathinfo($layout, PATHINFO_BASENAME);
        }

        return $layouts;
    }


    /**
     * get_layouts
     * Get all current layouts (if using a theme you'll get a list of theme layouts)
     *
     * @param    string    $theme
     * @return    array
     */
    public function get_theme_layouts($theme = null)
    {
        $theme OR $theme = $this->_theme;

        $layouts = array();

        foreach ($this->_theme_locations as $location)
        {
            // Get special web layouts
            if( is_dir($location.$theme.'/views/web/layouts/') )
            {
                foreach(glob($location.$theme . '/views/web/layouts/*.*') as $layout)
                {
                    $layouts[] = pathinfo($layout, PATHINFO_BASENAME);
                }
                break;
            }

            // So there are no web layouts, assume all layouts are web layouts
            if(is_dir($location.$theme.'/views/layouts/'))
            {
                foreach(glob($location.$theme . '/views/layouts/*.*') as $layout)
                {
                    $layouts[] = pathinfo($layout, PATHINFO_BASENAME);
                }
                break;
            }
        }

        return $layouts;
    }

    /**
     * layout_exists
     * Check if a theme layout exists
     *
     * @param    string    $layout
     * @return    bool
     */
    public function layout_exists($layout)
    {
        // If there is a theme, check it exists in there
        if ( ! empty($this->_theme) and in_array($layout, self::get_theme_layouts()))
        {
            return true;
        }

        // Otherwise look in the normal places
        return file_exists(self::_find_view_folder().'layouts/' . $layout . self::_ext($layout));
    }


    /**
     * layout_is
     * Check if the current theme layout is equal the $layout argument
     *
     * @param    string    $layout
     * @return    bool
     */
    public function layout_is($layout)
    {
        return $layout === $this->_layout;
    }

    // find layout files, they could be mobile or web
    private function _find_view_folder()
    {
        if (isset($this->_ci->load->_ci_cached_vars['template_views']))
        {
            return $this->_ci->load->_ci_cached_vars['template_views'];
        }

        // Base view folder
        $view_folder = APPPATH.'views/';

        // Using a theme? Put the theme path in before the view folder
        if ( ! empty($this->_theme))
        {
            $view_folder = $this->_theme_path.'views/';
        }

        // Would they like the mobile version?
        if ($this->_is_mobile === true and is_dir($view_folder.'mobile/'))
        {
            // Use mobile as the base location for views
            $view_folder .= 'mobile/';
        }

        // Use the web version
        else if (is_dir($view_folder.'web/'))
        {
            $view_folder .= 'web/';
        }

        // Things like views/admin/web/view admin = subdir
        if ($this->_layout_subdir)
        {
            $view_folder .= $this->_layout_subdir.'/';
        }

        // If using themes store this for later, available to all views
        return $this->_ci->load->_ci_cached_vars['template_views'] = $view_folder;
    }

    // A module view file can be overriden in a theme
    // Modified by Ivan Tcholakov, 28-DEC-2013.
    //private function _find_view($view, array $data, $parse_view = true)
    private function _find_view($view, array $data, $parsers = array())
    //
    {
        // Only bother looking in themes if there is a theme
        if ( ! empty($this->_theme))
        {
            $location = $this->get_theme_path();

            $theme_views = array(
                $this->get_views_path(true) . 'modules/' . $this->_module . '/' . $view,
                // This allows build('pages/page') to still overload same as build('page')
                $this->get_views_path(true) . 'modules/' . $view,
                $this->get_views_path(true) . $view
            );

            foreach ($theme_views as $theme_view)
            {
                if (file_exists($location . $theme_view . self::_ext($theme_view)))
                {
                    return self::_load_view($theme_view, $this->_data + $data, $parsers, $location);
                }
            }
        }

        // Not found it yet? Just load, its either in the module or root view
        return self::_load_view($view, $this->_data + $data, $parsers);
    }

    // Modified by Ivan Tcholakov, 28-DEC-2013.
    //private function _load_view($view, array $data, $parse_view = true, $override_view_path = null)
    private function _load_view($view, array $data, $parsers = array(), $override_view_path = null)
    //
    {
        // Sevear hackery to load views from custom places AND maintain compatibility with Modular Extensions
        if ($override_view_path !== null)
        {
            // Modified by Ivan Tcholakov, 27-DEC-2013.
            //if ($this->_parser_enabled === true and $parse_view === true)
            if (!empty($parsers))
            //
            {
                // Load content and pass through the parser
                // Modified by Ivan Tcholakov, 27-DEC-2013.
                //$content = $this->_ci->parser->parse_string($this->_ci->load->_ci_load(array(
                //    '_ci_path' => $override_view_path.$view.self::_ext($view),
                //    '_ci_vars' => $data,
                //    '_ci_return' => true
                //)), $data, true);
                $content = $this->_ci->load->_ci_load(array(
                    '_ci_path' => $override_view_path.$view.self::_ext($view),
                    '_ci_vars' => $data,
                    '_ci_return' => true,
                    '_ci_parsers_param' => $parsers
                ));
                //
            }

            else
            {
                // Load it directly, bypassing $this->load->view() as ME resets _ci_view
                $content = $this->_ci->load->_ci_load(array(
                    '_ci_path' => $override_view_path.$view.self::_ext($view),
                    '_ci_vars' => $data,
                    '_ci_return' => true
                ));
            }
        }

        // Can just run as usual
        else
        {
            // Grab the content of the view (parsed or loaded)
            // Modified by Ivan Tcholakov, 27-DEC-2013.
            //$content = ($this->_parser_enabled === true AND $parse_view === true)
            //
            //    // Parse that bad boy
            //    ? $this->_ci->parser->parse($view, $data, true )
            //
            //    // None of that fancy stuff for me!
            //    : $this->_ci->load->view($view, $data, true );
            $content = (!empty($parsers))
                ? $this->_ci->load->view($view, $data, true, $parsers)
                : $this->_ci->load->view($view, $data, true );
            //
        }

        return $content;
    }

    private function _guess_title()
    {
        $this->_ci->load->helper('inflector');

        // Obviously no title, lets get making one
        $title_parts = array();

        // If the method is something other than index, use that
        if ($this->_method != 'index')
        {
            $title_parts[] = $this->_method;
        }

        // Make sure controller name is not the same as the method name
        if ( ! in_array($this->_controller, $title_parts))
        {
            $title_parts[] = $this->_controller;
        }

        // Is there a module? Make sure it is not named the same as the method or controller
        if ( ! empty($this->_module) and !in_array($this->_module, $title_parts))
        {
            $title_parts[] = $this->_module;
        }

        // Glue the title pieces together using the title separator setting
        $title = humanize(implode($this->_title_separator, $title_parts));

        return $title;
    }

    private function _ext($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION) ? '' : '.php';
    }

    //--------------------------------------------------------------------------
    // Added by Ivan Tcholakov, 23-OCT-2013.

    public function get_attributes($tag = 'body') {

        // $tag: 'body', 'html'

        $tag = strtolower($tag);

        if (!in_array($tag, array('body', 'html'))) {
            return '';
        }

        if (isset($this->_ci->load->_ci_cached_vars['template_'.$tag.'_tag_attributes'])) {
            return $this->_ci->load->_ci_cached_vars['template_'.$tag.'_tag_attributes'];
        }

        return '';
    }

    public function set_attributes($tag = 'body', $attributes) {

        // $attributes: string or array

        $tag = strtolower($tag);

        if (!in_array($tag, array('body', 'html'))) {
            return;
        }

        $this->_ci->load->_ci_cached_vars['template_'.$tag.'_tag_attributes'] = get_attributes_string($attributes);
    }

    public function merge_attributes($tag = 'body', $attributes) {

        $this->set_attributes($tag, merge_attributes($this->get_attributes($tag), $attributes));
    }

    public function remove_attribute($tag = 'body', $attribute_name) {

        $this->set_attributes($tag, remove_attribute($this->get_attributes($tag), $attribute_name));
    }

    // End of "Added by Ivan Tcholakov, 23-OCT-2013."
    //--------------------------------------------------------------------------
}

// END Template class