<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Letter_avatar_controller extends Base_Controller {

    protected $transliterate_to_ascii = false;

    public function __construct() {

        parent::__construct();

        $transliterate_to_ascii = config_item('letter_avatar_transliterate_to_ascii');

        if ($transliterate_to_ascii !== null) {
            $this->transliterate_to_ascii = !empty($transliterate_to_ascii);
        }
    }

    public function index() {

        $size = (int) $this->input->get('s');

        if ($size <= 0) {
            $size = 80;
        }

        $name = urldecode($this->input->get('n'));
        $name = preg_replace('/[^\p{L}\s]/u', '', UTF8::strtoupper(url_title($name, ' ', false, $this->transliterate_to_ascii)));
        $name = preg_split('/\s/m', $name, -1, PREG_SPLIT_NO_EMPTY);

        if (!empty($name)) {

            if (count($name) == 1) {
                $name = UTF8::str_split($name[0]);
            }

            $name = implode(' ', $name);

            try {

                // Modified by Ivan Tcholakov, 30-APR-2017.
                //$avatar = new \YoHang88\LetterAvatar\LetterAvatar($name, 'square', $size);
                $avatar = new LetterAvatar($name, 'square', $size);
                //
                $output = $avatar->generate()->response('png', 100);

                $this->output->set_header('Content-type: image/png');
                $this->output->set_output($output);

                return;

            } catch (Exception $ex) {
            }
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
