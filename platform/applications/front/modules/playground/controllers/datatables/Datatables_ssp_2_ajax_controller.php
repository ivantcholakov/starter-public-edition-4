<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Datatables_ssp_2_ajax_controller extends Base_Ajax_Controller {

    protected $has_order;
    protected $has_filter;

    public function __construct() {

        parent::__construct();

        $this->load
            ->database()
            ->library('datatable')
            ->model('countries')
            ->helper('url')
            ->helper('countries')
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
                'dt' => 'name',
                'formatter' => array($this, '_formatter_name')
            ),
            array(
                'dt' => 'flag',
                'formatter' => array($this, '_formatter_flag')
            ),
            array(
                'dt' => 'display_order',
                'db' => 'display_order',
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
        );

        $columns = array_merge($columns, array(
            array(
                'dt' => 'action_reorder',
                'formatter' => array($this, '_formatter_action_reorder')
            ),
            array(
                'dt' => 'action_up_or_down',
                'formatter' => array($this, '_formatter_action_up_or_down')
            ),
            array(
                'dt' => 'actions',
                'formatter' => array($this, '_formatter_actions')
            ),
        ));

        $columns = array_merge($columns, array(
            array(
                'dt' => 'DT_RowId',
                'formatter' => array($this, '_formatter_DT_RowId')
            ),
        ));

        $this->datatable->set_columns($columns);
        $this->has_order = $this->datatable->has_order();
        $this->has_filter = $this->datatable->has_filter();

        if (!$this->has_order) {
            $this->datatable->order_by('display_order', 'asc');
        }

        $this->output->set_output(

            $this->datatable
                ->from($this->countries)    // Using a model (that extends Core_Model).
                ->generate()
        );
    }

    public function _formatter_code($value, $item) {

        return '<span class="loud">'.$value.'</span>';
    }

    public function _formatter_name($value, $item) {

        // HTML escaping demo.
        return html_escape($value);
    }

    public function _formatter_flag($value, $item) {

        return '<img src="'.BASE_URI.'assets/img/lib/flags-iso/shiny/32/'.country_flag($item['code']).'.png" />';
    }

    public function _formatter_action_reorder($value, $item) {

        $disabled = $this->has_order || $this->has_filter;

        return '<button data-id="'.$item['id'].'" class="compact ui icon button mobile hidden action_reorder"'.($disabled ? ' disabled="disabled"' : '').'><i class="hand paper icon"></i></button>';
    }

    public function _formatter_action_up_or_down($value, $item) {

        $disabled = $this->has_order || $this->has_filter;

        return
            '<div class="ui icon buttons">'.
            '<button data-id="'.$item['id'].'" class="compact ui icon button action_up"'.($disabled ? ' disabled="disabled"' : '').'><i class="arrow up icon"></i></button>'.
            '<button data-id="'.$item['id'].'" class="compact ui icon button action_down"'.($disabled ? ' disabled="disabled"' : '').'><i class="arrow down icon"></i></button>'.
            '</div>';
    }

    public function _formatter_actions($value, $item) {

        $result = array();

        $gmap_url = gmap_url($item['latitude'], $item['longitude'], 6);

        if ($gmap_url != '') {
            $result[] = '<a href="'.$gmap_url.'" class="compact ui icon button" title="'.$this->lang->line('ui_map').'" target="_blank" rel="noopener"><i class="marker icon"></i></a>';
        }

        if ($item['link'] != '') {
            $result[] = '<a href="'.$item['link'].'" class="compact ui icon button" title="'.$this->lang->line('ui_information').'" target="_blank" rel="noopener"><i class="external icon"></i></a>';
        }

        $result[] = '<a href="javascript://" class="compact primary ui icon button" title="'.$this->lang->line('ui_edit').'"><i class="write icon"></i></a>';
        $result[] = '<a id="delete_action_'.$item['id'].'" href="javascript://" class="compact negative ui icon button delete_action" title="'.$this->lang->line('ui_delete').'"><i class="trash icon"></i></a>';

        return '<div class="ui icon buttons">'.implode('', $result).'</div>';
    }

    public function _formatter_DT_RowId($value, $item) {

        return 'datatable_row_'.$item['id'];
    }

    public function up() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $this->load->helper('display_order');

        $id = (int) $this->input->post('id');
        $success = false;

        if (!empty($id)) {

            $item = $this->countries->select('id')->get($id);

            if (!empty($item)) {

                display_order_up($this->countries->table(), $id);

                $success = true;
            }
        }

        $this->output->set_output(json_encode(compact('success')));
    }

    public function down() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $this->load->helper('display_order');

        $id = (int) $this->input->post('id');
        $success = false;

        if (!empty($id)) {

            $item = $this->countries->select('id')->get($id);

            if (!empty($item)) {

                display_order_down($this->countries->table(), $id);

                $success = true;
            }
        }

        $this->output->set_output(json_encode(compact('success')));
    }

    public function reorder() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $id = $this->input->post('id');
        $id = $id == '' ? null : (int) $id;

        $id_prev = $this->input->post('id_prev');
        $id_prev = $id_prev == '' ? null : (int) $id_prev;

        $id_next = $this->input->post('id_next');
        $id_next = $id_next == '' ? null : (int) $id_next;

        $success = false;
        $new_order = null;

        if ($id !== null) {

            $item = $this->countries->select('display_order')->get($id);

            if (!empty($item)) {

                $order = (int) $item['display_order'];

                $order_prev = null;

                if ($id_prev !== null) {

                    $item_prev = $this->countries->select('display_order')->get($id_prev);

                    if (!empty($item_prev)) {

                        $order_prev = (int) $item_prev['display_order'];
                    }
                }

                $order_next = null;

                if ($id_next !== null) {

                    $item_next = $this->countries->select('display_order')->get($id_next);

                    if (!empty($item_next)) {

                        $order_next = (int) $item_next['display_order'];
                    }
                }

                if ($id_prev !== null) {

                    $new_order = $order_prev + 1;

                    $item_test = $this->countries->select('id')->where('display_order', $new_order)->with_deleted()->first();

                    if (!empty($item_test)) {

                        $this->countries->where('display_order >=', $new_order)->with_deleted()->skip_observers()->update_all(array('display_order' => 'display_order + 1'), false);
                    }

                    $this->countries->skip_observers()->update($id, array('display_order' => $new_order));

                    $success = true;

                } elseif ($id_next !== null) {

                    $new_order = $order_next - 1;

                    if ($new_order < 1) {
                        $new_order = 1;
                    }

                    $item_test = $this->countries->select('id')->where('display_order', $new_order)->with_deleted()->first();

                    if (!empty($item_test)) {

                        $new_order = $order_next;
                        $this->countries->where('display_order >=', $new_order)->with_deleted()->skip_observers()->update_all(array('display_order' => 'display_order + 1'), false);
                    }

                    $this->countries->skip_observers()->update($id, array('display_order' => $new_order));

                    $success = true;
                }
            }
        }

        $this->output->set_output(json_encode(compact('success')));
    }

}
