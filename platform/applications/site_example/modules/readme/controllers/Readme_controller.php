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

        $content = '<h1>The file README.md has not been found.</h1>';

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

        if ($path != '') {
            $content = $this->auto_link->parse_string($this->markdown->parse($path, null, true, array('full_path' => true)), null, true);
        }

        $this->template
            ->set('content', $content)
            ->build('readme');
    }

}
