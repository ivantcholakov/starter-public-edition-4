<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This library provides server-side processing for DataTables for jQuery.
 * It is compatible with DataTables v1.10 and above (hopefuly).
 * Written for and tested on CodeIgniter 3.0.
 *
 * See
 * @link https://next.datatables.net
 * @link https://next.datatables.net/examples/server_side/
 *
 * You may find a visually compatible with Bootstrap 3 integration for DataTables at:
 * @link http://startbootstrap.com/sb-admin-v2
 * @link https://github.com/IronSummitMedia/startbootstrap/tree/master/templates/sb-admin-v2
 *
 * Here is the original integration with Bootstrap:
 * https://github.com/DataTables/Plugins/tree/master/integration/bootstrap
 *
 * For table responsiveness with server-side processing the following plugin is needed:
 * @link https://github.com/Comanche/datatables-responsive
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, March 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Usage Example:
/*
<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Data_tables_ajax_controller extends Base_Ajax_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('datatable')
            ->model('users')
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
                'db' => 'username',
                'dt' => 'username'
            ),
            array(
                'db' => 'email',
                'dt' => 'email'
            ),
            array(
                'db' => 'first_name',
                'dt' => 'first_name'
            ),
            array(
                'db' => 'last_name',
                'dt' => 'last_name'
            ),
        );

        $this->output->set_output(

            $this->datatable
                ->set_columns($columns)
                ->from($this->users)    // Using a custom model that extends Core_Model.
                //->from('users', 'id')   // Using CodeIgniter's Query Builder.
                ->generate()
        );
    }

}

*/

class Datatable {

    protected $ci;

    protected $request;
    protected $db;
    protected $primary_key;
    protected $columns;

    public function __construct() {

        $this->ci =& get_instance();

        $this->clear();
    }

    public function generate($as_json = true) {

        $this->set_filters();

        if ($this->is_custom_model()) {

            $db = $this->db->database();
            $clone_db = clone $db;

            $clone = clone $this->db;
            $clone->set_database($clone_db);

        } else {

            $clone = clone $this->db;
        }

        if ($this->is_custom_model($clone)) {

            $clone->select('COUNT('.$clone_db->protect_identifiers($this->primary_key).')', false);
            $recordsTotal = (int) $clone->as_value()->first();

        } else {

            $clone->select('COUNT('.$clone->protect_identifiers($this->primary_key).') AS cnt', false);
            $recordsTotal = (int) $clone->get()->row()->cnt;
        }

        $this->set_limit()->set_order();

        $select = $this->pluck($this->columns, 'db');

        if (!empty($select)) {

            foreach ($select as $key => $field) {

                if (trim($field) != '') {
                    $select[$key] = $this->db()->protect_identifiers($field);
                } else {
                    $select[$key] = 'NULL';
                }
            }

            $select = implode(', ', $select);

        } else {

            $select = '*';
        }

        // A change by Ivan Tcholakov, 27-MAR-2014.
        // Strange, the table works fine when $recordsFiltered = $recordsTotal
        //$this->select('SQL_CALC_FOUND_ROWS '.$select, false);
        $this->select($select, false);
        //

        if ($this->is_custom_model()) {
            $data = $this->db->as_array()->find();
        } else {
            $data = $this->db->get()->result_array();
        }

        // A change by Ivan Tcholakov, 27-MAR-2014.
        // Strange, the table works fine when $recordsFiltered = $recordsTotal
        //$recordsFiltered = (int) $this->db()->query('SELECT FOUND_ROWS() AS cnt')->row()->cnt;
        $recordsFiltered = $recordsTotal;
        //

        $result = array(
            'draw'            => isset($this->request['draw']) ? (int) $this->request['draw'] : 0,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $this->data_output($data)
        );

        $this->clear();

        if ($as_json) {
            return json_encode($result);
        }

        return $result;
    }

    // If not set, the default request is get_instance()->input->post().
    public function set_request($request) {

        if (is_array($request)) {
            $this->request = $request;
        }

        return $this;
    }

    public function set_columns($columns) {

        if (!is_array($columns)) {
            return $this;
        }

        $this->columns = $columns;

        return $this;
    }

    public function from($from, $primary_key = null, $db = null) {

        // Check whether a custom model is to be used.

        if (is_object($from)) {

            if ($this->is_custom_model($from, true)) {

                // $front is a model that extends our custom Core_Model.
                // See https://github.com/ivantcholakov/codeigniter-base-model
                $this->db = $from;
                $this->primary_key = $this->db->primary_key();

            } else {

                // Wrong object type has been passed, abort.
                $this->clear();
            }

            return $this;
        }

        // The normal Query builder has been chosen here.

        // Set the Query Builder.
        if (is_object($db)) {

            $this->db = $db;
        }

        // Set the table and the primary key.
        if (is_object($this->db)) {

            $this->db->from($from);
            $this->primary_key = $primary_key;

        } else {

            // The Query Builder is missing, abort.
            $this->clear();
        }

        return $this;
    }


    // Model/query builder method wrappers.
    //--------------------------------------------------------------------------

    public function with_deleted() {

        if ($this->is_custom_model()) {
            $this->db->with_deleted();
        } else {
            die('DB::with_deleted() is not supported. Use a custom model.');
        }

        return $this;
    }

    public function only_deleted() {

        if ($this->is_custom_model()) {
            $this->db->only_deleted();
        } else {
            die('DB::only_deleted() is not supported. Use a custom model.');
        }

        return $this;
    }

    public function order_by($criteria, $order = '', $escape = NULL) {

        $this->db->order_by($criteria, $order, $escape);

        return $this;
    }

    public function limit($limit, $offset = FALSE) {

        $this->db->limit($limit, $offset);

        return $this;
    }

    public function offset($offset) {

        $this->db->offset($offset);

        return $this;
    }

    public function select($select = '*', $escape = NULL) {

        $this->db->select($select, $escape);

        return $this;
    }

    public function distinct($val = TRUE) {

        $this->db->distinct($val);

        return $this;
    }

    public function join($table, $cond, $type = '', $escape = NULL) {

        $this->db->join($table, $cond, $type, $escape);

        return $this;
    }

    public function escape($str) {

        return $this->db->escape($str);
    }

    public function escape_like_str($str) {

        return $this->db->escape_like_str($str);
    }

    public function escape_str($str, $like = FALSE) {

        return $this->db->escape_str($str, $like);
    }

    public function where($key, $value = NULL, $escape = NULL) {

        $this->db->where($key, $value, $escape);

        return $this;
    }

    public function or_where($key, $value = NULL, $escape = NULL) {

        $this->db->or_where($key, $value, $escape);

        return $this;
    }

    public function where_in($key = NULL, $values = NULL, $escape = NULL) {

        $this->db->where_in($key, $values, $escape);

        return $this;
    }

    public function or_where_in($key = NULL, $values = NULL, $escape = NULL) {

        $this->db->or_where_in($key, $values, $escape);

        return $this;
    }

    public function where_not_in($key = NULL, $values = NULL, $escape = NULL) {

        $this->db->where_not_in($key, $values, $escape);

        return $this;
    }

    public function or_where_not_in($key = NULL, $values = NULL, $escape = NULL) {

        $this->db->or_where_not_in($key, $values, $escape);

        return $this;
    }

    public function like($field, $match = '', $side = 'both', $escape = NULL) {

        $this->db->like($field, $match, $side, $escape);

        return $this;
    }

    public function not_like($field, $match = '', $side = 'both', $escape = NULL) {

        $this->db->not_like($field, $match, $side, $escape);

        return $this;
    }

    public function or_like($field, $match = '', $side = 'both', $escape = NULL) {

        $this->db->or_like($field, $match, $side, $escape);

        return $this;
    }

    public function or_not_like($field, $match = '', $side = 'both', $escape = NULL) {

        $this->db->or_not_like($field, $match, $side, $escape);

        return $this;
    }

    public function group_start($not = '', $type = 'AND ') {
        
        $this->db->group_start($not, $type);

        return $this;
    }

    public function or_group_start() {

        $this->db->or_group_start();

        return $this;
    }

    public function not_group_start() {

        $this->db->not_group_start();

        return $this;
    }

    public function or_not_group_start() {

        $this->db->or_not_group_start();

        return $this;
    }

    public function group_end() {

        $this->db->group_end();

        return $this;
    }

    public function group_by($by, $escape = NULL) {

        $this->db->group_by($by, $escape);

        return $this;
    }

    public function having($key, $value = NULL, $escape = NULL) {

        $this->db->having($key, $value, $escape);

        return $this;
    }

    public function or_having($key, $value = NULL, $escape = NULL) {

        $this->db->having($key, $value, $escape);

        return $this;
    }


    // Protected methods
    //--------------------------------------------------------------------------

    protected function clear() {

        $this->set_request($this->ci->input->post());

        if (isset($this->ci->db) && is_object($this->ci->db)) {
            $this->db = $this->ci->db;
        } else {
            $this->db = null;
        }

        $this->primary_key = null;
        $this->columns = null;
    }

    protected function set_limit() {

        if (isset($this->request['start']) && $this->request['length'] != -1) {

            $this
                ->offset((int) $this->request['start'])
                ->limit((int) $this->request['length']);
        }

        return $this;
    }

    protected function set_order() {

        if (isset($this->request['order']) && count($this->request['order'])) {

            $orderBy = array();
            $dtColumns = $this->pluck($this->columns, 'dt');

            for ($i = 0, $ien = count($this->request['order']); $i < $ien; $i++) {

                // Convert the column index into the column data property
                $columnIdx = intval($this->request['order'][$i]['column']);
                $requestColumn = $this->request['columns'][$columnIdx];

                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $this->columns[$columnIdx];

                $has_db_prop = isset($column['db']) && $column['db'] != '';

                if ($has_db_prop && isset($requestColumn['orderable']) && $requestColumn['orderable'] == 'true') {

                    $dir = $this->request['order'][$i]['dir'] === 'asc' ? 'asc' : 'desc';
                    $this->order_by($column['db'], $dir);
                }
            }
        }

        return $this;
    }

    protected function set_filters() {

        $dtColumns = $this->pluck($this->columns, 'dt');

        if (isset($this->request['columns']) && isset($this->request['search'])
            && isset($this->request['search']['value']) && $this->request['search']['value'] != '') {

            $this->group_start();

            $str = $this->request['search']['value'];

            $c = 0;

            for ($i = 0, $ien = count($this->request['columns']); $i < $ien; $i++) {

                $requestColumn = $this->request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $this->columns[$columnIdx];

                $has_db_prop = isset($column['db']) && $column['db'] != '';

                if ($has_db_prop && isset($requestColumn['searchable']) && $requestColumn['searchable'] == 'true') {

                    if ($c == 0) {
                        $this->like($column['db'], $str);
                    } else {
                        $this->or_like($column['db'], $str);
                    }

                    $c++;
                }
            }

            $this->group_end();
        }

        // Individual column filtering

        if (isset($this->request['columns'])) {

            for ($i = 0, $ien = count($this->request['columns']); $i < $ien; $i++) {

                $requestColumn = $this->request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $this->columns[$columnIdx];

                $str = isset($requestColumn['search']['value']) ? $requestColumn['search']['value'] : '';

                $has_db_prop = isset($column['db']) && $column['db'] != '';

                if ($has_db_prop && isset($requestColumn['searchable']) && $requestColumn['searchable'] == 'true' && $str != '') {
                    $this->like($column['db'], $str);
                }
            }
        }

        return $this;
    }

    protected function data_output (& $data) {

        $out = array();

        for ($i = 0, $ien = count($data); $i < $ien; $i++) {

            $row = array();

            for ($j = 0, $jen = count($this->columns); $j < $jen; $j++) {

                $column = $this->columns[$j];

                $has_db_prop = isset($this->columns[$j]['db']) && $this->columns[$j]['db'] != '';

                // Is there a formatter? (closures/lambda functions and array($object, 'method') callables)
                $formatter = isset($column['formatter']) ? (is_callable($column['formatter']) ? $column['formatter'] : null) : null;

                if (isset($formatter)) {
                    
                    $row[$column['dt']] = is_array($formatter)
                        ? $formatter[0]->{$formatter[1]}($has_db_prop ? $data[$i][$column['db']] : null, $data[$i])
                        : $formatter($has_db_prop ? $data[$i][$column['db']] : null, $data[$i]);

                } else {

                    $row[$column['dt']] = $has_db_prop ? $data[$i][$this->columns[$j]['db']] : null;
                }
            }

            $out[] = $row;
        }

        return $out;
    }

    /**
     * Pull a particular property from each assoc. array in a numeric array, 
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @param  string $prop Property to read
     *  @return array        Array of property values
     */
    protected function pluck($a, $prop) {

        $out = array();

        for ($i = 0, $len = count($a); $i < $len; $i++) {

            $has_prop = isset($a[$i][$prop]) && $a[$i][$prop] != '';

            if ($has_prop) {
                $out[] = $a[$i][$prop];
            } else {
                $out[] = null;
            }
        }

        return $out;
    }

    protected function is_custom_model($object = null, $strict_check = false) {

        if (!is_object($object)) {
 
            if ($strict_check) {
                return false;
            }

            $object = $this->db;

            if (!is_object($object)) {
                return false;
            }
        }

        return @ is_a($object, 'Core_Model');
    }

    protected function db() {

        return $this->is_custom_model() ? $this->db->database() : $this->db;
    }

}
