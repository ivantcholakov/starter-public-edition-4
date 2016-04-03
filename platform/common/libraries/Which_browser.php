<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Which_browser {

    protected $php_min = '5.4';

    protected $wb_parser;

    protected $with_clause = false;
    protected $wb_parser_2;

    public function __construct($config = array()) {

        if (!is_php($this->php_min)) {
            throw new Exception('Which_browser: Requires PHP '.$this->php_min.' or above.');
        }

        $this->initialize($config);
    }

    public function initialize($config = array()) {

        if (!is_array($config)) {
            $config = array();
        }

        $raw_info = isset($config['raw_info'])
            ? $config['raw_info']
            : get_instance()->input->request_headers();

        //$this->wb_parser = new WhichBrowser\Parser($this->_get_raw_info($raw_info));
        // Still keeping the PHP 5.2 syntax:
        $reflection = new ReflectionClass('WhichBrowser\Parser');
        $this->wb_parser = $reflection->newInstance($raw_info);

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

    // Usage for testing, an alternative parser is initialized in this case.:
    // $this->load->library('which_browser');
    // $result = $this->which_browser->with(getallheaders())->get();
    // echo $result->toString();
    public function with($raw_info = array()) {

        $this->with_clause = true;

        //$this->wb_parser_2 = new WhichBrowser\Parser($raw_info);
        // Still keeping the PHP 5.2 syntax:
        $reflection = new ReflectionClass('WhichBrowser\Parser');
        $this->wb_parser_2 = $reflection->newInstance($raw_info);

        return $this;
    }

}
