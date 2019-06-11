<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('settings');
    }


    /**
     * Settings Editor
     */
    function index()
    {
        // get settings
        $settings = $this->settings_model->get_settings();

        // form validations
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        foreach ($settings as $setting)
        {
            if ($setting['validation'])
            {
                if ($setting['translate'])
                {
                    // setup a validation for each translation
                    foreach ($this->session->languages as $language_key=>$language_name)
                    {
                        $this->form_validation->set_rules($setting['name'] . "[" . $language_key . "]", $setting['label'] . " [" . $language_name . "]", $setting['validation']);
                    }
                }
                else
                {
                    // single validation
                    $this->form_validation->set_rules($setting['name'], $setting['label'], $setting['validation']);
                }
            }
        }

        if ($this->form_validation->run() == TRUE)
        {
            $user = $this->session->userdata('logged_in');

            // save the settings
            $saved = $this->settings_model->save_settings($this->input->post(), $user['id']);

            if ($saved)
            {
                $this->session->set_flashdata('message', lang('admin settings msg save_success'));

                // reload the new settings
                $settings = $this->settings_model->get_settings();
                foreach ($settings as $setting)
                {
                    $this->settings->{$setting['name']} = @unserialize($setting['value']);
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin settings error save_failed'));
            }

            // reload the page
            redirect('admin/settings');
        }

        // setup page header data
		$this
			->add_css_theme('summernote.css')
			->add_js_theme('summernote.min.js')
			->add_js_theme('settings_i18n.js', TRUE)
			->set_title(lang('admin settings title'));

        $data = $this->includes;

        // set content data
        $content_data = array(
            'settings'   => $settings,
            'cancel_url' => "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/settings/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

}