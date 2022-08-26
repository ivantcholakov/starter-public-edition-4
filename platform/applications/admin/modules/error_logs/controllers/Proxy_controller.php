<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proxy_controller extends Base_Controller {

    public function __construct() {

        if (isset($_GET['dl']) && $_GET['dl'] != '') {
            $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        }

        parent::__construct();
    }

    public function index() {

        $i = (string) $this->uri->rsegment(3);

        if (!ctype_digit($i)) {

            set_status_header(404);
            $this->output->set_output('Not found.');

            return;
        }

        $i = (int) $i;

        $this->load->config('logs');
        $items = $this->config->item('logs');

        $item = !empty($items) && is_array($items) && isset($items[$i]) ? $items[$i] : null;

        if (empty($item) || !isset($item['url'])) {

            set_status_header(404);
            $this->output->set_output('Not found.');

            return;
        }

        $base_url = $this->_add_slash($item['url']);

        // If we are viewing the log of the current application,
        // then we are going to skip the proxy and to return
        // the corresponding response directly.

        if ($base_url == $this->_add_slash(default_base_url('admin'))) {

            Modules::run('logs/index');

            return;
        }

        // Use a proxy server to read the logs of the other applications.

        @ob_end_clean();
        @ob_end_flush();

        $url = $base_url.'logs';

        $request = \Proxy\Http\Request::createFromGlobals();
        $proxy = new \Proxy\Proxy();

        $response = $proxy->forward($request, $url);

        $response->send();

        exit;
    }

    protected function _add_slash($string) {

        $string = (string) $string;

        if ($string != '') {
            $string = rtrim($string, '/').'/';
        }

        return $string;
    }

}
