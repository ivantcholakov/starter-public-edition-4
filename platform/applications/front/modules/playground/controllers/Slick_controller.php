<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Slick_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->set_partial('subnavbar', 'slick_subnavbar')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $title = 'Slick Carousel Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/slick'))
            ->set('subnavbar_item_active', 'basic_example')
            ->set_partial('css', 'slick_css')
            ->set_partial('scripts', 'slick_scripts')
            ->build('slick');
    }

    public function example_2() {

        $title = 'Slick Carousel Test 2';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/slick'))
            ->set('subnavbar_item_active', 'example_2')
            ->set_partial('css', 'slick_2_css')
            ->set_partial('scripts', 'slick_2_scripts')
            ->build('slick_2');
    }

}
