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

        $videos = array(
            'https://www.youtube.com/watch?v=NRhVcTTMlrM',
            'http://vimeo.com/60743823',
            'http://www.dailymotion.com/video/x9kdze',
            'http://vbox7.com/play:25c4115f2d',
        );

        $multiplayer = null;
        $php_required = '5.4.0';
        $system_requirements_ok = is_php($php_required);

        if ($system_requirements_ok) {

            $this->load->library('multiplayer');
            $multiplayer = $this->multiplayer;
        }

        $this->template
            ->set('multiplayer', $multiplayer)
            ->set('videos', $videos)
            ->set('php_required', $php_required)
            ->set('system_requirements_ok', $system_requirements_ok)
            ->build('multiplayer');
    }

}
