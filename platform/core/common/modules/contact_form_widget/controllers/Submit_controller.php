<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
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
            ->parser('i18n')
            ->parser('textile')
            ->parser('mustache')
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
                        'label' => $this->lang->line('contact_first_name'),
                        'rules' => 'nohtml|trim|required'
                    ),

                    array(
                        'field' => 'contact_form_last_name',
                        'label' => $this->lang->line('contact_last_name'),
                        'rules' => 'nohtml|trim|required'
                    ),

                    array(
                        'field' => 'contact_form_email',
                        'label' => $this->lang->line('contact_email'),
                        'rules' => 'nohtml|trim|required|valid_email'
                    ),

                    array(
                        'field' => 'contact_form_phone',
                        'label' => $this->lang->line('contact_phone'),
                        'rules' => 'nohtml|trim'.($contact_form_phone_required ? '|required' : '')
                    ),

                    array(
                        'field' => 'contact_form_organization',
                        'label' => $this->lang->line('contact_organization'),
                        'rules' => 'nohtml|trim'.($contact_form_organization_required ? '|required' : '')
                    ),

                    array(
                        'field' => 'contact_form_subject',
                        'label' => $this->lang->line('contact_subject'),
                        'rules' => 'nohtml|trim|required'
                    ),

                    array(
                        'field' => 'contact_form_message',
                        'label' => $this->lang->line('contact_message'),
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

                    $this->captcha->clear();

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

                    $messages = validation_errors_array();

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

        $data['site_name'] = $this->settings->get('site_name');
        $data['site_url'] = $this->settings->get('contact_web_site');
        $data['contact_form_name'] = "{$data['contact_form_first_name']} {$data['contact_form_last_name']}";
        $data['contact_form_message'] = $this->textile->parse_string($data['contact_form_message'], null, true);

        return $data;
    }

    protected function _load_email_template($data) {

        // Here is the dafault email template. You may get it from database too.
        $template = $this->load->view('contact_form_email.mustache', null, true);

        $template = $this->i18n->parse_string($template, null, true);

        $data['email_template'] = $template;

        return $data;
    }

    protected function _create_email($data) {

        $data['to'] = name_email_format($this->settings->get('site_name'), $this->settings->get('contact_email'));
        $data['reply_to'] = name_email_format($data['contact_form_name'], $data['contact_form_email']);
        $data['subject'] = '['.$this->settings->get('site_name').': '.$this->lang->line('mailer_a_message_has_been_received_from').' '.$data['contact_form_name'].'] '.$data['contact_form_subject'];
        $data['body'] = $this->mustache->parse_string($data['email_template'], $data, true);

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

        if (!$this->captcha->valid($string)) {

            $this->form_validation->set_message('_captcha', $this->lang->line('captcha.validation_error'));

            return false;
        }

        return true;
    }

}
