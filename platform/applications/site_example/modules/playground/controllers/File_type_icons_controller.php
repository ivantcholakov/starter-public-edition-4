<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class File_type_icons_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->helper('file')
        ;

        $title = 'Testing File Type Icons';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/file-type-icons'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $file_extensions = array_keys(file_type_icon());
        $file_extensions = array_merge(array('unknown'), $file_extensions);

        $this->template
            ->set('file_extensions', $file_extensions)
            ->build('file_type_icons');
    }

}
