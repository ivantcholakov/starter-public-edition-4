<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Template {

    public static function body() {

        ob_start();

        template_body();

        return ob_get_clean();
    }

    public static function file_partial($name) {

        ob_start();

        file_partial($name);

        return ob_get_clean();
    }

    public static function partial($name) {

        ob_start();

        template_partial($name);

        return ob_get_clean();
    }

    public static function has_partial($name) {

        return template_has_partial($name);
    }

    public static function html_title() {

        ob_start();

        template_title();

        return ob_get_clean();
    }

    public static function metadata() {

        ob_start();

        template_metadata();

        return ob_get_clean();
    }

}
