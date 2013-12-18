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
    function auto_link($str, $type = 'both', $popup = FALSE)
    {
        // Find and replace any URLs.
        // Modified by Ivan Tcholakov, 19-DEC-2013.
        //if ($type !== 'email' && preg_match_all('#(\w*://|www\.)[^\s()<>;]+\w#i', $str, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER))
        if ($type !== 'email' && preg_match_all('#(\w*://|www\.)[^\s()<>;]+(\w|/)#i', $str, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER))
        //
        {
            // Set our target HTML if using popup links.
            $target = ($popup) ? ' target="_blank"' : '';

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
                $a = '<a href="'.(strpos($match[1][0], '/') ? '' : 'http://').$match[0][0].'"'.$target.'>'.$match[0][0].'</a>';
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
                    $str = substr_replace($str, safe_mailto($match[0]), $match[1], strlen($match[0]));
                }
            }
        }

        return $str;
    }
}
