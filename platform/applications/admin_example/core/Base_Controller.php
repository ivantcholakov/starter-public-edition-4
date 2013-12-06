<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends Core_Controller {

    protected $public_site_url = null;

    public function __construct() {

        parent::__construct();

        $this->load->library('settings');
        $this->load->helper('url');

        $this->_check_access();

        $this->load->library('template');

        //$default_title = config_item('default_title');
        $default_title = 'Application Starter 4 Public Edition';
        //

        if ($default_title != '') {
             $this->template->title($default_title);
        }

        $this->public_site_url = http_build_url(BASE_URL, '../');

        switch ($this->uri->segment(1, '')) {

            case 'login':

                // The design of the login page might differ radically,
                // so we are leaving a quick possibility different css and
                // maybe javascripts to be loaded.
                $this->template->inject_partial('css', css('welcome.css'));

                break;

            default:

                $this->template->inject_partial('css', css('welcome.css'));

                break;
        }

        $this->template
            ->prepend_title('Site Administrator')
            ->set('public_site_url', $this->public_site_url)
        ;
    }

    protected function _login($username, $password) {

        // Break the previous login if there is any.
        $this->_logout();

        $this->session->set_userdata('user_logged', true);

        // This is a method for demo purpose, it always returns TRUE.
        return true;
    }

    protected function _logout() {

        // Don't do anything if a user has not been logged.
        if (!$this->session->userdata('user_logged')) {
            return;
        }

        // If the public site and the administration site
        // share same session space, consider the following:
        //$this->session->unset_userdata('user_logged');
        //

        $this->session->sess_regenerate(true);
    }

    private function _check_access() {

        $ignored_pages = array('login', 'logout');
        $current_page = $this->uri->segment(1, '');

        if (in_array($current_page, $ignored_pages)) {
            return true;
        }

        // Change this condition according to your system of authentication.
        if (!$this->session->userdata('user_logged')) {

            if (IS_AJAX_REQUEST) {
                exit(EXIT_ERROR);
            }

            redirect('login');
        }

        return true;
    }

}
