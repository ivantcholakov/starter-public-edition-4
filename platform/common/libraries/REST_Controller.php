<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__).'/RestController.php';

class REST_Controller extends \chriskacerguis\RestServer\RestController {

    public function __construct($config = 'rest') {

        parent::__construct($config);
    }

}
