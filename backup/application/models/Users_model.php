<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

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

		$this->load->library('user_agent');

        // define primary table
        $this->_db = 'users';
    }


    /**
     * Get list of non-deleted users
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all($limit = 0, $offset = 0, $filters = array(), $sort = 'last_name', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
            WHERE deleted = '0'
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

	function get_total_users()
	{
		$s= $this->db->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	function get_log_user($username)
	{
		return $this->db->where("user", $username)->order_by('id', 'DESC')->limit(20)->get("login_history");
	}

	function get_log_user_mail($email)
	{
		return $this->db->where("user", $email)->order_by('id', 'DESC')->limit(20)->get("login_history");
	}

	function get_log_transactions($username)
	{
		return $this->db->where("sender", $username)->order_by('id', 'DESC')->limit(10)->get("transactions");
	}

	function get_log_transactions_in($username)
	{
		return $this->db->where("receiver", $username)->order_by('id', 'DESC')->limit(10)->get("transactions");
	}

	function get_log_doc($username)
	{
		return $this->db->where("user", $username)->order_by('id', 'DESC')->limit(10)->get("verification");
	}

	function get_history($username)
	{
		$where = "receiver='{$username}' OR sender='{$username}'";
		return $this->db->where($where)->order_by('id', 'DESC')->limit(10)->get("transactions");
	}

    /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */

    function get_user($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE id = " . $this->db->escape($id) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }

	function get_user_transfer($username = NULL)
    {
        if ($username)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE username = " . $this->db->escape($username) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }

	function get_user_mail($user = NULL)
    {
        if ($user)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE username = " . $this->db->escape($user) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }

	function get_user_mail2($user2 = NULL)
    {
        if ($user2)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE username = " . $this->db->escape($user2) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }

	function get_user_claim($claimant = NULL)
    {
        if ($claimant)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE username = " . $this->db->escape($claimant) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }

	function get_user_disp($defendant = NULL)
    {
        if ($defendant)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE username = " . $this->db->escape($defendant) . "
                    AND deleted = '0'
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

				if ($claimant)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE username = " . $this->db->escape($claimant) . "
                    AND deleted = '0'
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
     * Add a new user
     *
     * @param  array $data
     * @return mixed|boolean
     */
    function add_user($data = array())
    {
        if ($data)
        {
            // secure password
            $salt     = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
            $password = hash('sha512', $data['password'] . $salt);

            $sql = "
                INSERT INTO {$this->_db} (
                    username,
                    password,
                    salt,
                    first_name,
                    last_name,
                    email,
                    language,
                    is_admin,
                    verifi_status,
					fraud_status,
                    status,
                    deleted,
                    created,
                    updated
                ) VALUES (
                    " . $this->db->escape($data['username']) . ",
                    " . $this->db->escape($password) . ",
                    " . $this->db->escape($salt) . ",
                    " . $this->db->escape($data['first_name']) . ",
                    " . $this->db->escape($data['last_name']) . ",
                    " . $this->db->escape($data['email']) . ",
                    " . $this->db->escape($this->config->item('language')) . ",
                    " . $this->db->escape($data['is_admin']) . ",
                    " . $this->db->escape($data['verifi_status']) . ",
					" . $this->db->escape($data['fraud_status']) . ",
                    " . $this->db->escape($data['status']) . ",
                    '0',
                    '" . date('Y-m-d H:i:s') . "',
                    '" . date('Y-m-d H:i:s') . "'
                )
            ";

            $this->db->query($sql);

            if ($id = $this->db->insert_id())
            {
                return $id;
            }
        }

        return FALSE;
    }


    /**
     * User creates their own profile
     *
     * @param  array $data
     * @return mixed|boolean
     */
    function create_profile($data = array())
    {
        if ($data)
        {
            // secure password and create validation code
            $salt            = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
            $password        = hash('sha512', $data['password'] . $salt);
            $validation_code = sha1(microtime(TRUE) . mt_rand(10000, 90000));

            $sql = "
                INSERT INTO {$this->_db} (
                    username,
                    password,
                    salt,
                    first_name,
                    last_name,
                    email,
										phone,
                    language,
                    is_admin,
                    status,
                    deleted,
                    validation_code,
                    created,
                    updated
                ) VALUES (
                    " . $this->db->escape($data['username']) . ",
                    " . $this->db->escape($password) . ",
                    " . $this->db->escape($salt) . ",
                    " . $this->db->escape($data['first_name']) . ",
                    " . $this->db->escape($data['last_name']) . ",
                    " . $this->db->escape($data['email']) . ",
										" . $this->db->escape($data['phone']) . ",
                    " . $this->db->escape($data['language']) . ",
                    '0',
                    '0',
                    '0',
                    " . $this->db->escape($validation_code) . ",
                    '" . date('Y-m-d H:i:s') . "',
                    '" . date('Y-m-d H:i:s') . "'
                )
            ";

            $this->db->query($sql);

            if ($this->db->insert_id())
            {
                return $validation_code;
            }
        }

        return FALSE;
    }


    /**
     * Edit an existing user
     *
     * @param  array $data
     * @return boolean
     */
    function edit_user($data = array())
    {
        if ($data)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
                    username = " . $this->db->escape($data['username']) . ",
            ";

            if ($data['password'] != '')
            {
                // secure password
                $salt     = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
                $password = hash('sha512', $data['password'] . $salt);

                $sql .= "
                    password = " . $this->db->escape($password) . ",
                    salt = " . $this->db->escape($salt) . ",
                ";
            }

            $sql .= "
                    first_name = " . $this->db->escape($data['first_name']) . ",
                    last_name = " . $this->db->escape($data['last_name']) . ",
                    email = " . $this->db->escape($data['email']) . ",
					phone = " . $this->db->escape($data['phone']) . ",
                    language = " . $this->db->escape($data['language']) . ",
                    is_admin = " . $this->db->escape($data['is_admin']) . ",
                    debit_base = " . $this->db->escape($data['debit_base']) . ",
                    debit_extra1 = " . $this->db->escape($data['debit_extra1']) . ",
                    debit_extra2 = " . $this->db->escape($data['debit_extra2']) . ",
                    debit_extra3 = " . $this->db->escape($data['debit_extra3']) . ",
                    debit_extra4 = " . $this->db->escape($data['debit_extra4']) . ",
                    debit_extra5 = " . $this->db->escape($data['debit_extra5']) . ",
                    verifi_status = " . $this->db->escape($data['verifi_status']) . ",
                    fraud_status = " . $this->db->escape($data['fraud_status']) . ",
                    status = " . $this->db->escape($data['status']) . ",
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($data['id']) . "
                    AND deleted = '0'
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
     * User edits their own profile
     *
     * @param  array $data
     * @param  int $user_id
     * @return boolean
     */
    function edit_profile($data = array(), $user_id = NULL)
    {
        if ($data && $user_id)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
            ";

            if ($data['password'] != '')
            {
                // secure password
                $salt     = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
                $password = hash('sha512', $data['password'] . $salt);

                $sql .= "
                    password = " . $this->db->escape($password) . ",
                    salt = " . $this->db->escape($salt) . ",
                ";
            }

            $sql .= "
                    first_name = " . $this->db->escape($data['first_name']) . ",
                    last_name = " . $this->db->escape($data['last_name']) . ",
                    email = " . $this->db->escape($data['email']) . ",
										phone = " . $this->db->escape($data['phone']) . ",
                    language = " . $this->db->escape($data['language']) . ",
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($user_id) . "
                    AND deleted = '0'
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
     * Soft delete an existing user
     *
     * @param  int $id
     * @return boolean
     */
    function delete_user($id = NULL)
    {
        if ($id)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
                    is_admin = '0',
                    status = '0',
                    deleted = '1',
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($id) . "
                    AND id > 1
            ";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }

	function update_wallet($id, $data) {
		$this->db->where("ID", $id)->update("users", $data);
	}

	function update_wallet_transfer($username, $data) {
		$this->db->where("username", $username)->update("users", $data);
	}


    /**
     * Check for valid login credentials
     *
     * @param  string $username
     * @param  string $password
     * @return array|boolean
     */
    function login($username = NULL, $password = NULL)
    {


        if ($username && $password)
        {
            $sql = "
                SELECT
                    id,
                    username,
                    password,
                    salt,
                    first_name,
                    last_name,
					debit_base,
                    email,
                    language,
                    is_admin,
                    status,
                    created,
                    updated
                FROM {$this->_db}
                WHERE (username = " . $this->db->escape($username) . "
                        OR email = " . $this->db->escape($username) . ")
                    AND is_admin = '1'
                    AND status = '1'
                    AND deleted = '0'
                LIMIT 1
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                $results = $query->row_array();
                $salted_password = hash('sha512', $password . $results['salt']);

                if ($results['password'] == $salted_password)
                {
                    unset($results['password']);
                    unset($results['salt']);

                    return $results;
                }
            }

        }

        return FALSE;
    }

	function get_log_activy()
	{
		return $this->db->order_by('id', 'DESC')->limit(18)->get("login_history");
	}


	/**
     * Handle user login history
     *
     * @return boolean
     */
    function login_history($username = NULL)
    {
		if ($username)
        	{
            $sql = "
                INSERT INTO login_history (
										ip,
										date,
										event,
										user,
										device
								) VALUES (
										" . $this->db->escape($_SERVER['REMOTE_ADDR']) . ",
										'" . date("Y-m-d H:i:s") . "',
										'1',
										" . $this->db->escape($username) . ",
										'" . $this->agent->agent_string() . "'
								)
            ";
						$this->db->query($sql);
					 }
        return TRUE;
    }

	function updateUsers($data)
	{
		$this->db->where("ID", 1)->update("currencys", $data);
	}

	/**
     * Update user - dispute
     *
     * @param  array $data
     * @return boolean
     */
		function update_user($defendant, $data) {
			$this->db->where("username", $defendant)->update("users", $data);
		}

		/**
     * Update user - verify
     *
     * @param  array $data
     * @return boolean
     */
	function verify_user($user, $data) {
		$this->db->where("username", $user)->update("users", $data);
	}

    /**
     * Handle user login attempts
     *
     * @return boolean
     */
    function login_attempts()
    {
        // delete older attempts
        $older_time = date('Y-m-d H:i:s', strtotime('-' . $this->config->item('login_max_time') . ' seconds'));

        $sql = "
            DELETE FROM login_attempts
            WHERE attempt < '{$older_time}'
        ";

        $query = $this->db->query($sql);

        // insert the new attempt
        $sql = "
            INSERT INTO login_attempts (
                ip,
                attempt
            ) VALUES (
                " . $this->db->escape($_SERVER['REMOTE_ADDR']) . ",
                '" . date("Y-m-d H:i:s") . "'
            )
        ";

        $query = $this->db->query($sql);

        // get count of attempts from this IP
        $sql = "
            SELECT
                COUNT(*) AS attempts
            FROM login_attempts
            WHERE ip = " . $this->db->escape($_SERVER['REMOTE_ADDR'])
        ;

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            $results = $query->row_array();
            $login_attempts = $results['attempts'];
            if ($login_attempts > $this->config->item('login_max_attempts'))
            {
                // too many attempts
                return FALSE;
            }
        }

        return TRUE;
    }


    /**
     * Validate a user-created account
     *
     * @param  string $encrypted_email
     * @param  string $validation_code
     * @return boolean
     */
    function validate_account($encrypted_email = NULL, $validation_code = NULL)
    {
        if ($encrypted_email && $validation_code)
        {
            $sql = "
                SELECT id
                FROM {$this->_db}
                WHERE SHA1(email) = " . $this->db->escape($encrypted_email) . "
                    AND validation_code = " . $this->db->escape($validation_code) . "
                    AND status = '0'
                    AND deleted = '0'
                LIMIT 1
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                $results = $query->row_array();

                $sql = "
                    UPDATE {$this->_db}
                    SET status = '1',
                        validation_code = NULL
                    WHERE id = '" . $results['id'] . "'
                ";

                $this->db->query($sql);

                if ($this->db->affected_rows())
                {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }


    /**
     * Reset password
     *
     * @param  array $data
     * @return mixed|boolean
     */
    function reset_password($data = array())
    {
        if ($data)
        {
            $sql = "
                SELECT
                    id,
                    first_name
                FROM {$this->_db}
                WHERE email = " . $this->db->escape($data['email']) . "
                    AND status = '1'
                    AND deleted = '0'
                LIMIT 1
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                // get user info
                $user = $query->row_array();

                // create new random password
                $user_data['new_password'] = generate_random_password();
                $user_data['first_name']   = $user['first_name'];

                // create new salt and stored password
                $salt     = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
                $password = hash('sha512', $user_data['new_password'] . $salt);

                $sql = "
                    UPDATE {$this->_db} SET
                        password = " . $this->db->escape($password) . ",
                        salt = " . $this->db->escape($salt) . "
                    WHERE id = " . $this->db->escape($user['id']) . "
                ";

                $this->db->query($sql);

                if ($this->db->affected_rows())
                {
                    return $user_data;
                }
            }
        }

        return FALSE;
    }


    /**
     * Check to see if a username already exists
     *
     * @param  string $username
     * @return boolean
     */
    function username_exists($username)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE username = " . $this->db->escape($username) . "
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return TRUE;
        }

        return FALSE;
    }


    /**
     * Check to see if an email already exists
     *
     * @param  string $email
     * @return boolean
     */
    function email_exists($email)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE email = " . $this->db->escape($email) . "
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return TRUE;
        }

        return FALSE;
    }

    function chk_email_duplicate($email)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE email = '" . $email . "'
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return 'true';
        }
         return 'false';
    }

    function chk_username_duplicate($username)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE username = '" . $username . "'
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return 'true';
        }
         return 'false';
    }

    function add_user_dt($Userdata,$Infodata,$Processdata)
    {
        $this->db->insert('users', $Userdata);

        $users_id = $this->db->insert_id();

        $Infodata['users_id'] = $users_id;
        $Processdata['users_id'] = $users_id;

        $this->db->insert('users_business', $Infodata);
        $this->db->insert('users_processing', $Processdata);

        return 'true';
    }

}