<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Side_menu_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->model('nav')
            ->library('menu')
        ;
    }

    public function index() {

        $data = array();

        $data['nav'] = $this->menu->render($this->nav->data(), $this->registry->get('nav'), NULL, 'data');
        $this->menu->reset();

        $this->load->view('side_menu_widget', $data);
    }

}
