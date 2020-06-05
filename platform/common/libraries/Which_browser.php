<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016-2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * See also https://github.com/WhichBrowser/Parser
 */

class Which_browser {

    protected $wb_parser;

    protected $with_clause = false;
    protected $wb_parser_2;

    public function __construct($config = array()) {

        $this->initialize($config);
    }

    public function initialize($config = array()) {

        if (!is_array($config)) {
            $config = array();
        }

        $raw_info = isset($config['raw_info'])
            ? $config['raw_info']
            : get_instance()->input->request_headers();

        $this->wb_parser = new \WhichBrowser\Parser($raw_info);

        return $this;
    }

    // Normal usage:
    // $this->load->library('which_browser');
    // $result = $this->which_browser->get();
    // echo $result->toString();
    public function get() {

        if ($this->with_clause) {

            $this->with_clause = false;
            return $this->wb_parser_2;
        }

        return $this->wb_parser;
    }

    // Usage for testing, an alternative parser is initialized in this case:
    // $this->load->library('which_browser');
    // $result = $this->which_browser->with(getallheaders())->get();
    // echo $result->toString();
    public function with($raw_info) {

        $this->with_clause = true;

        $this->wb_parser_2 = new \WhichBrowser\Parser($raw_info);

        return $this;
    }

}
