<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Email_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->language('mailer')
            ->library('kcaptcha', null, 'captcha')
            ->parser()
        ;

        $this->lang->load('captcha', '', FALSE, TRUE, '', 'captcha');

        $this->template
            ->title('Email Test')
        ;
    }

    public function index() {

        $validation_rules = array(
            array(
                'field' => 'contact_form_captcha',
                'label' => 'Captcha',
                'rules' => 'nohtml|trim|callback__captcha'
            ),
        );

        $success = false;
        $messages = array();

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {

            $this->captcha->clear();

            $success = (bool) Events::trigger('email_test', $this->settings->get('notification_email'));

            if ($success) {
                $messages[] = $this->lang->line('mailer_your_message_has_been_sent');
            } else {
                $messages[] = $this->lang->line('mailer_error');
            }

        } else {

            $messages = validation_errors_array();
        }

        $this->captcha->clear();

        extract(Modules::run('email/test/get_message'));

        $has_logo = file_exists(DEFAULTFCPATH.'apple-touch-icon-precomposed.png');

        $body = $this->parser->parse_string(
            $body,
            array(/* 'has_logo' => $has_logo, */ 'has_logo' => false, 'logo_src' => common_base_url('apple-touch-icon-precomposed.png')),
            true,
            'mustache'
        );
        
        // Added by Ivan Tcholakov, 15-JAN-2014.
        // TODO: This is a workaround, fix it.
        $this->load->set_module('playground');
        //

        $this->template
            ->set(compact('success', 'messages', 'subject', 'body'))
            ->enable_parser_body('i18n')
            ->build('email_test');
    }

    public function _captcha($string) {

        if (!$this->captcha->valid($string)) {

            $this->form_validation->set_message('_captcha', $this->lang->line('captcha.validation_error'));

            return false;
        }

        return true;
    }

}
