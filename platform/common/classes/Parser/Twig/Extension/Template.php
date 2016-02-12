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
