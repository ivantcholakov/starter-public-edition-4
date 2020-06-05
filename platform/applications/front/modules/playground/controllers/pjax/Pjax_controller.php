<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Pjax_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper('html_filters');

        $this->template
            ->set_partial('pjax_subnavbar', 'playground/pjax/pjax_subnavbar')
            ->set_partial('scripts', 'playground/pjax/pjax_scripts')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->registry->set('pjax_subnavbar_active', 'home');
        $this->template
            ->append_title('Pjax - Home Page')
            ->set_breadcrumb('Pjax', site_url('playground/pjax'))
            ->build('pjax/pjax');
    }

    public function page_1() {

        $this->registry->set('pjax_subnavbar_active', 'page_1');
        $this->template
            ->append_title('Pjax - Test Page 1')
            ->set_breadcrumb('Pjax', site_url('playground/pjax'))
            ->set_breadcrumb('Pjax - Test Page 1', site_url('playground/pjax/page-1'))
            ->build('pjax/page_1');
    }

    public function page_2() {

        $this->load->library('multiplayer');

        $this->registry->set('pjax_subnavbar_active', 'page_2');

        $video = 'https://www.youtube.com/watch?v=QTXyXuqfBLA';

        $this->template
            ->set('multiplayer', $this->multiplayer)
            ->set('video', $video)
            ->append_title('Pjax - Test Page 2')
            ->set_breadcrumb('Pjax', site_url('playground/pjax'))
            ->set_breadcrumb('Pjax - Test Page 2', site_url('playground/pjax/page-2'))
            ->build('pjax/page_2');
    }

}
