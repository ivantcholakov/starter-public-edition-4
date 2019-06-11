<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Base_Controller extends Core_Controller {

    protected $base_path;

    protected $default_file;
    protected $default_base_path;

    protected $blank_file;
    protected $blank_base_path;

    public function __construct() {

        parent::__construct();

        $this->load->helper('url');
        $this->load->config('custom_user_photo');

        $this->base_path = (string) $this->config->item('custom_user_photo_base_path');

        if ($this->base_path == '') {
            $this->base_path = PLATFORM_UPLOAD_PATH.'userphotos/';
        }

        $this->default_file = 'default-person.png';
        $this->default_base_path = DEFAULTFCPATH.'assets/img/lib/';

        $this->blank_file = 'blank.png';
        $this->blank_base_path = DEFAULTFCPATH.'assets/img/lib/';
    }

}
