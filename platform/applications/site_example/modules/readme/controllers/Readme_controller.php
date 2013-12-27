<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Readme_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->inject_partial('css', css('lib/google-code-prettify/prettify.css'))
            ->set_partial('scripts', 'readme_scripts')
            ->title('README')
        ;
    }

    public function index() {

        $path = '';

        if (file_exists(PLATFORMPATH.'../README.md')) {
            $path = realpath(PLATFORMPATH.'../README.md');
        }
        elseif (file_exists(DEFAULTFCPATH.'../README.md')) {
            $path = realpath(DEFAULTFCPATH.'../README.md');
        }
        elseif (file_exists(DEFAULTFCPATH.'README.md')) {
            $path = DEFAULTFCPATH.'README.md';
        }

        $this->template
            ->set('path', $path)
            //->enable_parser_body(array('markdown', 'auto_link' => array('attributes' => 'target="_blank"')))
            ->enable_parser_body(array('markdown', 'auto_link'))
            ->build('readme');
    }

}
