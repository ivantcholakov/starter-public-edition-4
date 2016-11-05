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
                'db' => 'latitude',
            ),
            array(
                'db' => 'longitude',
            ),
            array(
                'db' => 'link',
            ),
            array(
                'dt' => 'actions',
                'formatter' => array($this, '_formatter_actions')
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

    public function _formatter_code($value, $item) {

        return '<span class="loud">'.$value.'</span>';
    }

    public function _formatter_flag($value, $item) {

        return '<img src="'.BASE_URI.'assets/img/lib/flags-iso/shiny/32/'.$item['code'].'.png" />';
    }

    public function _formatter_actions($value, $item) {

        $result = array();

        $gmap_url = gmap_url($item['latitude'], $item['longitude'], 6);

        if ($gmap_url != '') {
            $result[] = '<a href="'.$gmap_url.'" class="compact ui icon button" title="'.$this->lang->line('ui_map').'" target="_blank"><i class="marker icon"></i></a>';
        }

        if ($item['link'] != '') {
            $result[] = '<a href="'.$item['link'].'" class="compact ui icon button" title="'.$this->lang->line('ui_information').'" target="_blank"><i class="external icon"></i></a>';
        }

        $result[] = '<a href="javascript://" class="compact primary ui icon button" title="'.$this->lang->line('ui_edit').'"><i class="write icon"></i></a>';
        $result[] = '<a id="delete_action_'.$item['id'].'" href="javascript://" class="compact negative ui icon button delete_action" title="'.$this->lang->line('ui_delete').'"><i class="trash icon"></i></a>';

        return '<div class="ui icon buttons">'.implode('', $result).'</div>';
    }

}
