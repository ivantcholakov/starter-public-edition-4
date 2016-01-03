<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package     CodeIgniter
 * @author      Rick Ellis
 * @copyright   Copyright (c) 2006, pMachine, Inc.
 * @license     http://www.codeigniter.com/user_guide/license.html
 * @link        http://www.codeigniter.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Asset Library
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Philip Sturgeon < email@philsturgeon.co.uk >
 */
class Asset {

    private $theme = NULL;
    private $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();

        $this->_ci->load->config('asset');
    }

    // ------------------------------------------------------------------------

    // Added by Ivan Tcholakov, 03-JAN-2016.
    public function css_inline($content)
    {
        return html_tag('style', array('type' => 'text/css'), PHP_EOL.$content.PHP_EOL).PHP_EOL;
    }

    /**
     * CSS
     *
     * Helps generate CSS asset HTML.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @param       string    optional, extra attributes
     * @return      string    HTML code for JavaScript asset
     */
    public function css($asset_name, $module_name = NULL, $attributes = array(), $location_type = '')
    {
        $attributes = html_attr($attributes);

        if (html_attr_has_empty($attributes, 'rel')) {
            $attributes = html_attr_set($attributes, 'rel', 'stylesheet');
        }

        $location_type = 'css_' . (in_array($location_type, array('url', 'path')) ? $location_type : 'path');

        return '
    <link href="'.$this->{$location_type}($asset_name, $module_name).'" type="text/css"'.$attributes.' />';
    }

    // ------------------------------------------------------------------------

    /**
     * CSS Path
     *
     * Generate CSS asset path locations.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    full url to css asset
     */
    public function css_path($asset_name, $module_name = NULL)
    {
        return $this->_asset_path($asset_name, $module_name, config_item('asset_css_dir'));
    }

    // ------------------------------------------------------------------------

    /**
     * CSS URL
     *
     * Generate CSS asset URLs.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    full url to css asset
     */
    public function css_url($asset_name, $module_name = NULL)
    {
        return $this->_asset_url($asset_name, $module_name, config_item('asset_css_dir'));
    }

    // ------------------------------------------------------------------------

    /**
     * Image
     *
     * Helps generate image HTML.
     *
     * @access      public
     * @param       string    the name of the image
     * @param       string    optional, module name
     * @param       string    optional, extra attributes
     * @return      string    HTML code for image asset
     */
    public function image($asset_name, $module_name = '', $attributes = array(), $location_type = '')
    {
        $asset_name = @ (string) $asset_name;
        $attributes = html_attr($attributes);

        // No alternative text given? Use the filename, better than nothing!
        if (!html_attr_has($attributes, 'alt')) {

            list($alt) = explode('.', $asset_name); // TODO: Improve this for URL type asset name.
            $attributes = html_attr_set($attributes, 'alt', $alt);
        }

        $optional = $location_type && (substr($location_type, -1) === '?') AND (($location_type = substr($location_type, 0, -1)) === 'path');
        $location_type = 'image_' . (($optional OR in_array($location_type, array('url', 'path'))) ? $location_type : 'path');
        $location = $this->{$location_type}($asset_name, $module_name);

        if ($optional && ! is_file(FCPATH . ltrim($location, '/')))
        {
            return '';
        }

        return '<img src="'.$location.'"'.$attributes.' />';
    }

    // ------------------------------------------------------------------------

    /**
     * Image Path
     *
     * Helps generate image paths.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    full url to image asset
     */
    public function image_path($asset_name, $module_name = NULL)
    {
        return $this->_asset_path($asset_name, $module_name, config_item('asset_img_dir'), 'path');
    }

    // ------------------------------------------------------------------------

    /**
     * Image URL
     *
     * Helps generate image URLs.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    full url to image asset
     */
    public function image_url($asset_name, $module_name = NULL)
    {
        return $this->_asset_url($asset_name, $module_name, config_item('asset_img_dir'));
    }

    // ------------------------------------------------------------------------

    // Added by Ivan Tcholakov, 03-JAN-2016.
    public function js_inline($content)
    {
        return html_tag('script', array('type' => 'text/javascript'), PHP_EOL.'//<![CDATA['.PHP_EOL.$content.PHP_EOL.'//]]>'.PHP_EOL).PHP_EOL;
    }

    /**
     * JS
     *
     * Helps generate JavaScript asset HTML.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    HTML code for JavaScript asset
     */
    public function js($asset_name, $module_name = NULL, $attributes = array(), $location_type = '')
    {
        $attributes = html_attr($attributes);
        $location_type = 'js_' . (in_array($location_type, array('url', 'path')) ? $location_type : 'path');

        return '
    <script type="text/javascript" src="'.$this->{$location_type}($asset_name, $module_name).'"'.$attributes.'></script>';
    }

    // ------------------------------------------------------------------------

    /**
     * JS Path
     *
     * Helps generate JavaScript asset paths.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    web root path to JavaScript asset
     */
    public function js_path($asset_name, $module_name = NULL)
    {
        return $this->_asset_path($asset_name, $module_name, config_item('asset_js_dir'));
    }

    // ------------------------------------------------------------------------

    /**
     * JS URL
     *
     * Helps generate JavaScript asset locations.
     *
     * @access      public
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    full url to JavaScript asset
     */
    public function js_url($asset_name, $module_name = NULL)
    {
        return $this->_asset_url($asset_name, $module_name, config_item('asset_js_dir'));
    }

    // ------------------------------------------------------------------------

    /**
     * General Asset HTML Helper
     *
     * The main asset location generator
     *
     * @access      private
     * @param       string    the name of the file or asset
     * @param       string    optional, module name
     * @return      string    HTML code for JavaScript asset
     */
    private function _asset_path($asset_name, $module_name = NULL, $asset_type = NULL)
    {
        return $this->_other_asset_location($asset_name, $module_name, $asset_type, 'path');
    }

    public function _asset_url($asset_name, $module_name = NULL, $asset_type = NULL)
    {
        return $this->_other_asset_location($asset_name, $module_name, $asset_type, 'url');
    }

    private function _other_asset_location($asset_name, $module_name = NULL, $asset_type = NULL, $location_type = 'url')
    {
        // Check whether the given name is a full URL or an absolute path.
        if (strpos($asset_name, '://') !== FALSE || strpos($asset_name, '//') === 0 || strpos($asset_name, '/') === 0)
        {
            return $asset_name;
        }

        $base_location = config_item($location_type == 'url' ? 'asset_url' : 'asset_dir');

        // If they are using a direct path, take them to it
        if (strpos($asset_name, 'assets/') !== FALSE)
        {
            $asset_location = $base_location.$asset_name;
        }

        // If they have just given a filename, not an asset path, and its in a theme
        elseif ($module_name == '_theme_' AND $this->theme)
        {
            $base_location = $location_type == 'url' ? rtrim(site_url(), '/').'/' : BASE_URI;
            $asset_location = $base_location.ltrim(config_item('theme_asset_dir'), '/').$this->theme.'/'.$asset_type.'/'.$asset_name;
        }

        // Normal file (that might be in a module)
        else
        {
            $asset_location = $base_location;

            // It's in a module, ignore the current
            if ($module_name)
            {
                foreach (Modules::$locations as $path => $offset)
                {
                    if (is_dir($path.$module_name))
                    {
                        $base_location = $location_type == 'url' ? rtrim(site_url(), '/').'/' : BASE_URI;
                        $asset_location = $base_location.$path.$module_name.'/';
                        break;
                    }
                }
            }

            $asset_location .= ($asset_type == '' ? '' : $asset_type.'/').$asset_name;
        }

        return $asset_location;
    }

    // ------------------------------------------------------------------------

    /**
     * Set theme
     *
     * If you use some sort of theme system, this method stores the theme name
     *
     * @access      public
     * @param       string        theme name
     */
    public function set_theme($theme)
    {
        $this->theme = $theme;
    }

}
