<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Put this widget within a view in the following way:
 * echo Modules::run('contact_info_widget/index');
 */

class Contact_info_widget_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('settings')
            ->helper('language')
            ->helper('url')
            ->helper('asset')
            ->language('contact')
        ;
    }

    public function _remap($method, $params = array()) {

        show_404();
    }

    public function index($contacts = array()) {

        $contacts = $this->parse_contacts($contacts);

        if (empty($contacts)) {
            return;
        }

        $this->load->view('contact_info_widget', compact('contacts'), false, 'i18n');
    }

    public function parse_contacts($contacts) {

        if (!is_array($contacts)) {
            $contacts = array();
        }

        if (empty($contacts)) {

            $contacts[] = $this->settings->lang(array(
                'contact_organization',
                'contact_address',
                'contact_phone',
                'contact_fax',
                'contact_email',
                'contact_first_name',
                'contact_last_name',
                'contact_web_site',
                'contact_facebook',
                'contact_twitter',
                'contact_google_plus',
                'contact_linkedin',
                'contact_github',
            ));
        }

        return $this->_prettify_contacts($contacts);
    }

    protected function _prettify_contacts($contacts) {

        if (!is_array($contacts)) {
            $contacts = array();
        }

        $result = array();

        $i = 0;

        foreach ($contacts as $key => $contact) {

            $contact = array_filter($contact, 'strlen');

            if (empty($contact)) {
                continue;
            }

            $contact['contact_label'] =

                isset($contact['contact_label']) && $contact['contact_label'] != ''
                ? $contact['contact_label']
                :
                    (isset($contact['contact_organization']) && $contact['contact_organization'] != ''
                    ? $contact['contact_organization']
                    : $this->lang->line('contact').($i == 0 ? '' : ' '.($i + 1)));

            if (isset($contact['contact_first_name']) && isset($contact['contact_last_name'])) {
                $contact['contact_person'] = $contact['contact_first_name'].' '.$contact['contact_last_name'];
            }

            $result[] = $contact;

            $i++;
        }

        return $result;
    }

}
