<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_messages_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper('html');
    }

    // The array $data may contain the following parameters:
    // 'element_id' the HTML id of the surrounding the messages div-element;
    // 'full_width' - TRUE (default) - width 100%, FALSE - width that fits to the content, centered box.
    // 'with_javascript' - TRUE (default)/FALSE, whether to include a typical JavaScript for message manipulations.

    public function index($data = array()) {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (empty($data)) {
            $data = array();
        }

        if (!is_array($data)) {

            $data = (string) $data;

            if ($data != '') {
                $data = array('feedback_message_id' => $data);
            } else {
                $data = array();
            }
        }

        if (array_key_exists('element_id', $data) && !array_key_exists('feedback_message_id', $data))  {

            // BC
            $data['feedback_message_id'] = $data['element_id'];
        }

        $data['feedback_message_id'] = isset($data['feedback_message_id']) && $data['feedback_message_id'] != '' ? nohtml($data['feedback_message_id']) : 'main_feedback_message';
        $data['feedback_message_full_width'] = array_key_exists('full_width', $data) ? !empty($data['full_width']) : true;
        $data['feedback_message_with_javascript'] = array_key_exists('with_javascript', $data) ? !empty($data['with_javascript']) : true;

        $this->load->view('feedback_messages_widget', $data);
    }

}
