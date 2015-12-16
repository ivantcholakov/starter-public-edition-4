<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Lex_parser_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->parser();

        $this->template
            ->title('Lex Parser Test')
        ;

        $this->registry->set('nav', 'playground/lex');
    }

    public function index() {

        $this->template
            ->build('lex_parser');
    }

}
