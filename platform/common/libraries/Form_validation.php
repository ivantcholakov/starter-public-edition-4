<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_validation extends CI_Form_validation {

    public $CI; // See https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home

    public function __construct($rules = array()) {

        parent::__construct($rules);

        $this->CI->load->helper('checkbox');
        $this->CI->load->helper('email');
    }


    // ---------------------------------------------------------------------
    // Bug fixing, see
    // http://www.mahbubblog.com/php/form-validation-callbacks-in-hmvc-in-codeigniter/
    // ---------------------------------------------------------------------

    public function run($module = '', $group = '') {

        (is_object($module)) AND $this->CI = &$module;
        return parent::run($group);
    }


    // The following method has been taken form CodeIgniter 2.2 for backward compatibility about
    // a very specific case "foo[1]". See https://github.com/bcit-ci/CodeIgniter/issues/3816
    /**
     * Traverse a multidimensional $_POST array index until the data is found
     *
     * @access      private
     * @param       array
     * @param       array
     * @param       integer
     * @return      mixed
     */
    protected function _reduce_array($array, $keys, $i = 0)
    {
        if (is_array($array))
        {
            if (isset($keys[$i]))
            {
                if (isset($array[$keys[$i]]))
                {
                    $array = $this->_reduce_array($array[$keys[$i]], $keys, ($i+1));
                }
                else
                {
                    return NULL;
                }
            }
            else
            {
                return $array;
            }
        }

        return $array;
    }

    // Added by Ivan Tcholakov, 20-OCT-2015.
    /**
     * Informs whether there is at least one error after validation.
     * @return bool     TRUE if there is an error (or errors), FALSE otherwise.
     */
    public function has_error()
    {
        return count($this->_error_array) !== 0;
    }

    // ---------------------------------------------------------------------
    // Reworked validation rules.
    // ---------------------------------------------------------------------

    public function valid_email($str) {

        return valid_email($str);
    }

    public function min_length($str, $val) {

        if (!is_numeric($val)) {
            return false;
        } else {
            $val = (int) $val;
        }

        return IS_UTF8_CHARSET
            ? ($val <= UTF8::strlen($str))
            : ($val <= strlen($str));
    }

    public function max_length($str, $val) {

        if (!is_numeric($val)) {
            return false;
        } else {
            $val = (int) $val;
        }

        return IS_UTF8_CHARSET
            ? ($val >= UTF8::strlen($str))
            : ($val >= strlen($str));
    }

    public function exact_length($str, $val) {

        if (!is_numeric($val)) {
            return false;
        } else {
            $val = (int) $val;
        }

        return IS_UTF8_CHARSET
            ? (UTF8::strlen($str) === $val)
            : (strlen($str) === $val);
    }

    public function prep_url($str = '') {

        // Added by Ivan Tcholakov, 08-DEC-2011.
        $str = str_ireplace('http://', 'http://', $str);
        $str = str_ireplace('https://', 'https://', $str);
        //

        if ($str == 'http://' OR $str == '') {
            return '';
        }

        if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://') {
            $str = 'http://'.$str;
        }

        return $str;
    }


    // ---------------------------------------------------------------------
    // Added validation rules.
    // ---------------------------------------------------------------------

    /**
     * XSS Clean
     * @deprecated  Removed since CodeIgniter 3.0, kept here for backward compatibility.
     *
     * @param       string
     * @return      string
     */
    public function xss_clean($str)
    {
        return $this->CI->security->xss_clean($str);
    }

    // The following rule has been "borrowed" from
    // Bonfire application starter, http://cibonfire.com/
    /**
     * Checks that a value is unique in the database.
     *
     * i.e. '…|required|unique[users.name,users.id]|trim…'
     *
     * <code>
     * "unique[tablename.fieldname,tablename.(primaryKey-used-for-updates)]"
     * </code>
     *
     * @author Adapted from Burak Guzel <http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/>
     *
     * @param mixed $value  The value to be checked.
     * @param mixed $params The table and field to check against, if a second
     * field is passed in this is used as "AND NOT EQUAL".
     *
     * @return bool True if the value is unique for that field, else false.
     */
    public function unique($value, $params)
    {
        // Allow for more than 1 parameter.
        $fields = explode(',', $params);

        // Extract the table and field from the first parameter.
        list($table, $field) = explode('.', $fields[0], 2);

        // Setup the db request.
        $this->CI->db->select($field)
                     ->from($table)
                     ->where($field, $value)
                     ->limit(1);

        // Check whether a second parameter was passed to be used as an
        // "AND NOT EQUAL" where clause
        // eg "select * from users where users.name='test' AND users.id != 4
        if (isset($fields[1])) {
            // Extract the table and field from the second parameter
            list($where_table, $where_field) = explode('.', $fields[1], 2);

            // Get the value from the post's $where_field. If the value is set,
            // add "AND NOT EQUAL" where clause.
            $where_value = $this->CI->input->post($where_field);
            if (isset($where_value)) {
                $this->CI->db->where("{$where_table}.{$where_field} <>", $where_value);
            }
        }

        // If any rows are returned from the database, validation fails
        $query = $this->CI->db->get();
        if ($query->row()) {
            //$this->CI->form_validation->set_message('unique', lang('bf_form_unique'));
            $this->CI->form_validation->set_message('unique', $this->CI->lang->line('form_validation_is_unique'));
            return false;
        }

        return true;
    }

}
