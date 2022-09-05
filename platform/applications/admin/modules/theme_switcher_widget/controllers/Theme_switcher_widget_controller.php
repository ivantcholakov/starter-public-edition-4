<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_switcher_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('visual_themes');
    }

    public function index($display_type = null) {

        $display_type = (string) $display_type;

        if ($display_type == 'test') {
            $display_type = '';
        }

        if (!in_array($display_type, array('', 'navbar', 'navbar_mobile'))) {
            $display_type = '';
        }

        $theme_switcher = $this->visual_themes->get_all();

        if (empty($theme_switcher) || count($theme_switcher) == 1) {
            return;
        }

        foreach ($theme_switcher as $key => $value) {

            $theme_switcher[$key]['label'] = $value['name'];
            $theme_switcher[$key]['link'] = http_build_url(CURRENT_URL, array('query' => http_build_query(array('theme' => base64_encode($value['key'])))), HTTP_URL_JOIN_QUERY);

            if ($value['key'] == $this->visual_themes->get_current()) {
                $theme_switcher[$key]['active'] = true;
            }
        }

        $this->load->view('theme_switcher_widget'.($display_type == '' ? '' : '_'.$display_type), compact('theme_switcher'));
    }

}
