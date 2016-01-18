<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Datatables_controller extends Base_Controller {

    public $driver_ok = false;

    public function __construct() {

        parent::__construct();

        $this->registry->set('nav', 'playground/datatables');

        $this->driver_ok = extension_loaded('pdo_sqlite');

        $this->template->set_partial('subnavbar', 'playground/datatables/subnavbar');

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $csv = (string) @ file_get_contents(APPPATH.'demo_data/countries.csv');

        $items = preg_split('/\r\n|\r|\n/m', $csv, null, PREG_SPLIT_NO_EMPTY);

        $id = 0;

        foreach ($items as & $item) {

            $id++;

            $values = explode(';', $item);
            $item = (array('id' => $id, 'code' => $values[0], 'name' => $values[1]));
        }

        $this->template
            ->title('DataTables Simple Example')
            ->set('subnavbar_item_active', 'simple-example')
            ->set(compact('items'))
            ->set_partial('scripts', 'datatables/datatables_scripts')
            ->build('datatables/datatables');
    }

    public function ssp() {

        $readme = $this->load->view('datatables/README.md', null, true, array('markdown'));

        $this->template
            ->title('DataTables with Server-Side Processing')
            ->set('subnavbar_item_active', 'ssp')
            ->set('driver_ok', $this->driver_ok)
            ->set('readme', $readme)
            ->set_partial('scripts', 'datatables/datatables_ssp_scripts')
            ->build('datatables/datatables_ssp');
    }

}
