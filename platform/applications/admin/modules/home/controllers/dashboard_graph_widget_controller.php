<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_graph_widget_controller extends Base_Widget_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {

        $this->load->library('letter_avatar');
        $actors = array(
            array('name' => 'Charles Bronson'),
            array('name' => 'Humphrey Bogart'),
            array('name' => 'Marlon Brando'),
            array('name' => 'Paul Newman'),
            array('name' => 'Robert Mitchum'),
            array('name' => 'Roy Scheider'),
            array('name' => 'Steve McQueen'),
            array('name' => 'Toshiro Mifune'),
            array('name' => 'Yul Brynner'),
            array('name' => 'Николай Волев'),
            array('name' => 'Теди Москов'),
        );
        $this->template
            ->set('actors', $actors)
            ->set('letter_avatar', $this->letter_avatar)
            ->build('letter_avatar');
        
        $this->load->view('dashboard_graph_widget', $data);
    }
}
