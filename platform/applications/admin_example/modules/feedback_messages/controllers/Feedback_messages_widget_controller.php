<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_messages_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index($config = array()) {

        if (!is_array($config)) {
            $config = array('feedback_message_id' => (string) $config);
        }

        $feedback_message_id = isset($config['feedback_message_id']) ? $config['feedback_message_id'] : '';

        if ($feedback_message_id == '') {
            $feedback_message_id = 'main_feedback_message';
        }

        $feedback_message_expand = isset($config['feedback_message_expand']) ? !empty($config['feedback_message_expand']) : false;

        $this->load->view('feedback_messages_widget',
            compact(
                'feedback_message_id',
                'feedback_message_expand'
            )
        );
    }

}
