<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Datatables_controller extends Playground_Base_Controller {

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

        $title = 'DataTables Simple Example';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('DataTables', site_url('playground/datatables'))
            ->set('subnavbar_item_active', 'simple-example')
            ->set(compact('items'))
            ->set_partial('scripts', 'datatables/datatables_scripts')
            ->build('datatables/datatables');
    }

    public function ssp() {

        $readme = $this->load->view('datatables/README.md', null, true, array('markdown'));

        $title = 'DataTables with Server-Side Processing';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('DataTables', site_url('playground/datatables'))
            ->set_breadcrumb($title, site_url('playground/datatables/ssp'))
            ->set('subnavbar_item_active', 'ssp')
            ->set('driver_ok', $this->driver_ok)
            ->set('readme', $readme)
            ->set_partial('scripts', 'datatables/datatables_ssp_scripts')
            ->build('datatables/datatables_ssp');
    }

    public function ssp_2() {

        $title = 'DataTables with Server-Side Processing 2';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('DataTables', site_url('playground/datatables'))
            ->set_breadcrumb($title, site_url('playground/datatables/ssp-2'))
            ->set('subnavbar_item_active', 'ssp_2')
            ->set('driver_ok', $this->driver_ok)
            ->set_partial('scripts', 'datatables/datatables_ssp_2_scripts')
            ->build('datatables/datatables_ssp_2');
    }

}
