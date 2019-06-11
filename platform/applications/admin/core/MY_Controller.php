<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Class all other classes extend
 */
class MY_Controller extends CI_Controller {

	/**
     * Common data
     */
    public $user;
    public $settings;
    public $languages;
    public $includes;
    public $current_uri;
    public $theme;
    public $template;
    public $error;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // get settings
        $settings = $this->settings_model->get_settings();
        $this->settings = new stdClass();
        foreach ($settings as $setting)
        {
            $this->settings->{$setting['name']} = (@unserialize($setting['value']) !== FALSE) ? unserialize($setting['value']) : $setting['value'];
        }
        $this->settings->site_version = $this->config->item('site_version');
        $this->settings->root_folder  = $this->config->item('root_folder');

        // get current uri
        $this->current_uri = "/" . uri_string();

        // set the time zone
        $timezones = $this->config->item('timezones');
        if (function_exists('date_default_timezone_set'))
        {
            date_default_timezone_set($timezones[$this->settings->timezones]);
        }

        // get current user
        $this->user = $this->session->userdata('logged_in');

        // get languages
        $this->languages = get_languages();

        // set language according to this priority:
        //   1) First, check session
        //   2) If session not set, use the users language
        //   3) Finally, if no user, use the configured languauge
        if ($this->session->language)
        {
            // language selected from nav
            $this->config->set_item('language', $this->session->language);
        }
        elseif ($this->user['language'])
        {
            // user's saved language
            $this->config->set_item('language', $this->user['language']);
        }
        else
        {
            // default language
            $this->config->set_item('language', $this->config->item('language'));
        }

        // save selected language to session
        $this->session->language = $this->config->item('language');

        // load the core language file
        $this->lang->load('core');

        // set global header data - can be merged with or overwritten in controllers
        $this
            ->add_external_css(
                array(
                    "//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",
                    "//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css",
                    "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
                    base_url("/themes/core/css/core.css")
                ))
            ->add_external_js(
                array(
                    "//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js",
                    "//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                ));

		$core_js = $this->jsi18n->translate("/themes/core/js/core_i18n.js");
		$core_js = str_replace("<<base_url>>", base_url(), $core_js);

        $this->includes[ 'js_files_i18n' ] = array(
            $core_js
        );

        // enable the profiler?
        $this->output->enable_profiler($this->config->item('profiler'));
	}


    /**
     * Add CSS from external source or outside folder theme
     *
     * This function used to easily add css files to be included in a template.
     * with this function, we can just add css name as parameter and their external path,
     * or add css complete with path. See example.
     *
     * We can add one or more css files as parameter, either as string or array.
     * If using parameter as string, it must use comma separator between css file name.
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as first parameter
     *     $this->add_external_css( "global.css, color.css", "http://example.com/assets/css/" );
     *      or
     *      $this->add_external_css(  "http://example.com/assets/css/global.css, http://example.com/assets/css/color.css" );
     *
     * 2. Using array as first parameter
     *     $this->add_external_css( array( "global.css", "color.css" ),  "http://example.com/assets/css/" );
     *      or
     *      $this->add_external_css(  array( "http://example.com/assets/css/global.css", "http://example.com/assets/css/color.css") );
     *
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.1.0
     * @access  public
     * @param   mixed
     * @param string, default = NULL
     * @return  chained object
     */
    function add_external_css($css_files, $path = NULL)
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->includes[ 'css_files' ][ sha1( $css ) ] = is_null( $path ) ? $css : $path . $css;
        }

        return $this;
    }


    /**
     * Add JS from external source or outside folder theme
     *
     * This function used to easily add js files to be included in a template.
     * with this function, we can just add js name as parameter and their external path,
     * or add js complete with path. See example.
     *
     * We can add one or more js files as parameter, either as string or array.
     * If using parameter as string, it must use comma separator between js file name.
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as first parameter
     *     $this->add_external_js( "global.js, color.js", "http://example.com/assets/js/" );
     *      or
     *      $this->add_external_js(  "http://example.com/assets/js/global.js, http://example.com/assets/js/color.js" );
     *
     * 2. Using array as first parameter
     *     $this->add_external_js( array( "global.js", "color.js" ),  "http://example.com/assets/js/" );
     *      or
     *      $this->add_external_js(  array( "http://example.com/assets/js/global.js", "http://example.com/assets/js/color.js") );
     *
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.1.0
     * @access  public
     * @param   mixed
     * @param string, default = NULL
     * @return  chained object
     */
    function add_external_js( $js_files, $path = NULL )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $js_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->includes[ 'js_files' ][ sha1( $js ) ] = is_null( $path ) ? $js : $path . $js;
        }

        return $this;
    }


    /**
     * Add CSS from Active Theme Folder
     *
     * This function used to easily add css files to be included in a template.
     * with this function, we can just add css name as parameter
     * and it will use default css path in active theme.
     *
     * We can add one or more css files as parameter, either as string or array.
     * If using parameter as string, it must use comma separator between css file name.
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_css_theme( "bootstrap.min.css, style.css, admin.css" );
     *
     * 2. Using array as parameter
     *     $this->add_css_theme( array( "bootstrap.min.css", "style.css", "admin.css" ) );
     *
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.0.5
     * @access  public
     * @param   mixed
     * @return  chained object
     */
    function add_css_theme( $css_files )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->includes[ 'css_files' ][ sha1( $css ) ] = base_url( "/themes/{$this->settings->theme}/css" ) . "/{$css}";
        }

        return $this;
    }


    /**
     * Add JS from Active Theme Folder
     *
     * This function used to easily add js files to be included in a template.
     * with this function, we can just add js name as parameter
     * and it will use default js path in active theme.
     *
     * We can add one or more js files as parameter, either as string or array.
     * If using parameter as string, it must use comma separator between js file name.
     *
     * The second parameter is used to determine wether js file is support internationalization or not.
     * Default is FALSE
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_js_theme( "jquery-1.11.1.min.js, bootstrap.min.js, another.js" );
     *
     * 2. Using array as parameter
     *     $this->add_js_theme( array( "jquery-1.11.1.min.js", "bootstrap.min.js,", "another.js" ) );
     *
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.0.5
     * @access  public
     * @param   mixed
     * @param   boolean
     * @return  chained object
     */
    function add_js_theme( $js_files, $is_i18n = FALSE )
    {
        if ( $is_i18n )
            return $this->add_jsi18n_theme( $js_files );

        // make sure that $this->includes has array value
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $js ) as a key to prevent duplicate js to be included
            $this->includes[ 'js_files' ][ sha1( $js ) ] = base_url( "/themes/{$this->settings->theme}/js" ) . "/{$js}";
        }

        return $this;
    }


    /**
     * Add JSi18n files from Active Theme Folder
     *
     * This function used to easily add jsi18n files to be included in a template.
     * with this function, we can just add jsi18n name as parameter
     * and it will use default js path in active theme.
     *
     * We can add one or more jsi18n files as parameter, either as string or array.
     * If using parameter as string, it must use comma separator between jsi18n file name.
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_jsi18n_theme( "dahboard_i18n.js, contact_i18n.js" );
     *
     * 2. Using array as parameter
     *     $this->add_jsi18n_theme( array( "dahboard_i18n.js", "contact_i18n.js" ) );
     *
     * 3. Or we can use add_js_theme function, and add TRUE for second parameter
     *     $this->add_js_theme( "dahboard_i18n.js, contact_i18n.js", TRUE );
     *      or
     *     $this->add_js_theme( array( "dahboard_i18n.js", "contact_i18n.js" ), TRUE );
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.0.5
     * @access  public
     * @param   mixed
     * @return  chained object
     */
    function add_jsi18n_theme( $js_files )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $js ) as a key to prevent duplicate js to be included
            $this->includes[ 'js_files_i18n' ][ sha1( $js ) ] = $this->jsi18n->translate( "/themes/{$this->settings->theme}/js/{$js}" );
        }

        return $this;
    }


    /* Set Page Title
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.0.5
     * @access  public
     * @param   string
     * @return  chained object
     */
    function set_title( $page_title )
    {
        $this->includes[ 'page_title' ] = $page_title;

        /* check wether page_header has been set or has a value
        * if not, then set page_title as page_header
        */
        $this->includes[ 'page_header' ] = isset( $this->includes[ 'page_header' ] ) ? $this->includes[ 'page_header' ] : $page_title;
        return $this;
    }


    /* Set Page Header
     * sometime, we want to have page header different from page title
     * so, use this function
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.0.5
     * @access  public
     * @param   string
     * @return  chained object
     */
    function set_page_header( $page_header )
    {
        $this->includes[ 'page_header' ] = $page_header;
        return $this;
    }


    /* Set Template
     * sometime, we want to use different template for different page
     * for example, 404 template, login template, full-width template, sidebar template, etc.
     * so, use this function
     * --------------------------------------
     * @author  Arif Rahman Hakim
     * @since   Version 3.1.0
     * @access  public
     * @param   string, template file name
     * @return  chained object
     */
    function set_template( $template_file = 'template.php' )
    {
        // make sure that $template_file has .php extension
        $template_file = substr( $template_file, -4 ) == '.php' ? $template_file : ( $template_file . ".php" );

        $this->template = "../../{$this->settings->root_folder}/themes/{$this->settings->theme}/{$template_file}";
    }

}
