<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Avatar_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        // Example:
        // http://site.com/userphotos/avatar/c4ca4238a0b923820dcc509a6f75849b.png?s=48

        $size = (int) $this->input->get('s');

        if ($size <= 0) {
            $size = 80;
        }

        $default_image = $this->input->get('d');
        $force_default_image = $this->input->get('f') == 'y';

        if (!$force_default_image) {

            $file = $this->uri->rsegment(3);

            if ($file == '.' || strpos($file, '..') !== false) {
                $file = '';
            }

            $file_path = $this->base_path;
            $file_exists = $file != '' && is_file($file_path.$file);

            if (!$file_exists) {

                if ($default_image == '404') {

                    set_status_header(404);
                    exit;
                }

                $force_default_image = true;
            }
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
