<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class Admin_mode_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper('html_filters');

        $title = 'Online Editor - Admin Mode';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('Online Editor Test', site_url('playground/online-editor/user-mode'))
            ->set_breadcrumb($title, site_url('playground/online-editor/admin-mode'))
        ;

        $this->template
            ->set_partial('ckeditor', 'partials/ckeditor')
            ->set_partial('subnavbar', 'playground/online_editor/subnavbar')
            ->set('subnavbar_item_active', 'admin-mode')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $content .= '<br />';
        $content .= '<br />';
        $content .= '<strong>Twig parsed content:</strong>';
        $content .= '<br />';
        $content .= '{{ widget(\'contact_info_widget\') }}';
        $content .= '<br />';

        $validation_rules = array(
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'html_filter_admin'
            )
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {
            // Save the form.
        }

        $this->template
            ->set('content', $content)
            ->set('editor_mode', 'admin')
        ;

        $this->template->build('online_editor/online_editor');
    }

}
