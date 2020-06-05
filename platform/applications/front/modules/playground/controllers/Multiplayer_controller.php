<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Multiplayer_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Multiplayer Library Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/multiplayer'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->load->library('multiplayer');

        $videos = array(
            'https://www.youtube.com/watch?v=NRhVcTTMlrM',
            'http://vimeo.com/60743823',
            'http://www.dailymotion.com/video/x9kdze',
            'http://vbox7.com/play:25c4115f2d',
        );

        $this->template
            ->set('multiplayer', $this->multiplayer)
            ->set('videos', $videos)
            ->build('multiplayer');
    }

}
