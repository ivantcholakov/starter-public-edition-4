<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Put this widget within a view in the following way:
 * echo Modules::run('contact_info_widget/index');
 */

class Main_menu_widget_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('settings')
            ->helper('language')
            ->helper('url')
            ->helper('asset')
            ->library('menu')
            ->language('ui')
        ;
    }

    public function _remap() {

        show_404();
    }

    public function index() {

        $nav = array();
        $active = '';

        $nav['home'] = array('label' => $this->lang->line('ui_home'), 'icon' => 'fa fa-home', 'location' => site_url());
        $nav['readme'] = array('label' => 'README', 'icon' => 'fa fa-info-circle', 'location' => site_url('readme'));
        $nav['contact_page_test'] = array('label' => 'Contact Page Test', 'icon' => 'fa fa-envelope', 'location' => site_url('contact-page-test'));
        $nav['playground'] = array('label' => 'The Playground', 'icon' => 'fa fa-sun-o', 'location' => site_url('playground'));

        $segment_1 = $this->uri->rsegment(1);

        switch ($segment_1) {

            case '':
            case 'welcome':
                $active = 'home';
                break;

            case 'readme':
                $active = 'readme';
                break;

            case 'contact_page_test':
                $active = 'contact_page_test';
                break;

            case 'playground':
                $active = 'playground';
                break;
        }

        if ($this->uri->segment(1) == 'playground' || $this->uri->segment(2) == 'playground') {
            $active = 'playground';
        }

        $data = compact(
            'nav',
            'active'
        );

        $this->load->view('main_menu_widget', $data, false, 'i18n');
    }

}
