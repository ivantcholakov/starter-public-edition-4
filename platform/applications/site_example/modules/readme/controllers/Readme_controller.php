<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Readme_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->parser('markdown')
            ->parser('auto_link')
        ;

        $this->template->inject_partial('css', css('lib/google-code-prettify/prettify.css'));
        $this->template->set_partial('scripts', 'readme_scripts');

        $this->template
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
            ->build('readme');
    }

}
