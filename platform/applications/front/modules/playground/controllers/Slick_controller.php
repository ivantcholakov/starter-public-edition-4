<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Slick_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Slick Carousel Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/slick'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('css', 'slick_css')
            ->set_partial('scripts', 'slick_scripts')
            ->build('slick');
    }

}
