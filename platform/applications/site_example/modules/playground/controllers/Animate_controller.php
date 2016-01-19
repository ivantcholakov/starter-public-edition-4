<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Animate_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Animate.css Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/animate'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('css', 'animate_css')
            ->set_partial('scripts', 'animate_scripts')
            ->build('animate');
    }

}
