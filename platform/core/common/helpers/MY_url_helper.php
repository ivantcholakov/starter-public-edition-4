<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('base_uri')) {

    // Added by Ivan Tcholakov, 09-NOV-2013.
    function base_uri($uri = '') {

        return get_instance()->config->base_uri($uri);
    }
}

if (!function_exists('site_uri')) {

    // Added by Ivan Tcholakov, 09-NOV-2013.
    function site_uri($uri = '') {

        return get_instance()->config->site_uri($uri);
    }
}

if (!function_exists('url_add_params')) {

    // See http://www.bin-co.com/php/scripts/misc/getlink/
    // Deprecated function. Use http_build_url() instead.
    function url_add_params($url, $params = array(), $xml_compliant = false, $skip_empty_params = true) {

        $param_separator = $xml_compliant ? '&amp;' : '&';

        if (empty($params) || !is_array($params)) {
            return $url;
        }

        $param_starter = '';

        if (strpos($url, '?') === false) {
            $param_starter = '?';
        }
        elseif (!preg_match('/(\?|\&(amp;)?)$/', $url)) {
            $param_starter = $param_separator;
        }

        $params_arr = array();

        foreach ($params as $key => $value) {

            if (is_array($value)) {

                if ($skip_empty_params && empty($value)) {
                    continue;
                }

                foreach ($value as $value_nested) {
                    $params_arr[] = $key . '[]=' . urlencode($value_nested);
                }

            } else {

                if ($skip_empty_params && trim($value) == '') {
                    continue;
                }

                $params_arr[] = $key . '=' . urlencode($value);
            }
        }

        $params_serialized = implode($param_separator, $params_arr);

        if ($params_serialized != '') {
            $url .= $param_starter.$params_serialized;
        }

        return $url;
    }

}

if ( ! function_exists('auto_link'))
{
    /**
     * Modifies the auto_link helper (url_helper) by accepting as an optional third
     * argument an array of html attributes for the anchor tags (just like the anchor helper).
     *
     * This array is supplied as the third argument, replacing the
     * optional argument $pop in the original helper.
     * 
     * This modified helper attempts to be backward compatible with the use of the 
     * original helper by accepting TRUE and FALSE as possible values for the $attributes
     * argument, and giving output identical to the original usage of the helper.
     *
     * use:  auto_link($string, 'url' , array('class' => 'external', 'target'=>'_blank'));
     * use:  auto_link($string, 'email', array('class' => 'email_link' , 'style' => 'color:red;'));
     * use(legacy): auto_link($string, 'url' , TRUE);
     *
     * @link https://github.com/EllisLab/CodeIgniter/wiki/auto-link
     * @author Derek Jones (original author)
     * @author Ivan Tcholakov (adaptation)
     *
     * @see url_helper
     * @link http://codeigniter.com/user_guide/helpers/url_helper.html
     * @param string $str
     * @param string $type 
     * @param mixed $attributes 
     * @return string
     */
    function auto_link($str, $type = 'both', $attributes = '')
    {
        static $html_helper_loaded = null;

        if ($html_helper_loaded !== true)
        {
            get_instance()->load->helper('html');
            $html_helper_loaded = true;
        }

        // MAKE THE THIRD ARGUMENT BACKWARD COMPATIBLE
        // here we deal with the original third argument $pop
        // which could be TRUE or FALSE, and was FALSE by default.
        if ($attributes === TRUE)
        {
            $attributes = ' target="_blank"';
        }
        elseif ($attributes === FALSE)
        {
            $attributes = '';
        }

        if ($attributes != '')
        {
            $attributes = ' '.get_attributes_string($attributes);
        }

        // Find and replace any URLs.
        // Modified by Ivan Tcholakov, 19-DEC-2013.
        //if ($type !== 'email' && preg_match_all('#(\w*://|www\.)[^\s()<>;]+\w#i', $str, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER))
        if ($type !== 'email' && preg_match_all('#(\w*://|www\.)[^\s()<>;]+(\w|/)#i', $str, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER))
        //
        {
            // We process the links in reverse order (last -> first) so that
            // the returned string offsets from preg_match_all() are not
            // moved as we add more HTML.
            foreach (array_reverse($matches) as $match)
            {
                // $match[0] is the matched string/link
                // $match[1] is either a protocol prefix or 'www.'
                //
                // With PREG_OFFSET_CAPTURE, both of the above is an array,
                // where the actual value is held in [0] and its offset at the [1] index.
                $a = '<a href="'.(strpos($match[1][0], '/') ? '' : 'http://').$match[0][0].'"'.$attributes.'>'.$match[0][0].'</a>';
                $str = substr_replace($str, $a, $match[0][1], strlen($match[0][0]));
            }
        }

        // Find and replace any emails.
        if ($type !== 'url' && preg_match_all('#([\w\.\-\+]+@[a-z0-9\-]+\.[a-z0-9\-\.]+[^[:punct:]\s])#i', $str, $matches, PREG_OFFSET_CAPTURE))
        {
            foreach (array_reverse($matches[0]) as $match)
            {
                if (filter_var($match[0], FILTER_VALIDATE_EMAIL) !== FALSE)
                {
                    $str = substr_replace($str, safe_mailto($match[0], '', $attributes), $match[1], strlen($match[0]));
                }
            }
        }

        return $str;
    }
}
