<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Datatables_ssp_ajax_controller extends Base_Ajax_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->database()
            ->library('datatable')
            ->model('countries')
        ;
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $columns = array(
            array(
                'db' => 'id',
                'dt' => 'id'
            ),
            array(
                'db' => 'code',
                'dt' => 'code'
            ),
            array(
                'db' => 'name',
                'dt' => 'name'
            ),
            array(
                'dt' => 'flag',
                'formatter' => array($this, '_formatter_flag')
            ),
            array(
                'dt' => 'action_edit',
                'formatter' => array($this, '_formatter_action_edit')
            ),
            array(
                'dt' => 'action_delete',
                'formatter' => array($this, '_formatter_action_delete')
            ),
        );

        $this->output->set_output(

            $this->datatable
                ->set_columns($columns)
                //->from('countries') // This is how the pure query builder may be used.
                ->from($this->countries)    // Using a model (that extends Core_Model).
                ->generate()
        );
    }

    public function _formatter_flag($d, $row) {

        return '<img src="'.BASE_URI.'assets/img/lib/flags/'.$row['code'].'.png" />';
    }

    public function _formatter_action_edit($d, $row) {

        return '<a href="javascript://" class="btn btn-info" title="'.$this->lang->line('ui_edit').'"><i class="fa fa-pencil fa-fw"></i></a>';
    }

    public function _formatter_action_delete($d, $row) {

        return '<a id="delete_action_'.$row['id'].'" href="javascript://" class="btn btn-danger delete_action" title="'.$this->lang->line('ui_delete').'"><i class="fa fa-trash-o fa-fw"></i></a>';
    }

}
