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
        $active = $this->registry->get('nav');

        // The main menu items.
        $nav['home'] = array('label' => $this->lang->line('ui_home'), 'icon' => 'fa fa-home', 'location' => site_url());
        $nav['readme'] = array('label' => 'README', 'icon' => 'fa fa-info-circle', 'location' => 'readme');
        $nav['contact-page-test'] = array('label' => 'Contact Page Test', 'icon' => 'fa fa-envelope', 'location' => 'contact-page-test');
        $nav['playground'] = array('label' => 'The Playground', 'icon' => 'fa fa-sun-o', 'location' => 'playground');

        // Sub-menu demostration.
        $nav['non_mvc_page'] = array('label' => 'Non-MVC Page Demonstration', 'location' => 'non-mvc/demo.php', 'parent_id' => 'playground');
        $nav['http_build_url'] = array('label' => 'Testing http_build_url()', 'location' => 'non-mvc/http_build_url_test.php', 'parent_id' => 'playground');
        $nav['idna_test'] = array('label' => 'IDNA Converter Test', 'location' => 'non-mvc/idna.php', 'parent_id' => 'playground');
        $nav['playground/separator_1'] = array('blank' => true, 'parent_id' => 'playground');
        $nav['playground/captcha'] = array('label' => 'Captcha Test', 'location' => 'playground/captcha', 'parent_id' => 'playground');
        $nav['playground/mustache'] = array('label' => 'Mustache Parser Test', 'location' => 'playground/mustache', 'parent_id' => 'playground');
        $nav['playground/separator_2'] = array('blank' => true, 'parent_id' => 'playground');
        $nav['and_so_on'] = array('label' => 'And so on, see the Playground index page', 'location' => 'playground', 'parent_id' => 'playground');

        $nav = $this->menu->render($nav, $active, NULL, 'data');
        $this->menu->reset();

        $data = compact(
            'nav'
        );

        $this->load->view('main_menu_widget', $data, false, 'i18n');
    }

}
