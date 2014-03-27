<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Datatables_controller extends Base_Controller {

    public $driver_ok = false;

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('DataTables with Server-Side Processing')
        ;

        $this->registry->set('nav', 'playground/datatables');

        $this->driver_ok = extension_loaded('pdo_sqlite');
    }

    public function index() {

        $this->template
            ->set('driver_ok', $this->driver_ok)
            ->set_partial('css', 'datatables/datatables_css')
            ->set_partial('scripts', 'datatables/datatables_scripts')
            ->enable_parser_body('i18n') 
            ->build('datatables/datatables');
    }

}
