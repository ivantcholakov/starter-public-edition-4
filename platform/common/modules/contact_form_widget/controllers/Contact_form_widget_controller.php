<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Put this widget within a view in the following way:
 * echo Modules::run('contact_form_widget/index');
 */

class Contact_form_widget_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('settings')
            ->helper('language')
            ->helper('url')
            ->helper('asset')
            ->language('ui')
            ->language('contact')
            ->language('mailer')
            ->library('kcaptcha', null, 'captcha')
            ->language('captcha')
        ;

        $this->config->load('contact_page', FALSE, TRUE);
    }

    public function _remap($method, $params = array()) {

        show_404();
    }

    public function index() {

        $data = $this->settings->get(array(
            'contact_form_has_phone',
            'contact_form_phone_required',
            'contact_form_has_organization',
            'contact_form_organization_required',
        ));

        $data['mailer_error_html'] = $this->load->view('messages_html', array('success' => false, 'message' => $this->lang->line('mailer_error').' (AJAX)'), true);

        $this->load->view('contact_form_widget', $data);
    }

}
