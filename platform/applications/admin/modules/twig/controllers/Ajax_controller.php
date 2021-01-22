<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends Base_Authenticated_Ajax_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $this->load->helper('file');
        $this->load->helper('url');

        $this->load->config('twig');
        $items = $this->config->item('twig');

        $i = $this->input->get('i');

        $success = false;
        $feedback_message = null;

        $result = array(
            'i' => & $i,
            'success' => & $success,
            'feedback_message' => & $feedback_message,
        );

        if ($i == '') {

            $feedback_message = 'A configuration identificatior is missing.';

            return $this->_output($result);
        }

        if (!ctype_digit($i)) {

            $feedback_message = 'Invalid configuration identificatior.';

            return $this->_output($result);
        }

        $i = (int) $i;

        if (!array_key_exists($i, $items)) {

            $feedback_message = 'The requested configuration does not exist.';

            return $this->_output($result);
        }

        $item = $items[$i];

        if (array_key_exists('directory', $item)) {

            delete_files($item['directory'], true);
            file_exists($item['directory']) OR @mkdir($item['directory'], DIR_WRITE_MODE, TRUE);
            $success = true;
            $feedback_message = 'Ok.';

            return $this->_output($result);

        } elseif (array_key_exists('url', $item)) {

            $client = new GuzzleHttp\Client();
            @ $res = $client->get(
                $item['url'],
                [
                    'verify' => false,
                    'http_errors' => false,
                ]
            );

            $body = (string) $res->getBody();
            $status_code = $res->getStatusCode();

            $success = $status_code == 200;

            if ($success) {
                $feedback_message = $body;
            } else {
                $feedback_message = 'Status code: '.$status_code;
            }

            return $this->_output($result);
        }

        $feedback_message = 'There is no set directory or URL.';
        $this->_output($result);
    }

    protected function _output($result) {

        $this->output->set_output(json_encode($result));
    }
}
