<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_Events_Contact_Form_Widget {

    protected $ci;
    protected $settings;

    public function __construct() {

        $this->ci =& get_instance();

        $this->ci->load->library('settings');
        $this->settings = $this->ci->settings;

        if ($this->settings->get('mailer_enabled')) {

            Events::register('contact_form_submitted', array($this, 'contact_form_submitted_send_confirmation'));
        }
    }

    public function contact_form_submitted_send_confirmation($data = array()) {

        return Modules::run('contact_form_widget/send_confirmation/index', $data);
    }

}
