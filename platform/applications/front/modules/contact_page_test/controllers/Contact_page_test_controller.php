<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_page_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Contact Page Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('<i class="mail icon"></i> '.$title, site_url('contact-page-test'));
        ;

        $this->config->load('contact_page', FALSE, TRUE);

        $this->registry->set('nav', 'contact-page-test');
    }

    public function index() {

        $this->template->build('contact_page_test');
    }

}
