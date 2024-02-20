<?php
/**
 * A base model with a series of CRUD functions (powered by CI's query builder),
 * validation-in-model support, event callbacks and more.
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-model
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 *
 * Some modifications have been implemented by Ivan Tcholakov, 2012-2016
 * @link https://github.com/ivantcholakov/codeigniter-base-model
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Model extends CI_Model
{

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * This model's default database table. Automatically
     * guessed by pluralising the model name.
     */
    protected $_table;

    /**
     * Specify a database group to manually connect this model
     * to the specified DB. You can pass either the group name
     * as defined in application/config/database.php, or a
     * config array of the same format (basically the same thing
     * you can pass to $this->load->database()). If left empty,
     * the default DB will be used.
     */
    protected $_db_group;

    /**
     * The database connection object. Will be set to the default
     * connection unless $this->_db_group is specified. This allows
     * individual models to use different DBs without overwriting
     * CI's global $this->db connection.
     */
    public $_database;

    /**
     * Here a list of table fields e to be stored when it is required.
     */
    protected $_fields = NULL;

    /**
     * This model's default primary key or unique identifier.
     * Used by the get(), update() and delete() functions.
     */
    protected $primary_key = 'id';

    /**
     * Support for soft deletes and this model's 'deleted' key
     */
    protected $soft_delete = FALSE;
    protected $soft_delete_key = 'deleted';
    protected $_temporary_with_deleted = FALSE;
    protected $_temporary_only_deleted = FALSE;
    protected $soft_delete_key_full = NULL; // The constructor initializes this.

    /**
     * The various callbacks available to the model. Each are
     * simple lists of method names (methods will be run on $this).
     */
    protected $before_create = array();
    protected $after_create = array();
    protected $before_update = array();
    protected $after_update = array();
    protected $before_get = array();
    protected $after_get = array();
    protected $before_delete = array();
    protected $after_delete = array();
    protected $before_dropdown = array();
    protected $after_dropdown = array();

    protected $callback_parameters = array();

    /**
     * Support for skip_observers() scope.
     */
    protected $_temporary_skip_observers = FALSE;

    /**
     * Protected, non-modifiable attributes
     */
    protected $protected_attributes = array();

    /**
     * If this flag is TRUE before insert and before update, non-existent
     * (within the table) fields from input data are removed.
     * Currently works with array-type input data only.
     */
    protected $check_for_existing_fields = FALSE;

    /**
     * Relationship arrays. Use flat strings for defaults or string
     * => array to customise the class name and primary key
     */
    protected $belongs_to = array();
    protected $has_many = array();

    protected $_with = array();

    /**
     * An array of validation rules. This needs to be the same format
     * as validation rules passed to the Form_validation library.
     */
    protected $validate = array();

    /**
     * Optionally skip the validation. Used in conjunction with
     * skip_validation() to skip data validation for any future calls.
     */
    protected $skip_validation = FALSE;

    /**
     * By default we return our results as objects. If we need to override
     * this, we can, or, we could use the `as_array()` and `as_object()` scopes.
     */
    protected $return_type = 'object';
    protected $_temporary_return_type = NULL;

    /**
     * For the cases when we are intersted to retrieve a single value
     * we may use `as_value()` scopes for convenience.
     */
    protected $qb_as_value = NULL;

    /**
     * For the cases when we are intersted to retrieve a single value
     * we may use `as_value()` scopes for convenience.
     */
    protected $qb_as_sql = NULL;

    /**
     * Additional scope that enforces JSON presentation of the returned result.
     */
    protected $_as_json = FALSE;
    protected $_as_json_options = 0;

    /**
     * A flag indicating $this->distinct() usage.
     */
    protected $qb_distinct = NULL;

    /**
     * A flag indicating that select() method of this object has been called.
     */
    protected $_select_called = FALSE;

    /**
     * Saved value about LIMIT clause.
     */
    protected $_limit = FALSE;

    /**
     * Saved value about OFFSET clause.
     */
    protected $_offset = FALSE;

    /**
     * CodeIgniter version check.
     */
    protected $_is_ci_3 = NULL;

    /**
     * Compatibility checks.
     */
    protected $_function_exists_array_column = NULL;

    /**
     * Driver info.
     */
    protected $_dbdriver = NULL;
    protected $_subdriver = NULL;

    /**
     * Driver specific SQL fragments.
     */
    protected $_count_string = 'SELECT COUNT(*) AS ';

    /**
     * User ID getter for the observers 'created_by', 'updated_by' and 'deleted_by'.
     * It should be a callable type (function() or array($object, 'method'))
     * without parameters. If it is not set, User ID is assumed to be null value.
     */
    protected $user_id_getter = NULL;

    /**
     * The name of the language model that is to serve language translations.
     * The language model should be in extended type from Core_Lang_Model.
     */
    protected $lang_model_name = NULL;

    /**
     * The location string (optional) of the language model that is to serve language translations.
     * This is commonly to be used when the language model name is aliased or
     * when the language model is located within a module.
     */
    protected $lang_model_location = NULL;

    /**
     * The instance of the language model that is to serve language translations.
     * See Core_Lang_Model.
     */
    public $lang_model = NULL;

    /* Common module extender object (Xavier Perez) */
    protected $common_module_extender;

    /* --------------------------------------------------------------
     * GENERIC METHODS
     * ------------------------------------------------------------ */

    /**
     * Initialise the model, tie into the CodeIgniter superobject and
     * try our best to guess the table name.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_is_ci_3 = (int) CI_VERSION >= 3;
        $this->_function_exists_array_column = function_exists('array_column');

        $this->load->helper('inflector');

        $this->_set_database();
        $this->_fetch_table();

        $this->soft_delete_key_full = $this->_table.'.'.$this->soft_delete_key;

        array_unshift($this->before_create, 'protect_attributes');
        array_unshift($this->before_update, 'protect_attributes');

        if ($this->check_for_existing_fields)
        {
            array_unshift($this->before_create, 'existing_fields_only');
            array_unshift($this->before_update, 'existing_fields_only');
        }

        $this->_reset_state();

        $this->_dbdriver = isset($this->_database->dbdriver)
            ? $this->_database->dbdriver
            : NULL;

        $this->_subdriver = isset($this->_database->subdriver)
            ? $this->_database->subdriver
            : NULL;

        if ($this->_dbdriver == 'oci8' || $this->_subdriver == 'oci') {
            $this->_count_string = 'SELECT COUNT(1) AS ';
        }

        if ($this->lang_model_name != '') {

            if ($this->lang_model_location != '') {
                $this->load->model($this->lang_model_location, $this->lang_model_name);
            } else {
                $this->load->model($this->lang_model_name);
            }

            $this->lang_model = $this->{$this->lang_model_name};
        }
    }

    public function __clone()
    {
        if (is_object($this->_database))
        {
            // Make a clone of the query builder, so the state of the original one to be preserved.
            $this->_database = clone $this->_database;
        }

        if (is_object($this->lang_model))
        {
            $this->lang_model = clone $this->lang_model;
        }
    }

    /**
     * An empty method that keeps chaining, the parameter does the desired operation as a side-effect.
     *
     * Sample usage (you want to build the query using one PHP sentence):
     *
     * $for_male = true;    // Assign this using the user input.
     *
     * $found_products = $this->products
     *     ->select('id, name')
     *     ->where('in_stock', 1)
     *     ->that($for_male ? $this->products->where('for_male', 1) : null)
     *     ->limit(20)
     *     ->order_by('price', 'asc')
     *     ->as_array()
     *     ->find();
     *
     * var_dump($found_products);
     *
     * @param   mixed   $expression     A (conditional) expression that changes context/scope.
     * @return  object                  Returns a reference to the created model instance.
     */
    public function that($expression = NULL)
    {
        return $this;
    }

    /* --------------------------------------------------------------
     * CRUD INTERFACE
     * ------------------------------------------------------------ */

    /**
     * Fetch a single record based on the primary key. Returns an object.
     */
    public function get($primary_value)
    {
        return $this->get_by($this->primary_key, $primary_value);
    }

    /**
     * Fetch a single record based on an arbitrary WHERE call. Can be
     * any valid value to $this->_database->where().
     */
    public function get_by()
    {
        $where = func_get_args();
        $this->_set_where($where);
        $this->_database->limit(1);

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        $this->trigger('before_get');

        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.
            return $this->_return_sql('select');
        }

        $get = $this->_database
            ->get($this->_table);

        $row = $get
            ? $get->{$this->_return_type()}()
            : ($this->_temporary_return_type == 'array' ? array() : null);

        $row = $this->trigger('after_get', $row);

        if ($this->qb_as_value)
        {
            // Return a single value as a result.
            return $this->_return_value($row);
        }

        if ($this->_as_json)
        {
            return $this->_return_json($row);
        }

        $this->_reset_state();

        return $row;
    }

    /**
     * An alias of get_by().
     */
    public function first()
    {
        $args = func_get_args();

        return call_user_func_array(array($this, 'get_by'), $args);
    }

    /**
     * Fetch an array of records based on an array of primary values.
     */
    public function get_many($values)
    {
        $this->_database->where_in($this->primary_key, $values);

        return $this->get_all();
    }

    /**
     * Fetch an array of records based on an arbitrary WHERE call.
     */
    public function get_many_by()
    {
        $where = func_get_args();
        $this->_set_where($where);

        return $this->get_all();
    }

    /**
     * An alias of get_many_by().
     */
    public function find()
    {
        $args = func_get_args();

        return call_user_func_array(array($this, 'get_many_by'), $args);
    }

    /**
     * Fetch all the records in the table. Can be used as a generic call
     * to $this->_database->get() with scoped methods.
     */
    public function get_all()
    {
        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        $this->trigger('before_get');

        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.
            return $this->_return_sql('select');
        }

        $get = $this->_database
            ->get($this->_table);

        $result = $get
            ? $get->{$this->_return_type(1)}()
            : array();

        foreach ($result as $key => &$row)
        {
            $row = $this->trigger('after_get', $row, ($key == count($result) - 1));
        }

        if ($this->_as_json)
        {
            return $this->_return_json($result);
        }

        $this->_reset_state();

        return $result;
    }

    /**
     * Insert a new row into the table. $data should be an associative array
     * of data to be inserted. Returns newly created ID.
     */
    public function insert($data, $skip_validation = FALSE, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $data = $this->trigger('before_create', $data);

            $this->_database->set($data, '', $escape);

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('insert');
            }

            $this->_database->insert($this->_table);

            $insert_id = $this->primary_key != '' ? $this->_database->insert_id() : null;

            $this->trigger('after_create', $insert_id);

            $this->_reset_state();

            return $insert_id;
        }

        $this->_reset_state();

        return FALSE;
    }

    /**
     * Insert multiple rows into the table. Returns an array of multiple IDs.
     */
    public function insert_many($data, $skip_validation = FALSE, $escape = NULL)
    {
        $return_sql = $this->qb_as_sql;
        $skip_observers = $this->_temporary_skip_observers;

        $ids = array();

        foreach ($data as $key => $row)
        {
            $this->qb_as_sql = $return_sql;
            $this->_temporary_skip_observers = $skip_observers;

            // A correction by Ivan Tcholakov, 14-DEC-2012.
            //$ids[] = $this->insert($row, $skip_validation, ($key == count($data) - 1));
            $ids[] = $this->insert($row, $skip_validation, $escape);
            //
        }

        return $ids;
    }

    /**
     * Updated a record based on the primary value.
     */
    public function update($primary_value, $data, $skip_validation = FALSE, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);

        $data = $this->trigger('before_update', $data);

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
            {
                $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
            }

            $this->_database->where($this->primary_key, $primary_value)
                ->set($data, '', $escape);

            // See http://www.sqlite.org/compile.html#enable_update_delete_limit
            if (strpos((string) $this->_dbdriver, 'sqlite') === false && strpos((string) $this->_subdriver, 'sqlite') === false) {
                $this->_database->limit(1);
            }

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table);

            $this->trigger('after_update', array($data, $result, $primary_value));

            $this->_reset_state();

            return $result;
        }

        $this->_reset_state();

        return FALSE;
    }

    /**
     * Update many records, based on an array of primary values.
     */
    public function update_many($primary_values, $data, $skip_validation = FALSE, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);

        $data = $this->trigger('before_update', $data);

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
            {
                $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
            }

            $this->_database->where_in($this->primary_key, $primary_values)
                ->set($data, '', $escape);

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table);

            $this->trigger('after_update', array($data, $result, $primary_values));

            $this->_reset_state();

            return $result;
        }

        $this->_reset_state();

        return FALSE;
    }

    /**
     * Updated a record based on an arbitrary WHERE clause.
     */
    public function update_by()
    {
        $escape = $this->_check_default_escape(NULL);

        $args = func_get_args();
        $data = array_pop($args);

        if (count($args) < 3)
        {
            $this->_set_where($args);
        }
        else
        {
            $where = array_pop($args);
            $this->_set_where($where);
            $escape = $this->_check_default_escape($args);
        }

        $data = $this->trigger('before_update', $data);

        if ($this->validate($data) !== FALSE)
        {
            if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
            {
                $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
            }

            $this->_database->set($data, '', $escape);

            // See http://www.sqlite.org/compile.html#enable_update_delete_limit
            if (strpos((string) $this->_dbdriver, 'sqlite') === false && strpos((string) $this->_subdriver, 'sqlite') === false) {
                $this->_database->limit(1);
            }

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table);

            $this->trigger('after_update', array($data, $result));

            $this->_reset_state();

            return $result;
        }

        $this->_reset_state();

        return FALSE;
    }

    /**
     * Update many records, based on an arbitrary WHERE clause.
     */
    public function update_many_by()
    {
        $escape = $this->_check_default_escape(NULL);

        $args = func_get_args();
        $data = array_pop($args);

        if (count($args) < 3)
        {
            $this->_set_where($args);
        }
        else
        {
            $where = array_pop($args);
            $this->_set_where($where);
            $escape = $this->_check_default_escape($args);
        }

        $data = $this->trigger('before_update', $data);

        if ($this->validate($data) !== FALSE)
        {
            if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
            {
                $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
            }

            $this->_database->set($data, '', $escape);

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table);

            $this->trigger('after_update', array($data, $result));

            $this->_reset_state();

            return $result;
        }

        $this->_reset_state();

        return FALSE;
    }

    /**
     * Update all records
     */
    public function update_all($data, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);

        $data = $this->trigger('before_update', $data);

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        $this->_database->set($data, '', $escape);

        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.
            return $this->_return_sql('update');
        }

        $result = $this->_database->update($this->_table);

        $this->trigger('after_update', array($data, $result));

        $this->_reset_state();

        return $result;
    }

    /**
     * Delete a row from the table by the primary value
     */
    public function delete($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        if ($this->soft_delete)
        {
            // See http://www.sqlite.org/compile.html#enable_update_delete_limit
            if (strpos((string) $this->_dbdriver, 'sqlite') === false && strpos((string) $this->_subdriver, 'sqlite') === false) {
                $this->_database->limit(1);
            }

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                $this->_database->set($this->soft_delete_key_full, TRUE);
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table, array( $this->soft_delete_key_full => TRUE ));
        }
        else
        {
            // See http://www.sqlite.org/compile.html#enable_update_delete_limit
            if (strpos((string) $this->_dbdriver, 'sqlite') === false && strpos((string) $this->_subdriver, 'sqlite') === false) {
                $this->_database->limit(1);
            }

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('delete');
            }

            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        $this->_reset_state();

        return $result;
    }

    /**
     * Delete a row from the database table by an arbitrary WHERE clause
     */
    public function delete_by()
    {
        $where = func_get_args();

        $where = $this->trigger('before_delete', $where);

        $this->_set_where($where);

        if ($this->soft_delete)
        {
            // See http://www.sqlite.org/compile.html#enable_update_delete_limit
            if (strpos((string) $this->_dbdriver, 'sqlite') === false && strpos((string) $this->_subdriver, 'sqlite') === false) {
                $this->_database->limit(1);
            }

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                $this->_database->set($this->soft_delete_key_full, TRUE);
                return $this->_return_sql('update');
            }

            $result = $this->_database
                ->update($this->_table, array( $this->soft_delete_key_full => TRUE ));
        }
        else
        {
            // See http://www.sqlite.org/compile.html#enable_update_delete_limit
            if (strpos((string) $this->_dbdriver, 'sqlite') === false && strpos((string) $this->_subdriver, 'sqlite') === false) {
                $this->_database->limit(1);
            }

            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('delete');
            }

            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        $this->_reset_state();

        return $result;
    }

    /**
     * Delete many rows from the database table by multiple primary values
     */
    public function delete_many($primary_values)
    {
        $primary_values = $this->trigger('before_delete', $primary_values);

        $this->_database->where_in($this->primary_key, $primary_values);

        if ($this->soft_delete)
        {
            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                $this->_database->set($this->soft_delete_key_full, TRUE);
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table, array( $this->soft_delete_key_full => TRUE ));
        }
        else
        {
            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('delete');
            }

            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        $this->_reset_state();

        return $result;
    }

    /**
     * Delete many rows from the database table by an arbitrary WHERE clause
     */
    public function delete_many_by()
    {
        $where = func_get_args();

        $where = $this->trigger('before_delete', $where);

        $this->_set_where($where);

        if ($this->soft_delete)
        {
            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                $this->_database->set($this->soft_delete_key_full, TRUE);
                return $this->_return_sql('update');
            }

            $result = $this->_database->update($this->_table, array( $this->soft_delete_key_full => TRUE ));
        }
        else
        {
            if ($this->qb_as_sql)
            {
                // Return an SQL statement as a result.
                return $this->_return_sql('delete');
            }

            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        $this->_reset_state();

        return $result;
    }

    /**
     * Truncates the table
     */
    public function truncate()
    {
        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.
            return $this->_return_sql('truncate');
        }

        $result = $this->_database->truncate($this->_table);

        $this->_reset_state();

        return $result;
    }

    /* --------------------------------------------------------------
     * RELATIONSHIPS
     * ------------------------------------------------------------ */

    public function with($relationship)
    {
        $this->_with[] = $relationship;

        if (!in_array('relate', $this->after_get))
        {
            $this->after_get[] = 'relate';
        }

        return $this;
    }

    // This observer is to be suppressed by skip_observers() scope too.
    // This might change if there is a good/valid use-case, but let us not
    // complicate code for now.
    public function relate($row)
    {
        if (empty($row))
        {
            return $row;
        }

        foreach ($this->belongs_to as $key => $value)
        {
            if (is_string($value))
            {
                $relationship = $value;
                $options = array( 'primary_key' => $value . '_id', 'model' => $value . '_model' );
            }
            else
            {
                $relationship = $key;
                $options = $value;
            }

            if (in_array($relationship, $this->_with))
            {
                $this->load->model($options['model'], $relationship . '_model');
                if (is_object($row))
                {
                    $row->{$relationship} = $this->{$relationship . '_model'}->get($row->{$options['primary_key']});
                }
                else
                {
                    $row[$relationship] = $this->{$relationship . '_model'}->get($row[$options['primary_key']]);
                }
            }
        }

        foreach ($this->has_many as $key => $value)
        {
            if (is_string($value))
            {
                $relationship = $value;
                $options = array( 'primary_key' => singular($this->_table) . '_id', 'model' => singular($value) . '_model' );
            }
            else
            {
                $relationship = $key;
                $options = $value;
            }

            if (in_array($relationship, $this->_with))
            {
                $this->load->model($options['model'], $relationship . '_model');
                if (is_object($row))
                {
                    $row->{$relationship} = $this->{$relationship . '_model'}->get_many_by($options['primary_key'], $row->{$this->primary_key});
                }
                else
                {
                    $row[$relationship] = $this->{$relationship . '_model'}->get_many_by($options['primary_key'], $row[$this->primary_key]);
                }
            }
        }

        return $row;
    }

    /* --------------------------------------------------------------
     * UTILITY METHODS
     * ------------------------------------------------------------ */

    /**
     * Returns directly a single specified value from the first selected row.
     * Instead of:
     * $user_id = $this->users->select('id')->where('user_id', $user_id)->or_where('email', $email)->as_value()->first();
     * you may write the following simpler expression:
     * $user_id = $this->users->where('username', $username)->or_where('email', $email)->value('id');
     * (username and email are assumed as unique in this example)
     * NULL value is returned if no record has been found.
     */
    public function value($select = '*', $escape = NULL)
    {
        if ($this->_select_called) {

            // If select() was previously called,
            // then ignore the arguments, don't call select() twice.
            return $this->as_value()->first();
        }

        return $this->select($select, $escape)->as_value()->first();
    }

    /**
     * Checks whether a single record based on the primary key exists.
     * @param   mixed    $primary_value
     * @return  boolean
     */
    public function exists($primary_value)
    {
        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        $this->_database->select($this->primary_key)
            ->where($this->primary_key, $primary_value)
            ->limit(1);

        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.
            return $this->_return_sql('select');
        }

        $get = $this->_database
            ->get($this->_table);

        $row = $get
            ? $get->row_array()
            : array();

        $result = isset($row[$this->primary_key]);

        if ($this->_as_json)
        {
            return $this->_return_json($result);
        }

        $this->_reset_state();

        return $result;
    }

    /**
     * Prepares and returns an empty record based on all the existing
     * table fields. The returned result may be an array or an object
     * depending on the model's settings.
     * Triggers 'after_get' observers.
     * If not modified by the obervers, the returned field values are NULL's.
     */
    public function get_empty()
    {
        $row = array_fill_keys($this->fields(), NULL);

        if ($this->_temporary_return_type != 'array')
        {
            $row = (object) $row;
        }

        $row = $this->trigger('after_get', $row);

        if ($this->_as_json)
        {
            return $this->_return_json($row);
        }

        $this->_reset_state();

        return $row;
    }

    /**
     * Retrieve and generate a form_dropdown friendly array
     */
    function dropdown()
    {
        $args = func_get_args();

        if(count($args) == 2)
        {
            list($key, $value) = $args;
        }
        else
        {
            $key = $this->primary_key;
            $value = $args[0];
        }

        $this->trigger('before_dropdown', array( $key, $value ));

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        $this->_database->select(array($key, $value));

        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.
            return $this->_return_sql('select');
        }

        $get = $this->_database
            ->get($this->_table);

        $result = $get
            ? $get->result_array()
            : array();

        if ($this->_function_exists_array_column)
        {
            $options = array_column($result, $value, $key);
        }
        else
        {
            $options = array();

            foreach ($result as $row)
            {
                $options[$row[$key]] = $row[$value];
            }
        }

        $options = $this->trigger('after_dropdown', $options);

        if ($this->_as_json)
        {
            return $this->_return_json($options);
        }

        $this->_reset_state();

        return $options;
    }

    /**
     * Fetch a count of rows based on an arbitrary WHERE call.
     */
    public function count_by()
    {
        $where = func_get_args();
        $this->_set_where($where);

        // Modified by Ivan Tcholakov, 29-MAR-2013.
        /*
        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        return $this->_database->count_all_results($this->_table);
        */

        return $this->count_all();
    }

    /**
     * Fetch a total count of rows.
     */
    public function count_all()
    {
        // Modified by Ivan Tcholakov, 29-MAR-2013.
        /*
        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        return $this->_database->count_all($this->_table);
        */

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key_full, (bool)$this->_temporary_only_deleted);
        }

        if ($this->qb_as_sql)
        {
            // Return an SQL statement as a result.

            $result = ($this->qb_distinct === TRUE)
                ? $this->_count_string.$this->protect_identifiers('numrows')."\nFROM (\n".$this->_database->get_compiled_select($this->_table, true)."\n) CI_count_all_results"
                : $this->_count_string.$this->_database->protect_identifiers('numrows');

            $this->_reset_state();

            return $result;
        }

        $result = $this->_database->count_all_results($this->_table);

        if ($this->_as_json)
        {
            return $this->_return_json($result);
        }

        $this->_reset_state();

        return $result;
    }

    /**
     * An alias of count_all();
     */
    public function count_all_results()
    {
        return $this->count_all();
    }

    /**
     * Tell the class to skip the insert validation
     */
    public function skip_validation()
    {
        $this->skip_validation = TRUE;
        return $this;
    }

    /**
     * Get the skip validation status
     */
    public function get_skip_validation()
    {
        return $this->skip_validation;
    }

    /**
     * Return the next auto increment of the table. Only tested on MySQL.
     */
    public function get_next_id()
    {
        return (int) $this->_database->select('AUTO_INCREMENT')
            ->from('information_schema.TABLES')
            ->where('TABLE_NAME', $this->_table)
            ->where('TABLE_SCHEMA', $this->_database->database)->get()->row()->AUTO_INCREMENT;
    }

    /**
     * A getter for database object.
     */
    public function database()
    {
        return $this->_database;
    }

    /**
     * A setter for database object.
     * Use case example: A cloned query builder may be set on a clone of this model.
     */
    public function set_database($db)
    {
        $this->_database = $db;

        return $this;
    }

    /**
     * Getter for the table name
     */
    public function table()
    {
        return $this->_table;
    }

    /**
     * Getter for the primary key.
     */
    public function primary_key()
    {
        return $this->primary_key;
    }

    /**
     * Returns a list of fields as array of strings of the corresponding table.
     * It queries the database only once and caches the result.
     */
    public function fields()
    {
        if (!is_array($this->_fields))
        {
            $this->_fields = $this->_database->list_fields($this->_table);

            if (empty($this->_fields))
            {
                $this->_fields = array();
            }
        }

        return $this->_fields;
    }

    /**
     * A wrapper to $this->db->list_fields()
     */
    public function list_fields()
    {
        return $this->_database->list_fields($this->_table);
    }

    /**
     * A wrapper to $this->db->field_exists()
     */
    public function field_exists($field_name)
    {
        return $this->_database->field_exists($field_name, $this->_table);
    }

    /**
     * A wrapper to $this->db->field_data()
     */
    public function field_data()
    {
        return $this->_database->field_data($this->_table);
    }

    /**
     * A getter about LIMIT clause.
     */
    public function get_limit()
    {
        return $this->_limit;
    }

    /**
     * A getter about OFFSET clause.
     */
    public function get_offset()
    {
        return $this->_offset;
    }

    /* --------------------------------------------------------------
     * GLOBAL SCOPES
     * ------------------------------------------------------------ */

    /**
     * Return the next call as an array rather than an object
     */
    public function as_array()
    {
        $this->_temporary_return_type = 'array';
        return $this;
    }

    /**
     * Return the next call as an object rather than an array
     */
    public function as_object()
    {
        $this->_temporary_return_type = 'object';
        return $this;
    }

    /**
     * Don't care about soft deleted rows on the next call
     */
    public function with_deleted($enabled = TRUE)
    {
        $this->_temporary_with_deleted = (bool) $enabled;
        return $this;
    }

    /**
     * Only get deleted rows on the next call
     */
    public function only_deleted($enabled = TRUE)
    {
        $this->_temporary_only_deleted = (bool) $enabled;
        return $this;
    }

    /**
     * Converts the return row into a value (extracts the first column).
     */
    public function as_value()
    {
        $this->qb_as_value = TRUE;
        return $this;
    }

    /**
     * Forces returning compiled SQL statement(s) as a result.
     * This scope is intended for debugging purposes.
     */
    public function as_sql()
    {
        $this->qb_as_sql = TRUE;
        return $this;
    }

    /**
     * Forces returning JSON encoded data as a result.
     * @param int $options  Same parameter as in json_encode() function (PHP >= 5.3.0)
     * @link http://php.net/manual/en/function.json-encode.php
     * @link http://php.net/manual/en/json.constants.php
     */
    public function as_json($options = 0)
    {
        $this->_as_json = TRUE;
        $this->_as_json_options = $options;
        return $this;
    }

    /**
     * Disables triggering of all the attached/registered observers.
     */
    public function skip_observers()
    {
        $this->_temporary_skip_observers = TRUE;
        return $this;
    }

    /* --------------------------------------------------------------
     * OBSERVERS
     * ------------------------------------------------------------ */

    /**
     * For supporting the observers below, the table definition should
     * contatin a part of or all the following definitions (MySQL sysntax),
     * depending on which observers you choose to use:
     *  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
     *  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
     *  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
     *  `updated_by` int(11) unsigned NOT NULL DEFAULT '0',
     *  `deleted` tinyint(1) NOT NULL DEFAULT '0',
     *  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
     *  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
     */

    /**
     * A timestamp observer, 'before_create' only.
     */
    public function created_at($row)
    {
        if (is_object($row))
        {
            $row->created_at = date('Y-m-d H:i:s');
        }
        else
        {
            $row['created_at'] = date('Y-m-d H:i:s');
        }

        return $row;
    }

    /**
     * A timestamp observer, 'before_create' and 'before_update' only.
     */
    public function updated_at($row)
    {
        if (is_object($row))
        {
            $row->updated_at = date('Y-m-d H:i:s');
        }
        else
        {
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        return $row;
    }

    /**
     * A timestamp observer, 'before_delete' only.
     */
    public function deleted_at($parameter)
    {
        if ($this->soft_delete)
        {
            $this->_database->set($this->_table.'.'.'deleted_at', date('Y-m-d H:i:s'));
        }
    }

    /**
     * A user identification observer, 'before_create' only.
     */
    public function created_by($row)
    {
        if (is_object($row))
        {
            $row->created_by = $this->_get_user_id();
        }
        else
        {
            $row['created_by'] = $this->_get_user_id();
        }

        return $row;
    }

    /**
     * A user identification observer, 'before_create' and 'before_update' only.
     */
    public function updated_by($row)
    {
        if (is_object($row))
        {
            $row->updated_by = $this->_get_user_id();
        }
        else
        {
            $row['updated_by'] = $this->_get_user_id();
        }

        return $row;
    }

    /**
     * A user identification observer, 'before_delete' only.
     */
    public function deleted_by($parameter)
    {
        if ($this->soft_delete)
        {
            $this->_database->set($this->_table.'.'.'deleted_by', $this->_get_user_id());
        }
    }

    /**
     * Serialises data for you automatically, allowing you to pass
     * through objects and let it handle the serialisation in the background
     */
    public function serialize($row)
    {
        foreach ($this->callback_parameters as $column)
        {
            $row[$column] = serialize($row[$column]);
        }

        return $row;
    }

    public function unserialize($row)
    {
        foreach ($this->callback_parameters as $column)
        {
            if (is_array($row))
            {
                $row[$column] = unserialize($row[$column]);
            }
            else
            {
                $row->$column = unserialize($row->$column);
            }
        }

        return $row;
    }

    /**
     * Protect attributes by removing them from $row array
     */
    public function protect_attributes($row)
    {
        foreach ($this->protected_attributes as $attr)
        {
            if (is_object($row))
            {
                unset($row->$attr);
            }
            else
            {
                unset($row[$attr]);
            }
        }

        return $row;
    }

    /*
     * Removes non-existent (within the table) fields from input data.
     * Currently works with array-type input data only.
     */
    public function existing_fields_only($row)
    {
        if (is_array($row))
        {
            // See array_only() function in Laravel.
            $row = array_intersect_key($row, array_flip((array) $this->fields()));
        }

        return $row;
    }

    /* --------------------------------------------------------------
     * QUERY BUILDER DIRECT ACCESS METHODS
     * ------------------------------------------------------------ */

    /**
     * A wrapper to $this->_database->order_by()
     */
    public function order_by($criteria, $order = '', $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            if ( is_array($criteria) )
            {
                foreach ($criteria as $key => $value)
                {
                    $this->_database->order_by($key, $value, $escape);
                }
            }
            else
            {
                $this->_database->order_by($criteria, $order, $escape);
            }
        }
        else
        {
            if ( is_array($criteria) )
            {
                foreach ($criteria as $key => $value)
                {
                    $this->_database->order_by($key, $value);
                }
            }
            else
            {
                $this->_database->order_by($criteria, $order);
            }
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->limit()
     */
    public function limit($limit, $offset = 0)
    {
        if ($limit < 0)
        {
            $limit = FALSE;
        }

        $this->_limit = $limit;

        if ($limit === FALSE)
        {
            $limit = PHP_INT_MAX;
        }

        if (!empty($offset))
        {
            $this->_offset = (int) $offset;
        }

        if (!$this->_is_ci_3)
        {
            // Adjust the default value of $offset to match the definition in CI 2.x.
            $offset = empty($offset) ? '' : $offset;
        }

        $this->_database->limit($limit, $offset);
        return $this;
    }

    /**
     * A wrapper to $this->_database->offset()
     */
    public function offset($offset)
    {
        $this->_offset = $offset;

        if (empty($offset))
        {
            $this->_offset = FALSE;
            $offset = '00';
        }

        $this->_database->offset($offset);
        return $this;
    }

    /**
     * A wrapper to $this->_database->select()
     */
    public function select($select = '*', $escape = NULL)
    {
        $this->_database->select($select, $escape);
        $this->_select_called = TRUE;

        return $this;
    }

    /**
     * A wrapper to $this->_database->distinct()
     */
    public function distinct($val = TRUE)
    {
        $this->qb_distinct = is_bool($val) ? $val : TRUE;
        $this->_database->distinct($val);
        return $this;
    }

    /**
     * A wrapper to $this->_database->join()
     */
    public function join($table, $cond, $type = '', $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->join($table, $cond, $type, $escape);
        }
        else
        {
            $this->_database->join($table, $cond, $type);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->escape()
     */
    public function escape($str)
    {
        return $this->_database->escape($str);
    }

    /**
     * A wrapper to $this->_database->escape_like_str()
     */
    public function escape_like_str($str)
    {
        return $this->_database->escape_like_str($str);
    }

    /**
     * A wrapper to $this->_database->escape_str()
     */
    public function escape_str($str, $like = FALSE)
    {
        return $this->_database->escape_str($str, $like);
    }

    /**
     * A wrapper to $this->_database->where()
     */
    public function where($key, $value = NULL, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);
        $this->_database->where($key, $value, $escape);
        return $this;
    }

    /**
     * A wrapper to $this->_database->or_where()
     */
    public function or_where($key, $value = NULL, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);
        $this->_database->or_where($key, $value, $escape);
        return $this;
    }

    /**
     * A wrapper to $this->_database->where_in()
     */
    public function where_in($key = NULL, $values = NULL, $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->where_in($key, $values, $escape);
        }
        else
        {
            $this->_database->where_in($key, $values);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->or_where_in()
     */
    public function or_where_in($key = NULL, $values = NULL, $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->or_where_in($key, $values, $escape);
        }
        else
        {
            $this->_database->or_where_in($key, $values);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->where_not_in()
     */
    public function where_not_in($key = NULL, $values = NULL, $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->where_not_in($key, $values, $escape);
        }
        else
        {
            $this->_database->where_not_in($key, $values);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->or_where_not_in()
     */
    public function or_where_not_in($key = NULL, $values = NULL, $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->or_where_not_in($key, $values, $escape);
        }
        else
        {
            $this->_database->or_where_not_in($key, $values);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->like()
     */
    public function like($field, $match = '', $side = 'both', $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->like($field, $match, $side, $escape);
        }
        else
        {
            $this->_database->like($field, $match, $side);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->not_like()
     */
    public function not_like($field, $match = '', $side = 'both', $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->not_like($field, $match, $side, $escape);
        }
        else
        {
            $this->_database->not_like($field, $match, $side);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->or_like()
     */
    public function or_like($field, $match = '', $side = 'both', $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->or_like($field, $match, $side, $escape);
        }
        else
        {
            $this->_database->or_like($field, $match, $side);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->or_not_like()
     */
    public function or_not_like($field, $match = '', $side = 'both', $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->or_not_like($field, $match, $side, $escape);
        }
        else
        {
            $this->_database->or_not_like($field, $match, $side);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->group_start()
     */
    public function group_start($not = '', $type = 'AND ')
    {
        if ($this->_is_ci_3)
        {
            $this->_database->group_start($not, $type);
        }
        else
        {
            die('DB::group_start() is not supported. Use CodeIgniter 3.0.0 or higher.');
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->or_group_start()
     */
    public function or_group_start()
    {
        if ($this->_is_ci_3)
        {
            $this->_database->or_group_start();
        }
        else
        {
            die('DB::or_group_start() is not supported. Use CodeIgniter 3.0.0 or higher.');
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->not_group_start()
     */
    public function not_group_start()
    {
        if ($this->_is_ci_3)
        {
            $this->_database->not_group_start();
        }
        else
        {
            die('DB::not_group_start() is not supported. Use CodeIgniter 3.0.0 or higher.');
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->or_not_group_start()
     */
    public function or_not_group_start()
    {
        if ($this->_is_ci_3)
        {
            $this->_database->or_not_group_start();
        }
        else
        {
            die('DB::or_not_group_start() is not supported. Use CodeIgniter 3.0.0 or higher.');
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->group_end()
     */
    public function group_end()
    {
        if ($this->_is_ci_3)
        {
            $this->_database->group_end();
        }
        else
        {
            die('DB::group_end() is not supported. Use CodeIgniter 3.0.0 or higher.');
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->group_by()
     */
    public function group_by($by, $escape = NULL)
    {
        if ($this->_is_ci_3)
        {
            $this->_database->group_by($by, $escape);
        }
        else
        {
            $this->_database->group_by($by);
        }

        return $this;
    }

    /**
     * A wrapper to $this->_database->having()
     */
    public function having($key, $value = NULL, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);
        $this->_database->having($key, $value, $escape);
        return $this;
    }

    /**
     * A wrapper to $this->_database->or_having()
     */
    public function or_having($key, $value = NULL, $escape = NULL)
    {
        $escape = $this->_check_default_escape($escape);
        $this->_database->having($key, $value, $escape);
        return $this;
    }

    /**
     * A wrapper to $this->_database->table_exists()
     */
    public function table_exists($table_name = NULL)
    {
        $table_name = (string) $table_name;

        if ($table_name == '')
        {
            $table_name = $this->_table;
        }

        if (!isset($this->_database) || !is_object($this->_database))
        {
            return FALSE;
        }

        return $this->_database->table_exists($table_name);
    }

    /**
     * A wrapper to CodeIgniter 3 $this->_database->reset_query()
     */
    public function reset_query() {

        if ($this->_is_ci_3) {
            $this->_database->reset_query();
        }

        $this->_reset_state();

        return $this;
    }

    /* --------------------------------------------------------------
     * I18N
     * ------------------------------------------------------------ */

    /**
     * Read @link http://www.apphp.com/tutorials/index.php?page=multilanguage-database-design-in-mysql
     * "Multilanguage Database Design in MySQL" by Leumas Naypoka
     * "4. Additional Translation Table Approach"
     */

    /**
     * Gets translated string from the specified field by the specified primary key value from this table.
     * @deprecated Use lang() method instead.
     *
     * @param int           $primary_value              The primary key value from the table, associated with this model.
     * @param string/array  $field                      The target translated field, or an array of target field names.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @param boolean       $with_translation_fallback  Turn on/off translation fallback.
     * @param string        $fall_back_template         A template for the returned value if fallback translation fails. Example: '{field} #{id}'
     * @return string/array                             Returns the translated string or an associative array of translated strings.
     */
    public function get_lang($primary_value, $field, $language = null, $with_translation_fallback = true, $fall_back_template = null) {

        return $this->lang_model->lang($primary_value, $field, $language, $with_translation_fallback, $fall_back_template);
    }

    /**
     * Gets translated string from the specified field by the specified primary key value from this table.
     * See Core_Lang_Model.
     *
     * @param int           $primary_value              The primary key value from the table, associated with this model.
     * @param string/array  $field                      The target translated field, or an array of target field names.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @param boolean       $with_translation_fallback  Turn on/off translation fallback.
     * @param string        $fall_back_template         A template for the returned value if fallback translation fails. Example: '{field} #{id}'
     * @return string/array                             Returns the translated string or an associative array of translated strings.
     */
    public function lang($primary_value, $field, $language = null, $with_translation_fallback = false, $fall_back_template = null) {

        return $this->lang_model->lang($primary_value, $field, $language, $with_translation_fallback, $fall_back_template);
    }

    /**
     * Sets translated string on the specified field at tthe specified primary key value from this table.
     * An associated array of strings can be set too.
     * See Core_Lang_Model.
     *
     * @param int           $primary_value              The primary key value from the table, associated with this model.
     * @param string/array  $field                      The target translated field, or an array of target field names.
     * @param string        $value                      The string in correspondent language.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @return object                                   Returns this instance.
     */
    public function set_lang($primary_value, $field, $value = null, $language = null) {

        $this->lang_model->set_lang($primary_value, $field, $value, $language);

        return $this;
    }

    /**
     * Deletes a whole translation, specified primary key value from this table and language.
     * See Core_Lang_Model.
     *
     * @param int           $primary_value              The primary key value from the table, associated with this model.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @return object                                   Returns this instance.
     */
    public function delete_lang($primary_value, $language = null) {

        $this->lang_model->delete_lang($primary_value, $language);

        return $this;
    }

    /**
     * Deletes all the translations, specified primary key value from this table.
     * See Core_Lang_Model.
     *
     * @param int           $primary_value              The primary key value from the table, associated with this model.
     * @return object                                   Returns this instance.
     */
    public function delete_langs($primary_value) {

        $this->lang_model->delete_langs($primary_value);

        return $this;
    }

    /**
     * Checks whether a translation exists, specified primary key value from this table and language.
     * See Core_Lang_Model.
     *
     * @param int           $primary_value              The primary key value from the table, associated with this model.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @return boolean
     */
    public function lang_exists($primary_value, $language = null) {

        return $this->lang_model->lang_exists($primary_value, $language);
    }

    /* --------------------------------------------------------------
     * INTERNAL METHODS
     * ------------------------------------------------------------ */

    /**
     * Trigger an event and call its observers. Pass through the event name
     * (which looks for an instance variable $this->event_name), an array of
     * parameters to pass through and an optional 'last in interation' boolean
     */
    public function trigger($event, $data = FALSE, $last = TRUE)
    {
        if (!$this->_temporary_skip_observers && isset($this->$event) && is_array($this->$event))
        {
            foreach ($this->$event as $method)
            {
                if (strpos((string) $method, '('))
                {
                    preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', (string) $method, $matches);

                    $method = $matches[1];
                    $this->callback_parameters = explode(',', $matches[3]);
                }

                $data = call_user_func_array(array($this, $method), array($data, $last));
            }
        }

        return $data;
    }

    /**
     * Run validation on the passed data
     */
    public function validate($data)
    {
        if ($this->skip_validation)
        {
            return $data;
        }

        if (!empty($this->validate))
        {
            foreach($data as $key => $val)
            {
                $_POST[$key] = $val;
            }

            $this->load->library('form_validation');

            if (is_array($this->validate))
            {
                $this->form_validation->set_rules($this->validate);

                if ($this->form_validation->run() === TRUE)
                {
                    return $data;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                if ($this->form_validation->run($this->validate) === TRUE)
                {
                    return $data;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return $data;
        }
    }

    /**
     * Guess the table name by pluralising the model name
     */
    private function _fetch_table()
    {
        if ($this->_table == NULL)
        {
            $this->_table = plural(preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this))));
        }
    }

    /**
     * Establish the database connection.
     */
    private function _set_database()
    {
        if (!class_exists('CI_DB', FALSE))
        {
            // There is no connection. Skip silently.
            // Possibly specific requests do not require database connection.
            return;
        }

        // Was a DB group specified by the user?
        if (isset($this->_db_group))
        {
            $this->_database = $this->load->database($this->_db_group, TRUE, TRUE);
        }
        // No DB group specified, use the default connection.
        else
        {
            $db = @ get_instance()->db;

            // Has the default connection been loaded yet?
            if ( ! isset($db) OR ! is_object($db) OR empty($db->conn_id))
            {
                get_instance()->load->database('', FALSE, TRUE);
            }

            $this->_database = get_instance()->db;
        }
    }

    /**
     * Set WHERE parameters, cleverly
     */
    protected function _set_where($params = NULL)
    {
        if (empty($params) || is_object($params))
        {
            return;
        }

        if (count($params) == 1)
        {
            $this->_database->where($params[0]);
        }
        elseif (count($params) == 2)
        {
            $this->_database->where($params[0], $params[1]);
        }
        elseif (count($params) == 3)
        {
            $this->_database->where($params[0], $params[1], $params[2]);
        }
        else
        {
            $this->_database->where($params);
        }
    }

    /**
     * Return the method name for the current return type
     */
    protected function _return_type($multi = FALSE)
    {
        $method = ($multi) ? 'result' : 'row';
        return $this->_temporary_return_type == 'array' ? $method . '_array' : $method;
    }

    /**
     * Returns a singe value (the first column) from a given result row.
     */
    protected function _return_value(& $row)
    {
        $result = NULL;

        if (is_array($row))
        {
            if (!empty($row))
            {
                reset($row);
                $result = current($row);
            }
        }
        elseif (is_object($row))
        {
            $row_array = get_object_vars($row);
            if (!empty($row_array))
            {
                $result = current($row_array);
            }
        }

        if ($this->_as_json)
        {
            return $this->_return_json($result);
        }

        $this->_reset_state();

        return $result;
    }

    protected function _return_json(& $data)
    {
        $as_json_options = $this->_as_json_options;

        $this->_reset_state();

        return json_encode($data, $as_json_options);
    }

    /**
     * Returns a compiled SQL statement based on the current Query Builder state.
     * Also resets the Query Builder state and the internal state of this class.
     */
    protected function _return_sql($sql_type)
    {
        $this->_reset_state();

        switch ($sql_type)
        {
            case 'select':

                return $this->_database->get_compiled_select($this->_table, true);

            case 'insert':

                return $this->_database->get_compiled_insert($this->_table, true);

            case 'update':

                return $this->_database->get_compiled_update($this->_table, true);

            case 'delete':

                return $this->_database->get_compiled_delete($this->_table, true);

            case 'truncate':

                if ($this->_is_ci_3)
                {
                    return 'TRUNCATE '.$this->_database->protect_identifiers($this->_table, TRUE, NULL, FALSE);
                }

                return 'TRUNCATE '.$this->_database->protect_identifiers($this->_table, TRUE);
        }

        return NULL;
    }

    /**
     * Returns CI major version dependent default value for the $escape parameter.
     * As of CI 3.0.0 the QB's method definition has been changed into:
     * public function set($key, $value = '', $escape = NULL)
     */
    protected function _check_default_escape($escape)
    {
        if ($this->_is_ci_3)
        {
            return $escape;
        }

        if (is_null($escape))
        {
            return TRUE;
        }

        return $escape;
    }

    /**
     * Resets all internal state flags and temporary scope data.
     */
    protected function _reset_state()
    {
        $this->_with = array();
        $this->_temporary_return_type = $this->return_type;
        $this->_temporary_with_deleted = FALSE;
        $this->_temporary_only_deleted = FALSE;
        $this->qb_as_value = FALSE;
        $this->qb_as_sql = FALSE;
        $this->qb_distinct = FALSE;
        $this->_as_json = FALSE;
        $this->_as_json_options = 0;
        $this->_temporary_skip_observers = FALSE;
        $this->_select_called = FALSE;
        $this->_limit = FALSE;
        $this->_offset = FALSE;
    }

    /**
     * Returns the current user ID.
     */
    protected function _get_user_id()
    {
        if (is_callable($this->user_id_getter))
        {
            return is_array($this->user_id_getter)
                ? $this->user_id_getter[0]->{$this->user_id_getter[1]}()
                : call_user_func($this->user_id_getter);
        }

        return NULL;
    }

    // --------------------------------------------------------------

    /**
     * Customizations by Xavier Perez
     * @link https://bitbucket.org/xperez/codeigniter-cross-modular-extensions-xhmvc
     * @link http://www.4amics.com/x.perez/2013/06/xhmvc-common-modular-extensions/
     */

    /**
     * Get properties from the common module, otherwise, from $APP
     *
     * @param type $myVar
     * @return var
     * @throws Exception
     */
    public function __get($myVar)
    {
        if (isset($this->common_module_extender) && (isset($this->common_module_extender->$myVar) || property_exists($this->common_module_extender, $myVar)))
        {
            return $this->common_module_extender->$myVar;
        }

        if (isset(CI::$APP->$myVar) || property_exists(CI::$APP, $myVar))
        {
            return CI::$APP->$myVar;
        }

        throw new Exception('Core_Model: There is no such property: ' . $myVar);
    }

    /**
     * Set properties to a var inside the common module, only if exists
     *
     * @param type $myVar
     * @param type $myValue
     */
    public function __set($myVar, $myValue = '')
    {
        if (isset($this->common_module_extender) && (isset($this->common_module_extender->$myVar) || property_exists($this->common_module_extender, $myVar)))
        {
            $this->common_module_extender->$myVar = $myValue;
        }
        else
        {
            CI::$APP->$myVar = $myValue;
        }
    }

    /**
     * Call any method inside common module, else call $APP method
     *
     * @param type $name
     * @param array $arguments
     * @return type
     * @throws Exception
     */
    public function __call($name, array $arguments)
    {
        if (method_exists($this->common_module_extender, $name))
        {
            return call_user_func_array(array($this->common_module_extender, $name), $arguments);
        }

        if (method_exists(CI::$APP, $name))
        {
            return call_user_func_array(array(CI::$APP, $name), $arguments);
        }

        throw new Exception('Core_Model:There is no such method: ' . $name);
    }

    /**
     * Common module extender.
     *
     * Usage example:
     *
     * // File: platform/applications/site/models/News.php
     * class News extends Core_Model
     * {
     *     public function __construct()
     *     {
     *         parent::__construct();
     *         // Use this call to load an existing model in common/modules/[module]/models
     *         // with same name as the current.
     *         $this->common_module_loader(__CLASS__, __FILE__);
     *     }
     * }
     *
     * // File: platform/core/common/models/News.php
     * class News extends Core_Model
     * {
     *     protected $check_for_existing_fields = true;
     *     public $protected_attributes = array('id');
     *     protected $_table = 'news';
     *     protected $return_type = 'array';
     *     public function __construct()
     *     {
     *         parent::__construct();
     *     }
     * }
     *
     * @param type $class
     * @param type $module
     * @param type $params
     */
    public function common_module_loader($class, $module = '', $params = '')
    {
        $currentPath = $module;
        $currentPath = str_replace('\\', '/', $currentPath);

        $appPath = str_replace('\\', '/', realpath(APPPATH));
        $commonPath = str_replace('\\', '/', realpath(COMMONPATH));

        $currentPath = str_replace($appPath, $commonPath, $currentPath);

        if (file_exists($currentPath))
        {
            $moduleExtends = file_get_contents($currentPath);
            $moduleExtends = str_ireplace('class '.$class, 'class '.ucfirst($class).'_common', $moduleExtends);
            $moduleExtends = preg_replace("/<\?php|<\?|\?>/", '', $moduleExtends);
            eval($moduleExtends);

            $newclass = ucfirst($class).'_common';
            $this->common_module_extender = new $newclass($params);

            // Added by Ivan Tcholakov, 26-NOV-2013.
            // Transfer parent object properties to the current one.
            foreach (get_object_vars($this->common_module_extender) as $name => $value)
            {
                $this->$name = $value;
            }
            //
        }
    }

}
