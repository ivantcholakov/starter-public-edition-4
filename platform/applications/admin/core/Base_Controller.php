<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        // Code for the real authentication system.
        //$this->load
        //    ->model('current_user')
        //;

        $this->load->model('visual_themes');
        $this->load->library('template');

        // Determine the current visual theme.
        if ($this->input->get('theme') != '' && $this->input->method() == 'get' && !$this->input->is_ajax_request()) {

            $theme = (string) $this->input->get('theme');
            $this->visual_themes->set_current($theme);

            parse_str(parse_url(CURRENT_URL, PHP_URL_QUERY), $query);
            unset($query['theme']);
            redirect(http_build_url(current_url(), array('query' => http_build_query($query))));
        }

        $this->template->set_theme($this->visual_themes->get_current());

        //$default_title = config_item('default_title');
        //$default_title = $this->settings->lang('site_name');
        $default_title = 'Application Starter 4 Public Edition';
        //

        if ($default_title != '') {
             $this->template->title($default_title);
        }

        $this->template
            ->set_layout('default')
            ->set_metadata('robots', 'noindex,nofollow,noarchive')
            ->set_breadcrumb('<i class="dashboard icon"></i>'.$this->lang->line('ui_home'), site_url())
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

                $this->session->set_flashdata('warning_message', $this->lang->line('ui_session_expired'));

                set_status_header(403);

                exit;
            }

            if ($this->uri->total_segments() != 0) {

                // Session expiration message is not to be shown
                // when we are comming from the protected home page.
                $this->session->set_flashdata('warning_message', $this->lang->line('ui_session_expired'));
            }

            if ($this->input->method() != 'get') {
                redirect('login');
            }

            redirect(http_build_url(site_url('login'), array('query' => http_build_query(array('continue' => CURRENT_URL)))));
        }

        return true;
    }

    protected function _set_title($title, $title_short = null) {

        if ($title_short == '') {
            $title_short = $title;
        }

        $this->registry->set('title', $title);

        $this->template
            ->prepend_title($title_short)
            ->set_breadcrumb($title_short)
        ;
    }

    protected function _set_header_icon($icon) {

        if (trim((string) $icon) != '') {
            //$this->registry->set('header_icon', '<i class="circular '.$icon.' icon"></i>');
            $this->registry->set('header_icon', '<i class="'.$icon.' icon"></i>');
        } else {
            $this->registry->delete('header_icon');
        }
    }

    protected function _set_header_image($url, $attributes = null) {

        if (trim((string) $url) != '') {
            $this->registry->set('header_image', '<img src="'.html_attr_escape($url).'" '.html_attr($attributes).' />');
        } else {
            $this->registry->delete('header_image');
        }
    }

    protected function _set_subtitle($subtitle) {

        $this->registry->set('subtitle', $subtitle);
    }

    protected function _set_nav($id) {

        $this->registry->set('nav', $id);
    }

}
