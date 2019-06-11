<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {

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
        $this->_db = 'transactions';
				$this->_db_sci = 'btc_order';
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
	
	function get_history($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC', $user = NULL)
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE sender = '{$user}' OR receiver = '{$user}'
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
	
	function get_pending($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
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
	
	function get_confirmed($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
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
	
	function get_disputed($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
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
	
	function get_blocked($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '5'
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
	
	function get_refunded($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
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
	
	function get_total_transactions() 
	{
		$s= $this->db->select("COUNT(*) as num")->get("transactions");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	function get_transactions($id = NULL)
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
	
	function get_chain($user_comment = NULL)
    {
        if ($user_comment)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE user_comment = " . $this->db->escape($user_comment) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_chain_sci($adress = NULL)
    {
        if ($adress)
        {
            $sql = "
                SELECT *
                FROM btc_order
                WHERE adress = " . $this->db->escape($adress) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_adress($adress = NULL)
    {
        if ($adress)
        {
            $sql = "
                SELECT *
                FROM {$this->_db_sci}
                WHERE adress = " . $this->db->escape($adress) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function delete_order($adress) {
		$this->db->where("adress", $adress)->delete("btc_order");
	}
	
	function get_detail_transactions($id = NULL, $username = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE (id = " . $this->db->escape($id) . " AND sender = " . $this->db->escape($username) . ") OR (id = " . $this->db->escape($id) . " AND receiver = " . $this->db->escape($username) . ")
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_detail_btc_order($adress = NULL)
    {
        if ($adress)
        {
            $sql = "
                SELECT *
                FROM {$this->_db_sci}
                WHERE adress = " . $this->db->escape($adress) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_detail_btc_transactions($user_comment = NULL, $username = NULL)
    {
        if ($user_comment)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE (user_comment = " . $this->db->escape($user_comment) . " AND sender = " . $this->db->escape($username) . ") OR (user_comment = " . $this->db->escape($user_comment) . " AND receiver = " . $this->db->escape($username) . ")
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_start_dispute($id = NULL, $username = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE id = " . $this->db->escape($id) . " AND sender = " . $this->db->escape($username) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	public function update_transactions($data) 
	{
		$this->db->where("id", $this->db->escape($data['id']))->update("transactions", $data);
	}
	
	function update_btc_transactions($transaction, $data) {
		$this->db->where("ID", $transaction)->update("transactions", $data);
	}
	
	function update_dispute_transactions($transaction, $data) {
		$this->db->where("ID", $transaction)->update("transactions", $data);
	}
	
	function add_transaction($data) 
	{
		$this->db->insert("transactions", $data);
		return $this->db->insert_id();
	}
	
	function get_detail_sci_transactions($badge_sci = NULL)
    {
        if ($badge_sci)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE admin_comment = " . $this->db->escape($badge_sci) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function add_order($data) 
	{
		$this->db->insert("btc_order", $data);
		return $this->db->insert_id();
	}
	
	function get_log_transactions() 
	{
		return $this->db->where("status", "1")->order_by('id', 'DESC')->limit(5)->get("transactions");
	}
	
	/**
     * Edit transaction
     *
     * @param  array $data
     * @return boolean
     */
    function edit_transaction($data = array())
    {
        if ($data)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
                    type = " . $this->db->escape($data['type']) . ",
										time = " . $this->db->escape($data['time']) . ",
										sum = " . $this->db->escape($data['sum']) . ",
                    fee = " . $this->db->escape($data['fee']) . ",
                    amount = " . $this->db->escape($data['amount']) . ",
                    status = " . $this->db->escape($data['status']) . ",
                    sender = " . $this->db->escape($data['sender']) . ",
                    receiver = " . $this->db->escape($data['receiver']) . ",
                    user_comment = " . $this->db->escape($data['user_comment']) . ",
                    admin_comment = " . $this->db->escape($data['admin_comment']) . "
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
	
	/**
     * Save generated CAPTCHA to database
     *
     * @param  array $data
     * @return boolean
     */
    public function save_captcha($data = array())
    {
        // CAPTCHA data required
        if ($data)
        {
            // insert CAPTCHA
            $query = $this->db->insert_string('captcha', $data);
            $this->db->query($query);

            // return
            return TRUE;
        }

        return FALSE;
    }


    /**
     * Verify CAPTCHA
     *
     * @param  string $captcha
     * @return boolean
     */
    public function verify_captcha($captcha = NULL)
    {
        // CAPTCHA string required
        if ($captcha)
        {
            // remove old CAPTCHA
            $expiration = time() - 7200; // 2-hour limit
            $this->db->query("DELETE FROM captcha WHERE captcha_time < {$expiration}");

            // build query
            $sql = "
                SELECT
                    COUNT(*) AS count
                FROM captcha
                WHERE word = " . $this->db->escape($captcha) . "
                    AND ip_address = '" . $this->input->ip_address() . "'
            ";

            // execute query
            $query = $this->db->query($sql);

            // return results
            if ($query->row()->count > 0)
            {
                return TRUE;
            }
        }

        return FALSE;
    }
	
	function delete_captcha($captcha) {
		$this->db->where("word", $captcha)->delete("captcha");
	}

}