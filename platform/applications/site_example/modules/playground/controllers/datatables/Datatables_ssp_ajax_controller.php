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
            ->helper('url')
        ;
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $columns = array(
            array(
                'db' => 'id',
                'dt' => 'id',
                'exact_match' => true   // An instruction to the individual filter, it forces WHERE instead of LIKE clause.
            ),
            array(
                'db' => 'code',
                'dt' => 'code',
                'formatter' => array($this, '_formatter_code')
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
                'db' => 'location',
                //'expression' => "CONCAT(latitude, ',', longitude)", // MySQL
                'expression' => "latitude || ',' || longitude",    // SQLite
                'dt' => 'action_map',
                'formatter' => array($this, '_formatter_action_map')
            ),
            array(
                'db' => 'link',
                'expression' => "link",
                'dt' => 'action_info',
                'formatter' => array($this, '_formatter_action_info')
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

    public function _formatter_code($value, $row) {

        return '<span class="loud">'.$value.'</span>';
    }

    public function _formatter_flag($value, $row) {

        return '<img src="'.BASE_URI.'assets/img/lib/flags-iso/shiny/32/'.$row['code'].'.png" />';
    }

    public function _formatter_action_edit($value, $row) {

        return '<a href="javascript://" class="btn btn-info" title="'.$this->lang->line('ui_edit').'"><i class="fa fa-pencil fa-fw"></i></a>';
    }

    public function _formatter_action_map($value, $item) {

        $value = explode(',', $value);

        if (count($value) != 2) {
            return '';
        }

        $link = gmap_url($value[0], $value[1], 6);

        if ($link == '') {
            return '';
        }

        return '<a href="'.$link.'" class="btn btn-default" title="'.$this->lang->line('ui_map').'" target="_blank"><i class="fa fa-map-marker fa-fw"></i></a>';
    }

    public function _formatter_action_info($value, $item) {

        if ($value == '') {
            return '';
        }

        return '<a href="'.$value.'" class="btn btn-default" title="'.$this->lang->line('ui_information').'" target="_blank"><i class="fa fa-external-link fa-fw"></i></a>';
    }

    public function _formatter_action_delete($value, $row) {

        return '<a id="delete_action_'.$row['id'].'" href="javascript://" class="btn btn-danger delete_action" title="'.$this->lang->line('ui_delete').'"><i class="fa fa-trash-o fa-fw"></i></a>';
    }

}
