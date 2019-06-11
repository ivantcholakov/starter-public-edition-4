<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Public Class - used for all public pages
 */
class Public_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('public_theme'));

        // set up global header data
        $this
            ->add_css_theme( "{$this->settings->theme}.css" )
            ->add_js_theme( "{$this->settings->theme}_i18n.js", TRUE );

        // declare main template
        $this->template = "../../themes/{$this->settings->theme}/template.php";
    }

}
