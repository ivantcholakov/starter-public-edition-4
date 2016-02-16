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

        $feedback_message_id = isset($data['element_id']) && $data['element_id'] != '' ? nohtml($data['element_id']) : 'main_feedback_message';
        $feedback_message_full_width = array_key_exists('full_width', $data) ? !empty($data['full_width']) : true;
        $feedback_message_with_javascript = array_key_exists('with_javascript', $data) ? !empty($data['with_javascript']) : true;

        $this->load->view('feedback_messages_widget',
            compact(
                'feedback_message_id',
                'feedback_message_full_width',
                'feedback_message_with_javascript'
            )
        );
    }

}
