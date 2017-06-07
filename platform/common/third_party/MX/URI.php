<?php

// Added by Ivan Tcholakov, 07-JUN-2017.

defined('BASEPATH') OR exit('No direct script access allowed');

class MX_URI extends CI_URI {

    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Set URI String
     *
     * @param     string    $str
     * @return    void
     */
    /* protected */ public function _set_uri_string($str)
    {
        // Filter out control characters and trim slashes
        $this->uri_string = trim(remove_invisible_characters($str, FALSE), '/');

        // Removed by Ivan Tcholakov, 19-JAN-2014.
        // TODO: This is for supporting HMVC library, resolve at first chance.
        //if ($this->uri_string !== '')
        //{
        //    // Remove the URL suffix, if present
        //    if (($suffix = (string) $this->config->item('url_suffix')) !== '')
        //    {
        //        $slen = strlen($suffix);
        //
        //        if (substr($this->uri_string, -$slen) === $suffix)
        //        {
        //            $this->uri_string = substr($this->uri_string, 0, -$slen);
        //        }
        //    }
        //
        //    $this->segments[0] = NULL;
        //    // Populate the segments array
        //    foreach (explode('/', trim($this->uri_string, '/')) as $val)
        //    {
        //        $val = trim($val);
        //        // Filter segments for security
        //        $this->filter_uri($val);
        //
        //        if ($val !== '')
        //        {
        //            $this->segments[] = $val;
        //        }
        //    }
        //
        //    unset($this->segments[0]);
        //}
        //
    }

    // --------------------------------------------------------------------

    /**
     * Parse REQUEST_URI
     *
     * Will parse REQUEST_URI and automatically detect the URI from it,
     * while fixing the query string if necessary.
     *
     * @return    string
     */
    /* protected */ public function _parse_request_uri()
    {
        if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
        {
            return '';
        }

        // parse_url() returns false if no host is present, but the path or query string
        // contains a colon followed by a number
        $uri = parse_url('http://dummy'.$_SERVER['REQUEST_URI']);
        $query = isset($uri['query']) ? $uri['query'] : '';
        // Modified by Ivan Tcholakov, 19-FEB-2015.
        //$uri = isset($uri['path']) ? $uri['path'] : '';
        $uri = isset($uri['path']) ? rawurldecode($uri['path']) : '';
        //

        if (isset($_SERVER['SCRIPT_NAME'][0]))
        {
            if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
            {
                $uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
            }
            elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
            {
                $uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
            }
        }

        // This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
        // URI is found, and also fixes the QUERY_STRING server var and $_GET array.
        if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
        {
            $query = explode('?', $query, 2);
            // Modified by Ivan Tcholakov, 19-FEB-2015.
            //$uri = $query[0];
            $uri = rawurldecode($query[0]);
            //
            $_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
        }
        else
        {
            $_SERVER['QUERY_STRING'] = $query;
        }

        parse_str($_SERVER['QUERY_STRING'], $_GET);

        if ($uri === '/' OR $uri === '')
        {
            return '/';
        }

        // Do some final cleaning of the URI and return it
        return $this->_remove_relative_directory($uri);
    }

    // --------------------------------------------------------------------

    /**
     * Parse QUERY_STRING
     *
     * Will parse QUERY_STRING and automatically detect the URI from it.
     *
     * @return    string
     */
    /* protected */ public function _parse_query_string()
    {
        $uri = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');

        if (trim($uri, '/') === '')
        {
            return '';
        }
        elseif (strncmp($uri, '/', 1) === 0)
        {
            $uri = explode('?', $uri, 2);
            $_SERVER['QUERY_STRING'] = isset($uri[1]) ? $uri[1] : '';
            // Modified by Ivan Tcholakov, 19-FEB-2015.
            //$uri = $uri[0];
            $uri = rawurldecode($uri[0]);
            //
        }

        parse_str($_SERVER['QUERY_STRING'], $_GET);

        return $this->_remove_relative_directory($uri);
    }

    // --------------------------------------------------------------------

    /**
     * Parse CLI arguments
     *
     * Take each command line argument and assume it is a URI segment.
     *
     * @return    string
     */
    /* protected */ public function _parse_argv()
    {
        $args = array_slice($_SERVER['argv'], 1);
        return $args ? implode('/', $args) : '';
    }

    // --------------------------------------------------------------------

    public function ruri_string()
    {
        return ltrim(load_class('Router', 'core')->rdir, '/').implode('/', $this->rsegments);
    }

    public function language_segment()
    {
        return load_class('Router', 'core')->language_uri_segment;
    }

}
