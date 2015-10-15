<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

require_once dirname(__FILE__).'/Image_process_controller.php';

class Image_process_nowm_controller extends Image_process_controller {

    public function __construct() {

        parent::__construct();

        $this->has_watermark = false;
    }

}
