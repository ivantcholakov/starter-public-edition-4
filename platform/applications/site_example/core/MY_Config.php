<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT for my modifications.
 */

class MY_Config extends Core_Config {

    public function __construct() {

        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Site URL
     *
     * Returns base_url . index_page [. uri_string]
     *
     * @access    public
     * @param     mixed    the URI string
     * @return    string
     */
    public function site_url($uri = '')
    {
        // Added by Ivan Tcholakov, 12-OCT-2013.
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }
        //

        // Added by Ivan Tcholakov, 16-NOV-2013.
        // See https://github.com/EllisLab/CodeIgniter/wiki/CodeIgniter-2.1-internationalization-i18n
        if (function_exists('get_instance'))        
        {
            $CI =& get_instance();

            if (isset($CI->lang) && is_object($CI->lang)) {
                $uri = $CI->lang->localized($uri);
            }
        }
        //

        if (empty($uri))
        {
            return $this->slash_item('base_url').$this->item('index_page');
        }

        $uri = $this->_uri_string($uri);

        if ($this->item('enable_query_strings') === FALSE)
        {
            $suffix = isset($this->config['url_suffix']) ? $this->config['url_suffix'] : '';

            if ($suffix !== '')
            {
                if (($offset = strpos($uri, '?')) !== FALSE)
                {
                    $uri = substr($uri, 0, $offset).$suffix.substr($uri, $offset);
                }
                else
                {
                    $uri .= $suffix;
                }
            }

            return $this->slash_item('base_url').$this->slash_item('index_page').$uri;
        }
        elseif (strpos($uri, '?') === FALSE)
        {
            $uri = '?'.$uri;
        }

        return $this->slash_item('base_url').$this->item('index_page').$uri;
    }

    // --------------------------------------------------------------------

    // Added by Ivan Tcholakov, 09-NOV-2013.
    public function site_uri($uri = '') {

        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }

        // Added by Ivan Tcholakov, 16-NOV-2013.
        // See https://github.com/EllisLab/CodeIgniter/wiki/CodeIgniter-2.1-internationalization-i18n
        if (function_exists('get_instance'))        
        {
            $CI =& get_instance();

            if (isset($CI->lang) && is_object($CI->lang)) {
                $uri = $CI->lang->localized($uri);
            }        
        }
        //

        if (empty($uri))
        {
            return SITE_URI;
        }

        $uri = $this->_uri_string($uri);

        if ($this->item('enable_query_strings') === FALSE)
        {
            $suffix = isset($this->config['url_suffix']) ? $this->config['url_suffix'] : '';

            if ($suffix !== '')
            {
                if (($offset = strpos($uri, '?')) !== FALSE)
                {
                    $uri = substr($uri, 0, $offset).$suffix.substr($uri, $offset);
                }
                else
                {
                    $uri .= $suffix;
                }
            }

            return BASE_URI.$this->slash_item('index_page').$uri;
        }
        elseif (strpos($uri, '?') === FALSE)
        {
            $uri = '?'.$uri;
        }

        return BASE_URI.$this->item('index_page').$uri;
    }

}
