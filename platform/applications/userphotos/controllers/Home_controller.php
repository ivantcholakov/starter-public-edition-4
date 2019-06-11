<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Home_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        // Just show the default image.

        $size = (int) $this->input->get('s');

        if ($size <= 0) {
            $size = 80;
        }

        $default_image = $this->input->get('d');
        $force_default_image = $this->input->get('f') == 'y';

        if (!$force_default_image) {

            if ($default_image == '404') {

                set_status_header(404);
                exit;
            }

            $force_default_image = true;
        }

        if ($force_default_image) {

            $file = $this->default_file;
            $file_path = $this->default_base_path;

            if ($default_image == 'blank') {

                $file = $this->blank_file;
                $file_path = $this->blank_base_path;
            }
        }

        $config['source_image'] = $file_path.$file;
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = false;
        $config['height'] = $size;
        $config['width'] = $size;
        $config['dynamic_output'] = true;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->fit();
    }

}
