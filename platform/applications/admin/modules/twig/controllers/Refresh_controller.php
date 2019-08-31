<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Refresh_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->load->config('twig');

        $allowed_ips = config_item('twig_http_refresh_allowed_ips');

        if (empty($allowed_ips)) {
            $allowed_ips = array();
        }

        $allowed = in_array($_SERVER['REMOTE_ADDR'], $allowed_ips);

        if (!$allowed) {

            set_status_header(403);
            $this->output->set_output('Forbidden.');

            return;
        }

        $this->load->helper('file');

        delete_files(TWIG_CACHE, true);
        file_exists(TWIG_CACHE) OR @mkdir(TWIG_CACHE, DIR_WRITE_MODE, TRUE);
        $this->output->set_output('Ok.');
    }

}
