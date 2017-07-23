<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Letter_avatar_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Letter Avatar Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/letter-avatar'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->load->library('letter_avatar');

        $actors = array(
            array('name' => 'Charles Bronson'),
            array('name' => 'Humphrey Bogart'),
            array('name' => 'Marlon Brando'),
            array('name' => 'Paul Newman'),
            array('name' => 'Robert Mitchum'),
            array('name' => 'Roy Scheider'),
            array('name' => 'Steve McQueen'),
            array('name' => 'Toshiro Mifune'),
            array('name' => 'Yul Brynner'),
            array('name' => 'Николай Волев'),
            array('name' => 'Теди Москов'),
        );

        $this->template
            ->set('actors', $actors)
            ->set('letter_avatar', $this->letter_avatar)
            ->build('letter_avatar');
    }

}
