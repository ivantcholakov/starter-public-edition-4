<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Smileys_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Smiley Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/smileys'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->load->helper('smiley');  // This is needed only for calling _get_smiley_array().
        $smileys = _get_smiley_array();

        $this->template
            ->set('smileys', $smileys)
            ->enable_parser_body('smileys')
            ->build('smileys');
    }

}
