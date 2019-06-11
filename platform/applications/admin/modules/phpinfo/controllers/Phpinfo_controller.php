<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Phpinfo_controller extends Base_Authenticated_Controller {

    public function __construct() {

        parent::__construct();

        if (!(function_exists('phpinfo') && $this->config->item('phpinfo_allow'))) {

            if ($this->input->is_ajax_request()) {

                set_status_header(500);

                exit;
            }

            $this->session->set_flashdata('error_message', 'The phpinfo() page has been disabled.');

            redirect(site_url());
        }

        $this->load->helper('html_filters');

        $this->_set_nav('settings/phpinfo');
    }

    public function index() {

        $this->_set_title('phpinfo()');

        $sections = $this->config->item('phpinfo_sections');

        if (empty($sections)) {
            $sections = INFO_ALL;
        }

        ob_start();
        phpinfo($sections);
        $phpinfo = ob_get_clean();
        $phpinfo = html_filter_user($phpinfo);
        $phpinfo = str_replace('phpinfo()', '', $phpinfo);

        $this->template
            ->set('phpinfo', $phpinfo)
            ->build('phpinfo');
    }

}
