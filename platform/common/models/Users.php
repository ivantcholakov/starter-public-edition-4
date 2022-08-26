<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 * Inspired by A3M project, see https://github.com/donjakobo/A3M
 */

// Sample minimal scheme for 'users' table:
/*
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(511) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `middle_name` varchar(128) NOT NULL,
  `photo_source` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `suspended_at` datetime DEFAULT NULL,
  `suspended_by` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login_at` datetime DEFAULT NULL,
  `previous_login_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `verification_request_at` datetime DEFAULT NULL,
  `password_reset_request_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_email` (`email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`),
  KEY `last_login_at` (`last_login_at`),
  KEY `suspended_by` (`suspended_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `group_id`, `first_name`, `last_name`, `middle_name`, `active`, `suspended_at`, `suspended_by`, `last_login_at`, `previous_login_at`, `verified_at`, `verification_request_at`, `password_reset_request_at`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted`, `deleted_at`, `deleted_by`) VALUES
(1, 'admin', '$2a$08$iw1j31k0EzRwZbZVTdCQ8O2W3VAJvtsUmjZ3mHpnhNC.tg5vU9LBa', 'your@email.com', 1, 'Master', 'Commander', 'And', 1, NULL, 0, '2014-08-17 14:51:25', '2014-08-17 14:51:04', '2014-08-11 09:08:31', '2014-08-11 09:07:55', NULL, '2014-03-29 08:44:11', 0, '2014-08-10 22:52:34', 0, 0, '0000-00-00 00:00:00', 0);
*/
// Username: admin
// Password: 123456

class Users extends Core_Model {

    protected $check_for_existing_fields = true;
    public $protected_attributes = array('id');

    protected $_table = 'users';
    protected $return_type = 'array';

    protected $soft_delete = true;

    public function __construct() {

        parent::__construct();

        $this->load->config('users');
        $this->load->helper('current_user');

        $this->user_id_getter = 'user_id_getter_for_models';

        $this->before_create[] = 'created_at';
        $this->before_create[] = 'created_by';

        $this->before_create[] = 'updated_at';
        $this->before_create[] = 'updated_by';

        $this->before_update[] = 'updated_at';
        $this->before_update[] = 'updated_by';

        $this->before_delete[] = 'deleted_at';
        $this->before_delete[] = 'deleted_by';

        $this->before_create[] = 'store_password';
        $this->before_update[] = 'store_password';
    }

    public function get_by_username_or_email($username_or_email) {

        return $this
            ->group_start()
                ->where('username', $username_or_email)
                ->or_where('email', $username_or_email)
            ->group_end()
            ->first();
    }

    public function username_min_length() {

        $result = (int) config_item('username_min_length');

        if ($result < 2) {
            $result = 2;
        }

        return $result;
    }

    public function username_max_length() {

        $result = (int) config_item('username_max_length');

        $username_min_length = $this->username_min_length();

        if ($result < $username_min_length) {

            $result = $username_min_length;

            if ($result < $username_min_length + 22) {
                $result = $username_min_length + 22;
            }
        }

        return $result;
    }

    public function valid_username($username) {

        if (UTF8::strlen((string) $username) < $this->username_min_length()) {
            return false;
        }

        if (UTF8::strlen((string) $username) > $this->username_max_length()) {
            return false;
        }

        $username_validator = (string) config_item('username_validator');

        if ($username_validator != '') {
            return (bool) preg_match($username_validator, (string) $username);
        }

        return true;
    }

    public function unique_username($username, $id = null, $with_deleted = false) {

        $username = (string) $username;

        if ($username == '') {
            return false;
        }

        $this->select('id')->where('username', $username);

        if ($id != '') {
            $this->where($this->primary_key.' <>', (int) $id);
        }

        if ($with_deleted) {
            $this->with_deleted();
        }

        $found = $this->first();

        return empty($found);
    }

    public function create_username($id = null) {

        $min_length = $this->username_min_length();
        $max_length = $this->username_max_length();

        if ($id != '') {

            $result = 'user'.$id;

            if (
                UTF8::strlen($result) >= $min_length
                &&
                UTF8::strlen($result) <= $max_length
                &&
                $this->unique_username($result, null, true)
            ) {
                return $result;
            }
        }

        $length = rand($min_length, $max_length);

        $chars = 'abcdefghijklmnopqrstuvwxyz';
        $chars_length = strlen($chars);

        do {

            $result = '';

            for ($i = 0; $i < $length; $i++) {
                $result .= $chars[mt_rand(0, $chars_length)];
            }

        } while (!$this->unique_username($result, null, true));

        return $result;
    }

    public function unique_email($email, $id = null, $with_deleted = false) {

        $email = (string) $email;

        if ($email == '') {
            return false;
        }

        $this->select('id')->where('email', $email);

        if ($id != '') {
            $this->where($this->primary_key.' <>', (int) $id);
        }

        if ($with_deleted) {
            $this->with_deleted();
        }

        $found = $this->first();

        return empty($found);
    }

    public function password_min_length() {

        $result = (int) config_item('password_min_length');

        if ($result < 6) {
            $result = 6;
        }

        return $result;
    }

    public function create_password() {

        $this->load->library('password');

        $min_length = $this->password_min_length();
        $max_length = $min_length + 2;

        return $this->password->create($min_length, $max_length);
    }

    public function protect_password($password) {

        $this->load->library('password');

        return $this->password->hash($password);
    }

    public function verify_password($password, $password_derivate) {

        $this->load->library('password');

        return $this->password->verify($password, $password_derivate);
    }

    public function change_password($id, $password) {

        $this->skip_observers()->update((int) $id, array('password' => $this->protect_password($password)));
    }

    protected function store_password($data) {

        if (isset($data['password'])) {
            $data['password'] = $this->protect_password($data['password']);
        }

        return $data;
    }

    public function verified($id) {

        return $this->select('verified_at')->as_value()->get((int) $id) != '';
    }

    public function set_verified($id) {

        $this->skip_observers()->update((int) $id, array('verified_at' => date('Y-m-d H:i:s')));
    }

    public function unset_verified($id) {

        $this->skip_observers()->update((int) $id, array('verified_at' => null));
    }

    /**
     * Gets the URL of a user's photo/avatar.
     * @see User_photo::get()
     */
    public function photo($user, $options = null) {

        $this->load->model('user_photo');

        return $this->user_photo->get($user, $options);
    }

    // Use the following methods outside cycles for not increasing database
    // queries number too much, use them for testing for example.
    //
    // For getting several properties simultaneously the following example is more effective:
    //
    // $user = $this->select('username, email')->with_deleted()->get((int) $id);
    // if (!empty($user)) {
    //     var_dump($user['username']);
    //     var_dump($user['email']);
    // }

    public function username($id) {

        return $this->select('username')->with_deleted()->as_value()->get((int) $id);
    }

    public function email($id) {

        return $this->select('email')->with_deleted()->as_value()->get((int) $id);
    }

    public function first_name($id) {

        return $this->select('first_name')->with_deleted()->as_value()->get((int) $id);
    }

    public function middle_name($id) {

        return $this->select('middle_name')->with_deleted()->as_value()->get((int) $id);
    }

    public function last_name($id) {

        return $this->select('last_name')->with_deleted()->as_value()->get((int) $id);
    }

}
