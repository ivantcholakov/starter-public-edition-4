<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language_switcher_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->language = config_item('language');
    }

    public function index($display_type = null) {

        $display_type = (string) $display_type;

        if ($display_type == 'test') {
            $display_type = '';
        }

        if (!in_array($display_type, array('', 'navbar'))) {
            $display_type = '';
        }

        $language_switcher = array(
            array(
                'language' => 'english',
                'label' => 'English',
                'link' => $this->lang->switch_uri('english'),
                'flag' => 'GB',
            ),
            array(
                'language' => 'bulgarian',
                'label' => 'Bulgarian',
                'link' => $this->lang->switch_uri('bulgarian'),
                'flag' => 'BG',
            ),
        );

        foreach ($language_switcher as $key => $item) {

            if ($this->language == $item['language']) {
                $language_switcher[$key]['active'] = true;
            }
        }

        $this->load->view('language_switcher_widget'.($display_type == '' ? '' : '_'.$display_type), compact('language_switcher'), false, 'i18n');
    }

}
