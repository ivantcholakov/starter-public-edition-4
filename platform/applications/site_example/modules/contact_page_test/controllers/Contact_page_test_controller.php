<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_page_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->config->load('contact_page', FALSE, TRUE);

        $this->registry->set('nav', 'contact-page-test');
    }

    public function index() {

        $this->template->build('contact_page_test');
    }

}
