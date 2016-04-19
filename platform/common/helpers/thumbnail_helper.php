<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('thumbnail')) {

    function thumbnail($src, $width = null, $height = null, $no_crop = null, $keep_canvas_size = null, $dynamic_output = null) {

        $dynamic_output = !empty($dynamic_output);

        if ($dynamic_output) {

            if ($no_crop !== null) {
                $no_crop = empty($no_crop) ? 0 : 1;
            }

            if ($keep_canvas_size !== null) {
                $keep_canvas_size = empty($keep_canvas_size) ? 0 : 1;
            }

            $uri = 'thumbnail';

            return http_build_url(default_base_url($uri), array(
                    'query' => http_build_query(array(
                        'src' => $src,
                        'w' => $width,
                        'h' => $height,
                        'no_crop' => $no_crop,
                        'keep_canvas_size' => $keep_canvas_size
                    )
                )
             ), HTTP_URL_JOIN_QUERY);
        }

        $ci = & get_instance();

        $ci->load->library('thumbnail');

        $thumbnail = $ci->thumbnail->create($src, $width , $height, $no_crop, $keep_canvas_size, true, $dynamic_output);

        if (!is_array($thumbnail)) {
            return false;
        }

        return $thumbnail['url'];
    }

}
