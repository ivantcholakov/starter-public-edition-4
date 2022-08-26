<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class User_photo_manager extends CI_Model {

    protected $upload_path;
    protected $allowed_types = 'png|jpg|jpeg|gif';
    protected $max_size = 512;      // KB
    protected $max_width = 500;     // px
    protected $max_height = 500;    // px

    protected $data = array();
    protected $errors = array();

    protected $upload;

    protected $ci;

    public function __construct() {

        parent::__construct();

        $this->ci = get_instance();

        $this->load->model('users');

        $this->load->config('custom_user_photo');

        $this->upload_path = (string) $this->config->item('custom_user_photo_base_path');

        if ($this->upload_path == '') {
            $this->upload_path = PLATFORM_UPLOAD_PATH.'userphotos/';
        }

        $allowed_types = (string) $this->config->item('custom_user_photo_upload_types');

        if ($allowed_types != '') {
            $this->allowed_types = $allowed_types;
        }

        $max_file_size = (int) $this->config->item('custom_user_photo_upload_max_file_size');

        if ($max_file_size > 0) {
            $this->max_size = $max_file_size;
        }

        $max_px_size = (int) $this->config->item('custom_user_photo_upload_max_px_size');

        if ($max_px_size > 0) {

            $this->max_width = $max_px_size;
            $this->max_height = $max_px_size;
        }
    }

    public function upload($user_id, $field = 'userfile') {

        $user_id = (int) $user_id;

        $this->load->helper('file');

        $this->data = array();
        $this->errors = array();

        $this->load->library('upload');
        $this->upload = $this->ci->upload;
        $this->lang->load('upload');

        $file_selected = isset($_FILES[$field]) && isset($_FILES[$field]['name']) && $_FILES[$field]['name'] != '';

        if ($file_selected == '') {

            return $this;
        }

        // Ivan: The uploaded file may not be valid, but I have to delete the previous file at this point.
        $this->_delete($user_id);

        $file_name = clean_file_name($_FILES[$field]['name']);
        $file_name = md5($user_id).'.'.strtolower(extension($file_name));

        $config['file_name'] = $file_name;
        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = $this->allowed_types;
        $config['max_size']  = $this->max_size;
        $config['max_width']  = $this->max_width;
        $config['max_height']  = $this->max_height;
        $config['overwrite'] = true;

        $this->upload->initialize()->initialize($config, false);

        if (!$this->upload->do_upload($field)) {

            $this->errors = $this->upload->error_msg;
            return $this;
        }

        $this->data = $this->upload->data();

        if (!$this->data['is_image']) {

            $this->errors[] = $this->lang->line('ui_invalid_image_format');
            return $this;
        }

        $this->users->update($user_id, array('photo' => $this->data['file_name']));

        return $this;
    }

    public function delete($user_id) {

        $user_id = (int) $user_id;

        $this->data = array();
        $this->errors = array();

        $this->data['file_name'] = $this->current($user_id);

        $this->_delete($user_id);

        return $this;
    }

    protected function _delete($user_id) {

        $user_id = (int) $user_id;

        $file_name = $this->current($user_id);

        if ($file_name == '') {
            return;
        }

        @unlink($this->upload_path.$file_name);
        $this->users->update($user_id, array('photo' => null));
    }

    public function current($user_id) {

        return $this->users->select('photo')->as_value()->get((int) $user_id);
    }

    public function data() {

        return $this->data;
    }

    public function errors() {

        return $this->errors;
    }

    public function display_errors() {

        if (empty($this->errors)) {
            return '';
        }

        if (count($this->errors) > 1) {
            return '<ul class="list"><li>'.implode('</li><li>', $this->errors).'</li></ul>';
        }

        return '<p>'.$this->errors[0].'</p>';
    }

    public function allowed_types() {

        return $this->allowed_types;
    }

    public function max_size() {

        return $this->max_size;
    }

    public function max_width() {

        return $this->max_width;
    }

    public function max_height() {

        return $this->max_height;
    }

    public function display_allowed_types() {

        return str_replace('|', ', ', $this->allowed_types);
    }

    public function display_allowed_sizes() {

        $result = array();

        if (!empty($this->max_size)) {

            $this->load->helper('number');

            $label = $this->lang->line('ui_max_file_size');
            $result[] = $label.': '.byte_format(1024 * $this->max_size, 0);
        }

        if (!empty($this->max_width)) {

            $label = $this->lang->line('ui_max_width');

            if ($this->lang->current() == 'bulgarian' && count($result) > 0) {
                $label = UTF8::strtolower((string) $label);
            }

            $result[] = $label.': '.$this->max_width.' px';
        }

        if (!empty($this->max_height)) {

            $label = $this->lang->line('ui_max_height');

            if ($this->lang->current() == 'bulgarian' && count($result) > 0) {
                $label = UTF8::strtolower((string) $label);
            }

            $result[] = $label.': '.$this->max_height.' px';
        }

        $result = implode('; ', $result);

        return $result;
    }

}
