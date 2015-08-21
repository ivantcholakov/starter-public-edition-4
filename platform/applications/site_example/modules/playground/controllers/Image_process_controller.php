<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Image_process_controller extends Base_Controller {

    protected $image_base_url;
    protected $image_base_path;

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('image_lib')
            ->helper('url')
        ;

        $this->image_base_url = default_base_url();
        $this->image_base_path = DEFAULTFCPATH;
    }

    public function index() {

        $src_path = $this->image_base_path.str_ireplace($this->image_base_url, '', $this->input->get('src'));

        if (!is_file($src_path)) {
            exit;
        }

        $resize_operation = null;

        $w = $this->input->get('w');
        $h = $this->input->get('h');

        $no_crop = $this->input->get('no_crop');
        $no_crop = !empty($no_crop);

        if ($w > 0) {

            $resize_operation = 'fit_width';
            $w = (int) $w;

        } else {

            $w = '';
        }

        if ($h > 0) {

            $resize_operation = $resize_operation == 'fit_width' ? ($no_crop ? 'fit_inner' : 'fit') : 'fit_height';
            $h = (int) $h;

        } else {

            $h = '';
        }

        if ($resize_operation == '') {

            if ($prop = $this->image_lib->get_image_properties($src_path, true)) {

                $w = (int) $prop['width'];
                $h = (int) $prop['height'];

            } else {

                exit;
            }
        }

        $config = array();
        $config['source_image'] = $src_path;
        $config['dynamic_output'] = true;
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = false;
        $config['width'] = $w;
        $config['height'] = $h;

        if (!$this->image_lib->initialize($config)) {
            exit;
        }

        if ($resize_operation == 'fit_inner') {
            $this->image_lib->resize();
        } else {
            $this->image_lib->fit();
        }
    }

}
