<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Submit_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('settings')
            ->helper('language')
            ->helper('url')
            ->helper('asset')
            ->helper('html')
            ->helper('array')
            ->parser()
            ->language('mailer')
            ->language('contact')
            ->library('kcaptcha', null, 'captcha')
            ->library('form_validation')
            ->helper('email')
        ;

        $this->lang->load('captcha', '', FALSE, TRUE, '', 'captcha');
        $this->config->load('contact_page', FALSE, TRUE);
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $success = false;
        $messages = array();

        $settings = $this->settings->get(array(
            'contact_form_has_phone',
            'contact_form_phone_required',
            'contact_form_has_organization',
            'contact_form_organization_required',
        ));

        extract($settings);

        if (!$contact_form_has_phone) {
            $contact_form_phone_required = false;
        }

        if (!$contact_form_has_organization) {
            $contact_form_organization_required = false;
        }

        $data = $this->input->post();

        if (!empty($data)) {

            if ($this->settings->get('mailer_enabled')) {

                $validation_rules = array(

                    array(
                        'field' => 'contact_form_first_name',
                        'label' => 'lang:contact_first_name',
                        'rules' => 'nohtml|trim|required'
                    ),

                    array(
                        'field' => 'contact_form_last_name',
                        'label' => 'lang:contact_last_name',
                        'rules' => 'nohtml|trim|required'
                    ),

                    array(
                        'field' => 'contact_form_email',
                        'label' => 'lang:contact_email',
                        'rules' => 'nohtml|trim|required|valid_email'
                    ),

                    array(
                        'field' => 'contact_form_phone',
                        'label' => 'lang:contact_phone',
                        'rules' => 'nohtml|trim'.($contact_form_phone_required ? '|required' : '')
                    ),

                    array(
                        'field' => 'contact_form_organization',
                        'label' => 'lang:contact_organization',
                        'rules' => 'nohtml|trim'.($contact_form_organization_required ? '|required' : '')
                    ),

                    array(
                        'field' => 'contact_form_subject',
                        'label' => 'lang:contact_subject',
                        'rules' => 'nohtml|trim|required'
                    ),

                    array(
                        'field' => 'contact_form_message',
                        'label' => 'lang:contact_message',
                        'rules' => 'nohtml|trim|required|min_length[15]'
                    ),

                    array(
                        'field' => 'contact_form_captcha',
                        'label' => 'Captcha',
                        'rules' => 'nohtml|trim|callback__captcha'
                    ),

                );

                $this->form_validation->set_rules($validation_rules);

                if ($this->form_validation->run()) {

                    $data = $this->_prepare_data($data);
                    $data = $this->_load_email_template($data);
                    $data = $this->_create_email($data);

                    $success = (bool) Events::trigger('email', $data);

                    if ($success) {

                        $messages[] = $this->lang->line('mailer_your_message_has_been_sent');

                        Events::trigger('contact_form_submitted', $data);

                    } else {

                        $messages[] = $this->lang->line('mailer_error');
                    }

                } elseif (validation_errors_array()) {

                    $messages = $this->form_validation->error_array();

                } else {

                    $messages[] = 'Validation error.';
                }

            } else {

                $messages[] = $this->lang->line('mailer_disabled_error');
            }
        }

        $messages_html = $this->_prepare_messages_html($success, $messages);

        $this->captcha->clear();

        $this->output->set_output(json_encode(compact('success', 'messages', 'messages_html')));
    }

    protected function _prepare_data($data) {

        $data = array_only(array_filter($data, 'strlen'),
            array(
                'contact_form_first_name',
                'contact_form_last_name',
                'contact_form_email',
                'contact_form_phone',
                'contact_form_organization',
                'contact_form_subject',
                'contact_form_message',
            )
        );

        $data['site_name'] = $this->settings->lang('site_name');
        $data['site_url'] = $this->settings->get('contact_web_site');
        $data['contact_form_name'] = "{$data['contact_form_first_name']} {$data['contact_form_last_name']}";
        $data['contact_form_message'] = $this->parser->parse_string($data['contact_form_message'], null, true, array('textile' => array('restricted_mode' => true)));

        return $data;
    }

    protected function _load_email_template($data) {

        // Here is the dеfault email template. You may get it from database too.
        $this->load->parser();
        $data['email_template'] = $this->parser->parse_string($this->load->source('contact_form_email.handlebars'), null, true, 'i18n');

        return $data;
    }

    protected function _create_email($data) {

        $data['to'] = name_email_format($this->settings->lang('site_name'), $this->settings->get('contact_email'));
        $data['reply_to'] = name_email_format($data['contact_form_name'], $data['contact_form_email']);
        $data['subject'] = '['.$this->settings->lang('site_name').': '.$this->lang->line('mailer_a_message_has_been_received_from').' '.$data['contact_form_name'].'] '.$data['contact_form_subject'];
        $data['body'] = $this->parser->parse_string($data['email_template'], $data, true, 'handlebars');

        $this->load->library('email');
        $data['body'] = $this->email->full_html($data['subject'], $data['body']);

        return $data;
    }

    protected function _prepare_messages_html($success, $messages) {

        if (count($messages) > 1) {

            $single_message = false;
            $message = '';

        } elseif (count($messages) < 1) {

            $single_message = true;
            $message = '';

        } else {

            $single_message = true;
            $message = reset($messages);
        }

        return $this->load->view('messages_html', compact('success', 'messages', 'single_message', 'message'), true);
    }

    public function _captcha($string) {

        $captcha_valid = $this->captcha->valid($string);
        $this->captcha->clear();

        if (!$captcha_valid) {
            $this->form_validation->set_message('_captcha', $this->lang->line('captcha.validation_error'));
        }

        return $captcha_valid;
    }

}
