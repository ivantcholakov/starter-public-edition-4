<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class Admin_mode_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper('html_filters');

        $this->template
            ->append_metadata($this->load->view('partials/ckeditor', null, true))
            ->set_partial('subnavbar', 'playground/online_editor/subnavbar')
            ->set('subnavbar_item_active', 'admin-mode')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        $validation_rules = array(
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'html_filter_admin'
            )
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {
            $content = $this->input->post('content');
        }

        $this->template
            ->set('content', $content)
        ;

        $this->template->build('online_editor/admin_mode');
    }

}
