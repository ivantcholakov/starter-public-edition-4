<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->model('visual_themes')
            ->library('template')
        ;

        $theme = (string) $this->input->get('theme');

        if ($theme != '') {
            $theme = (string) base64_decode($theme);
        }

        // Determine the current visual theme.
        if ($theme != '' && $this->input->method() == 'get' && !$this->input->is_ajax_request()) {

            $this->visual_themes->set_current($theme);

            parse_str(parse_url(CURRENT_URL, PHP_URL_QUERY), $query);
            unset($query['theme']);
            redirect(http_build_url(current_url(), array('query' => http_build_query($query))));
        }

        $this->template->set_theme($this->visual_themes->get_current());

        $default_title = config_item('default_title');
        $default_description = config_item('default_description');
        $default_keywords = config_item('default_keywords');

        if ($default_title != '') {
             $this->template->title($default_title);
        }

        if ($default_description != '') {
            $this->template->set_metadata('description', $default_description);
        }

        if ($default_keywords != '') {
            $this->template->set_metadata('keywords', $default_keywords);
        }

        $this->template->set_breadcrumb('<i class="home icon"></i> '.$this->lang->line('ui_home'), site_url());
    }

}
