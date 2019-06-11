<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Disputes_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'disputes';
    }
	
	function get_all($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE id > '0'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_list_dispute($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC', $user = NULL)
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE claimant = '{$user}' OR defendant = '{$user}'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_detail_dispute($id = NULL, $username = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE (id = " . $this->db->escape($id) . " AND claimant = " . $this->db->escape($username) . ") OR (id = " . $this->db->escape($id) . " AND defendant = " . $this->db->escape($username) . ")
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_user_close_dispute($id = NULL, $username = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE id = " . $this->db->escape($id) . " AND claimant = " . $this->db->escape($username) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_open_claims($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '2'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_open_disputes($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '1'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_rejected_disputes($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '3'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_satisfied_disputes($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '4'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_total_disputes() 
	{
		$s= $this->db->select("COUNT(*) as num")->get("disputes");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	function get_disputes($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE id = " . $this->db->escape($id) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	/**
     * Edit dispute
     *
     * @param  array $data
     * @return boolean
     */
    function edit_dispute($data = array())
    {
        if ($data)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
                    time_transaction = " . $this->db->escape($data['time_transaction']) . ",
										time_dispute = " . $this->db->escape($data['time_dispute']) . ",
                    claimant = " . $this->db->escape($data['claimant']) . ",
										sum = " . $this->db->escape($data['sum']) . ",
										amount = " . $this->db->escape($data['amount']) . ",
										fee = " . $this->db->escape($data['fee']) . ",
                    defendant = " . $this->db->escape($data['defendant']) . "
                WHERE id = " . $this->db->escape($data['id']) . "
            ";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }
	
	function get_log_comment($id) 
	{
		return $this->db->where("id_dispute", $id)->order_by('id', 'ASC')->get("disputes_comment");
	}
	
	function add_admin_comment($data) 
	{
		$this->db->insert("disputes_comment", $data);
		return $this->db->insert_id();
	}
	
	function add_dispute($data) 
	{
		$this->db->insert("disputes", $data);
		return $this->db->insert_id();
	}
	
	/**
     * Update disput
     *
     * @param  array $data
     * @return boolean
     */
	function update_dispute($id, $data) {
		$this->db->where("ID", $id)->update("disputes", $data);
	}
	
	/**
     * Add notification comment
     *
     * @param  array $data
     * @return boolean
     */
	function new_comment($data)
	{
		$this->db->insert("disputes_comment", $data);
		return $this->db->insert_id();
	}
	
	function get_history_dispute($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE (transaction = " . $this->db->escape($id) . ")
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	

}