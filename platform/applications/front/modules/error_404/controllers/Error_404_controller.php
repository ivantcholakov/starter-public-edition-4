<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $error_string = $this->lang->line('ui_error_404');

        if (is_cli()) {

            $this->output->set_output(PHP_EOL.$error_string.PHP_EOL);
            echo $this->output->get_output();
            exit(EXIT_ERROR);
        }

        set_status_header(404);

        if ($this->input->is_ajax_request()) {

            $this->output->set_output($error_string);
            return;
        }

        $error_string = $this->lang->line('ui_error_404_title');
        $this->registry->set('is_error', true);

        $this->template
            ->title($error_string)
            ->build('error_404');
    }

}
