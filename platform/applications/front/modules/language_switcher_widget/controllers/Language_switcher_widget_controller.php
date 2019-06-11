<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language_switcher_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index($display_type = null) {

        if (!$this->lang->multilingual_site()) {
            return; // Don't show the language switcher in this case.
        }

        $display_type = (string) $display_type;

        if ($display_type == 'test') {
            $display_type = '';
        }

        if (!in_array($display_type, array('', 'navbar'))) {
            $display_type = '';
        }

        $languages = array();
        $enabled_languages = $this->lang->enabled();

        if (!empty($enabled_languages) && is_array($enabled_languages)) {

            foreach ($enabled_languages as $language) {

                $value = $this->lang->get($language);

                if (!empty($value) && is_array($value)) {
                    $languages[$language] = $value;
                }
            }
        }

        if (empty($languages)) {
            return; // Don't show the language switcher, something is wrong with configuration data.
        }

        $language_switcher = array();

        foreach ($languages as $key => $value) {

            $item = array(
                'language' => $key,
                'label' => isset($value['name']) ? $value['name'] : $key,
                'link' => BASE_URL.$this->lang->switch_uri($key),
                'flag' => isset($value['flag']) ? $value['flag'] : null,
            );

            if ($this->lang->current() == $key) {
                $item['active'] = true;
            }

            $language_switcher[] = $item;
        }

        $this->load->view('language_switcher_widget'.($display_type == '' ? '' : '_'.$display_type), compact('language_switcher'));
    }

}
