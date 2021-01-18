<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Email_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->language('mailer')
            ->library('kcaptcha', null, 'captcha')
            ->language('captcha')
            ->parser()
        ;

        $title = 'Email Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/email-test'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->load->parser();

        $validation_rules = array(
            array(
                'field' => 'email_test_form_captcha',
                'label' => 'Captcha',
                'rules' => 'nohtml|trim|callback__captcha'
            ),
        );

        $success = false;
        $custom_html = '';

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {

            $custom_text = $this->input->post('custom_text');
            $custom_html = trim($custom_text) != '' ? $this->parser->parse_string($custom_text, null, true, array('textile' => array('restricted_mode' => true))) : '';

            $success = (bool) Events::trigger('email_test', array('custom_text' => $custom_html));

            if ($success) {

                $this->template->set('confirmation_message', $this->lang->line('mailer_your_message_has_been_sent'));

            } else {

                if ($this->registry->get('email_debugger') != '') {
                    $this->template->set('error_message', $this->lang->line('mailer_error').'<br /><br />'.$this->registry->get('email_debugger'));
                } else {
                    $this->template->set('error_message', $this->lang->line('mailer_error'));
                }
            }

        } elseif (validation_errors()) {

            $this->template->set('error_message', '<ul class="list">'.validation_errors('<li>', '</li>').'</ul>');
            $this->template->set('validation_errors', validation_errors_array());
        }

        extract(Modules::run('email/test/get_message'));

        $has_logo = file_exists(DEFAULTFCPATH.'apple-touch-icon-precomposed.png');

        $body = $this->parser->parse_string(
            $body,
            array(
                'has_logo' => $has_logo,
                'logo_src' => default_base_url('apple-touch-icon-precomposed.png'),
                'custom_text' => $custom_html,
                'site_url' => default_base_url(),
                'site_name' => $this->settings->lang('site_name'),
            ),
            true,
            'handlebars'
        );

        $this->captcha->clear();

        $this->template
            ->set(compact('subject', 'body'))
            ->build('email_test');
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
