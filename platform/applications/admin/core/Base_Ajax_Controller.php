<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Ajax_Controller extends Core_Controller {

    public function __construct() {

        if (!$this->input->is_ajax_request()) {
            exit(EXIT_ERROR);
        }

        parent::__construct();

        $this->load
            ->helper('asset')
        ;

        // Code for the real authentication system.
        //$this->load
        //    ->model('current_user')
        //;
    }

    protected function _check_access() {

        if (!$this->session->userdata('user_logged')) {
        // Code for the real authentication system.
        //if (!$this->current_user->is_logged_in()) {

            $this->session->set_flashdata('error_message', $this->lang->line('ui_session_expired'));

            set_status_header(403);

            exit;
        }

        return true;
    }

}
