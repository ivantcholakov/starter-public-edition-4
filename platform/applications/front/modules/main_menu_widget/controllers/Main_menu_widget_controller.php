<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Main_menu_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('menu')
        ;
    }

    public function index() {

        $nav = array();
        $active = $this->registry->get('nav');

        // The main menu items.
        $nav['home'] = array('label' => $this->lang->line('ui_home'), 'icon' => 'home icon', 'location' => site_url());
        $nav['readme'] = array('label' => 'README', 'icon' => 'info circle icon', 'location' => 'readme');
        $nav['contact-page-test'] = array('label' => 'Contact Page Test', 'icon' => 'mail icon', 'location' => 'contact-page-test');
        $nav['playground'] = array('label' => 'The Playground', 'icon' => 'sun icon', 'location' => 'playground');

        /*
        // Sub-menu demostration.
        $nav['non_mvc_page'] = array('label' => 'Non-MVC Page Demonstration', 'location' => 'non-mvc/demo.php', 'parent_id' => 'playground');
        $nav['http_build_url'] = array('label' => 'Testing http_build_url()', 'location' => 'non-mvc/http_build_url_test.php', 'parent_id' => 'playground');
        $nav['playground/separator_1'] = array('blank' => true, 'parent_id' => 'playground');
        $nav['playground/captcha'] = array('label' => 'Captcha Test', 'location' => 'playground/captcha', 'parent_id' => 'playground');
        $nav['playground/mustache'] = array('label' => 'Mustache Parser Test', 'location' => 'playground/mustache', 'parent_id' => 'playground');
        $nav['playground/separator_2'] = array('blank' => true, 'parent_id' => 'playground');
        $nav['and_so_on'] = array('label' => 'And so on, see the Playground index page', 'location' => 'playground', 'parent_id' => 'playground');
        */

        $nav = $this->menu->render($nav, $active, NULL, 'data');
        $this->menu->reset();

        $module = get_instance()->module;
        $controller = get_instance()->controller;
        $method = get_instance()->method;

        $data = compact(
            'nav',
            'module',
            'controller',
            'method'
        );

        $this->load->view('main_menu_widget', $data);
    }

}
