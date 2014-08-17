<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        // Code for the real authentication system.
        //$this->load
        //    ->model('current_user')
        //;

        $this->load->library('template');

        $this->template->set_layout('admin_example');

        //$default_title = config_item('default_title');
        $default_title = 'Application Starter 4 Public Edition';
        //

        if ($default_title != '') {
             $this->template->title($default_title);
        }

        $this->template->set_metadata('robots', 'noindex,nofollow,noarchive');

        $this->template
            ->prepend_title('Site Administrator')
        ;
    }

    // Code for the real authentication system.
    //protected function _login($username, $password) {
    //
    //    // Break the previous login if there is any.
    //    $this->_logout();
    //
    //    return $this->current_user->login($username, $password);
    //}

    protected function _login($username, $password) {

        // Break the previous login if there is any.
        $this->_logout();

        $this->session->set_userdata('user_logged', true);

        // This is a method for demo purpose, it always returns TRUE.
        return true;
    }

    // Code for the real authentication system.
    //protected function _logout() {
    //
    //    // Don't do anything if a user has not been logged.
    //    if (!$this->current_user->is_logged_in()) {
    //        return;
    //    }
    //
    //    $this->current_user->logout();
    //}
    //
    //protected function _last_login_error() {
    //
    //    return $this->current_user->last_login_error();
    //}

    protected function _logout() {

        // Don't do anything if a user has not been logged.
        if (!$this->session->userdata('user_logged')) {
            return;
        }

        // If the public site and the administration site
        // share same session space, consider the following:
        //$this->session->unset_userdata('user_logged');
        //

        $this->session->sess_destroy();
    }

    protected function _check_access() {

        // Change this condition according to your system of authentication.
        if (!$this->session->userdata('user_logged')) {
        // Code for the real authentication system.
        //if (!$this->current_user->is_logged_in()) {

            if ($this->input->is_ajax_request()) {

                $this->session->set_flashdata('error_message', $this->lang->line('ui_session_expired'));

                set_status_header(403);

                exit;
            }

            if ($this->uri->total_segments() != 0) {

                // Session expiration message is not to be shown
                // when we are comming from the protected home page.
                $this->session->set_flashdata('error_message', $this->lang->line('ui_session_expired'));
            }

            redirect('login');
        }

        return true;
    }

}
