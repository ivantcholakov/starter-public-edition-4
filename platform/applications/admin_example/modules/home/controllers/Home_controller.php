<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Home_controller extends Base_Authenticated_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $confirmation_message = $this->session->flashdata('confirmation_message');

        $this->template
            ->set('confirmation_message', $confirmation_message)
            ->build('home');
    }

}
