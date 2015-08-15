<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Pjax_controller extends Base_Controller {

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
            ->title('Pjax - Home Page')
            ->build('pjax/pjax');
    }

    public function page_1() {

        $this->registry->set('pjax_subnavbar_active', 'page_1');
        $this->template
            ->title('Pjax - Test Page 1')
            ->build('pjax/page_1');
    }

    public function page_2() {

        $this->registry->set('pjax_subnavbar_active', 'page_2');

        $video = 'https://www.youtube.com/watch?v=QTXyXuqfBLA';

        $php_required = '5.3.2';

        if (is_php($php_required)) {
            $this->load->library('multiplayer');
        }

        $this->template
            ->set('video', $video)
            ->set('php_required', $php_required)
            ->title('Pjax - Test Page 2')
            ->build('pjax/page_2');
    }

}
