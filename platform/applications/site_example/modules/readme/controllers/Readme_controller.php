<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Readme_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'README';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('<i class="info circle icon"></i> '.$title, site_url('readme'));
        ;

        $this->registry->set('nav', 'readme');
    }

    public function index() {

        $path = '';
        $content = '# The file README.md has not been found.';

        if (file_exists(PLATFORMPATH.'../README.md')) {
            $path = realpath(PLATFORMPATH.'../README.md');
        }
        elseif (file_exists(DEFAULTFCPATH.'../README.md')) {
            $path = realpath(DEFAULTFCPATH.'../README.md');
        }
        elseif (file_exists(DEFAULTFCPATH.'README.md')) {
            $path = DEFAULTFCPATH.'README.md';
        }

        if ($path != '') {
            $content = $this->load->view($path, null, true, array('markdown' => array('full_path' => true)));
        }

        $this->template
            ->set(compact('path', 'content'))
            //->enable_parser_body(array('i18n' => false))    // Actually, this disables the 'i18n' parser.
            ->build('readme');
    }

}
