<?php

namespace Restserver\Libraries;
use Exception;
use stdClass;

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__).'/REST_Controller_53.php';

class REST_Controller extends \REST_Controller {

    public function __construct($config = 'rest') {

        parent::__construct($config);
    }

}
