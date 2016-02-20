<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Platform {

    public static function captcha() {

        $ci = & get_instance();

        return $ci->captcha;
    }

    public static function current_user() {

        $ci = & get_instance();

        return $ci->current_user;
    }

    // Image Processing Demo.
    // Rework this method or create a similar one according to the
    // concrete image processing implementation.
    public static function my_image_url($src = null, $width = null, $height = null, $no_crop = null, $keep_canvas_size = null) {

        $src = (isset($src) && $src != '') ? $src : image_url('lib/blank.png');

        if ($no_crop !== null) {
            $no_crop = empty($no_crop) ? 0 : 1;
        }

        if ($keep_canvas_size !== null) {
            $keep_canvas_size = empty($keep_canvas_size) ? 0 : 1;
        }

        return http_build_url(site_url('playground/image-process'), array('query' => http_build_query(array('src' => $src, 'w' => $width, 'h' => $height, 'no_crop' => $no_crop, 'keep_canvas_size' => $keep_canvas_size))), HTTP_URL_JOIN_QUERY);
    }

    public static function registry() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $ci = & get_instance();

        $name = $args[0];

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        if (count($args) == 1) {

            return $ci->registry->get($name);
        }

        $ci->registry->set($name,  $args[1]);

        return;
    }

}
