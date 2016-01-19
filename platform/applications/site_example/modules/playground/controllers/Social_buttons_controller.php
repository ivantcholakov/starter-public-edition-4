<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Social_buttons_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Social Buttons for Bootstrap';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/social-buttons'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'social_buttons_scripts')
            ->build('social_buttons');
    }

}
