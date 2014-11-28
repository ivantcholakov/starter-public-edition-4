<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Send_confirmation_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('settings')
            ->helper('email')
            ->language('mailer');
        ;
    }

    public function _remap() {

        show_404();
    }

    public function index($data = array()) {

        if (!is_array($data)) {
            $data = array();
        }

        if (isset($data['contact_form_name']) && isset($data['contact_form_email'])) {

            $data['to'] = name_email_format($data['contact_form_name'], $data['contact_form_email']);
            $data['reply_to'] = name_email_format($this->settings->lang('site_name'), $this->settings->get('contact_email'));
            $data['subject'] = '['.$this->settings->lang('site_name').': '.$this->lang->line('mailer_confirmation_for_a_received_message').'] '.$data['contact_form_subject'];
        }

        return (bool) Events::trigger('email', $data);
    }

}
