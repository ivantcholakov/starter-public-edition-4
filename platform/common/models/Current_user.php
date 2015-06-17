<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 * Inspired by A3M project, see https://github.com/donjakobo/A3M
 */

// Login results.
defined('LOGIN_NO_ERROR') OR define('LOGIN_NO_ERROR', 0);
defined('LOGIN_NO_USER_FOUND') OR define('LOGIN_NO_USER_FOUND', 1);
defined('LOGIN_NO_PASSWORD_MATCH') OR define('LOGIN_NO_PASSWORD_MATCH', 2);
defined('LOGIN_NO_PASSWORD_SET') OR define('LOGIN_NO_PASSWORD_SET', 3);
defined('LOGIN_USER_SUSPENDED') OR define('LOGIN_USER_SUSPENDED', 4);
defined('LOGIN_USER_UNAUTHORIZED') OR define('LOGIN_USER_UNAUTHORIZED', 5);
defined('LOGIN_USER_UNVERIFIED') OR define('LOGIN_USER_UNVERIFIED', 6);
defined('LOGIN_NO_USERNAME_PROVIDED') OR define('LOGIN_NO_USERNAME_PROVIDED', 7);
defined('LOGIN_NO_PASSWORD_PROVIDED') OR define('LOGIN_NO_PASSWORD_PROVIDED', 8);
defined('LOGIN_FORCE_PASSWORD_CHANGE') OR define('LOGIN_FORCE_PASSWORD_CHANGE', 9);

// Authentication methods.
defined('AUTHENTICATION_NONE') OR define('AUTHENTICATION_NONE', 0);
defined('AUTHENTICATION_PASSWORD') OR define('AUTHENTICATION_PASSWORD', 1);
defined('AUTHENTICATION_AUTOLOGIN') OR define('AUTHENTICATION_AUTOLOGIN', 2);
defined('AUTHENTICATION_EXTERNAL') OR define('AUTHENTICATION_EXTERNAL', 3);

class Current_user extends CI_Model {

    protected $user_id;
    protected $user_id_session_key = '_current_user_id';
    protected $new_session_started = false;
    protected $session_persistence_test_session_key = '_current_user_session_persistence_test';
    protected $data;
    protected $last_login_error = LOGIN_NO_ERROR;
    protected $logout_info;
    protected $autologin_enabled;
    protected $is_fully_authenticated = false;
    protected $is_fully_authenticated_session_key = '_current_user_is_fully_authenticated';
    protected $authentication_method = AUTHENTICATION_NONE;
    protected $authentication_method_session_key = '_current_user_authentication_method';
    protected $account_verification_enabled;

    // See current_user_helper.php and/or MY_current_user_helper.php.
    // Adapt the function user_authorization_check($user) according to your authoriztion system.
    // By default this function returns FALSE, so you need to have a look at it.
    protected $user_autorization_check = 'user_authorization_check_at_login';

    public function __construct() {

        parent::__construct();

        $this->load->config('users');
        $this->load->model('users');
        $this->load->helper('current_user');

        $this->account_verification_enabled = $this->config->item('account_verification_enabled');
        $this->account_verification_enabled = !empty($this->account_verification_enabled);

        $this->autologin_enabled = $this->config->item('autologin_enabled');
        $this->autologin_enabled = !empty($this->autologin_enabled) && !is_cli();

        if ($this->autologin_enabled) {
            $this->load->model('autologin');
        }

        $user_id_session_key = (string) $this->config->item('current_user_id_session_key');

        if ($user_id_session_key != '') {
            $this->user_id_session_key = $user_id_session_key;
        }

        $session_persistence_test_session_key = (string) $this->config->item('session_persistence_test_session_key');

        if ($session_persistence_test_session_key != '') {
            $this->session_persistence_test_session_key = $session_persistence_test_session_key;
        }

        $is_fully_authenticated_session_key = (string) $this->config->item('is_fully_authenticated_session_key');

        if ($is_fully_authenticated_session_key != '') {
            $this->is_fully_authenticated_session_key = $is_fully_authenticated_session_key;
        }

        $authentication_method_session_key = (string) $this->config->item('authentication_method_session_key');

        if ($authentication_method_session_key != '') {
            $this->authentication_method_session_key = $authentication_method_session_key;
        }

        if (is_cli()) {

            $this->assign(null);

        } else {

            // On http-request set the stored in session account_id.
            // Empty/zero value sets the Annonymous user_id = 0.
            $this->assign($this->session->userdata($this->user_id_session_key));

            // After autologin the previous authenticated session gets lost. Check that.
            $session_persistence_test = $this->session->userdata($this->session_persistence_test_session_key);
            $this->new_session_started = empty($session_persistence_test);
            $this->session->set_userdata($this->session_persistence_test_session_key, true);

            $is_fully_authenticated = $this->session->userdata($this->is_fully_authenticated_session_key);
            $this->is_fully_authenticated = !empty($is_fully_authenticated);

            $authentication_method = $this->session->userdata($this->authentication_method_session_key);
            $this->authentication_method = (int) $authentication_method;
        }
    }

    public function new_session_started() {

        return $this->new_session_started;
    }

    public function refresh() {

        if (!$this->is_logged_in()) {

            $this->data = null;

        } else {

            $this->data = $this->users->get($this->id());

            if (empty($this->data)) {

                $this->assign(null);

                return false;

            } else {

                unset($this->data['password']);
            }
        }

        return true;
    }

    protected function assign($id) {

        $id = $id === null ? null : (int) $id;

        $this->user_id = $id;

        if (!is_cli()) {

            if ($id !== null) {
                $this->session->set_userdata($this->user_id_session_key, $id);
            } else {
                $this->session->unset_userdata($this->user_id_session_key);
            }
        }

        return $this->refresh();
    }

    public function get($key = null) {

        $key = (string) $key;

        if ($key == '') {
            return $this->data;
        }

        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function id() {

        return $this->user_id;
    }

    public function is_logged_in() {

        return $this->id() !== null;
    }

    public function authentication_method() {

        if (!$this->is_logged_in()) {
            return AUTHENTICATION_NONE;
        }

        return $this->authentication_method;
    }

    protected function set_authentication_method($value) {

        $this->authentication_method = (int) $value;

        if (!is_cli()) {
            $this->session->set_userdata($this->authentication_method_session_key, $this->authentication_method);
        }

        $this->set_fully_authenticated($this->authentication_method === AUTHENTICATION_PASSWORD);
    }

    public function is_fully_authenticated() {

        if (!$this->is_logged_in()) {
            return false;
        }

        $this->is_fully_authenticated;
    }

    // This is to be used after a non-fully authenticated user
    // has been forced additionally to enter his/her password
    // before making an important operation (payment, etc.).
    // The $value should be boolean.
    public function set_fully_authenticated($value) {

        $this->is_fully_authenticated = !empty($value);

        if (!is_cli()) {
            $this->session->set_userdata($this->is_fully_authenticated_session_key, $this->is_fully_authenticated);
        }
    }

    public function username() {

        return isset($this->data['username']) ? $this->data['username'] : null;
    }

    public function email() {

        return isset($this->data['email']) ? $this->data['email'] : null;
    }

    public function first_name() {

        return isset($this->data['first_name']) ? $this->data['first_name'] : null;
    }

    public function middle_name() {

        return isset($this->data['middle_name']) ? $this->data['middle_name'] : null;
    }

    public function last_name() {

        return isset($this->data['last_name']) ? $this->data['last_name'] : null;
    }

    public function login($username, $password, $remember_me = false) {

        $username = (string) $username;
        $password = (string) $password;
        $remember_me = !empty($remember_me);

        $this->assign(null);
        $this->last_login_error = LOGIN_NO_ERROR;
        $this->set_authentication_method(AUTHENTICATION_PASSWORD);

        if ($username == '') {
            return $this->login_failed(LOGIN_NO_USERNAME_PROVIDED);
        }

        if ($password == '') {
            return $this->login_failed(LOGIN_NO_PASSWORD_PROVIDED);
        }

        $user = $this->users->get_by_username_or_email($username);

        if (empty($user)) {
            return $this->login_failed(LOGIN_NO_USER_FOUND);
        }

        $id = (int) $user['id'];
        $password_derivate = (string) $user['password'];

        if ($password_derivate == '') {
            return $this->login_failed(LOGIN_NO_PASSWORD_SET);
        }

        if (!$this->users->verify_password($password, $password_derivate)) {
            return $this->login_failed(LOGIN_NO_PASSWORD_MATCH);
        }

        Events::trigger('before_user_login', array('id' => $id));

        $result = $this->login_by_id($id);

        if ($result) {

            if ($remember_me) {
                $this->create_autologin($this->id());
            } else {
                $this->delete_autologin();
            }

            Events::trigger('after_user_login', $this->get());
        }

        return $result;
    }

    public function login_by_id($id) {

        if (!is_cli()) {
            $this->session->sess_regenerate(false);
        }

        $id = (int) $id;

        Events::trigger('before_user_login_by_id', array('id' => $id));

        $this->assign(null);
        $this->last_login_error = LOGIN_NO_ERROR;

        if ($this->authentication_method == AUTHENTICATION_NONE) {
            $this->set_authentication_method(AUTHENTICATION_EXTERNAL);
        }

        $user = $this->users->get($id);

        if (empty($user)) {
            return $this->login_failed(LOGIN_NO_USER_FOUND);
        }

        if ($this->account_verification_enabled && $user['verified_at'] == '') {
            return $this->login_failed(LOGIN_USER_UNVERIFIED);
        }

        if (empty($user['active'])) {
            return $this->login_failed(LOGIN_USER_SUSPENDED);
        }

        // Here is the authorization check-point.

        $authorized = false;

        if (is_callable($this->user_autorization_check)) {

            $authorized = is_array($this->user_autorization_check)
                ? $this->user_autorization_check[0]->{$this->user_autorization_check[1]}($user)
                : call_user_func($this->user_autorization_check, $user);
        }

        if (!$authorized) {
            return $this->login_failed(LOGIN_USER_UNAUTHORIZED);
        }

        //

        if (!$this->assign($id)) {
            return $this->login_failed(LOGIN_NO_USER_FOUND);
        }

        $this->users->skip_observers()->update($id, array('previous_login_at' => $user['last_login_at'], 'last_login_at' => date('Y-m-d H:i:s')));

        if (!$this->refresh()) {
            return $this->login_failed(LOGIN_NO_USER_FOUND);
        }

        $this->last_login_error = LOGIN_NO_ERROR;

        // Notification may be implemented.
        Events::trigger('user_logged_in', $this->get());

        return true;
    }

    protected function login_failed($login_error) {

        $this->last_login_error = $login_error;
        $this->set_authentication_method(AUTHENTICATION_NONE);
        $this->delete_autologin();

        Events::trigger('user_login_failure', array('error' => $this->last_login_error));

        return false;
    }

    public function last_login_error() {

        return $this->last_login_error;
    }

    public function logout() {

        Events::trigger('before_user_logout', $this->get());

        $this->last_login_error = LOGIN_NO_ERROR;
        $this->set_authentication_method(AUTHENTICATION_NONE);
        $this->delete_autologin();

        $this->logout_info = $this->get();
        $this->assign(null);

        if (!is_cli()) {

            $logout_destroys_session = $this->config->item('logout_destroys_session');
            $this->session->sess_regenerate(!empty($logout_destroys_session));
        }

        Events::trigger('after_user_logout', $this->logout_info);
    }

    public function logout_info() {

        if ($this->is_logged_in()) {
            return $this->get();
        }

        return $this->logout_info;
    }

    // This method is needed for auto-logged-in user before he/she makes a critical action.
    public function verify_password($password) {

        if (!$this->is_logged_in()) {
            return false;
        }

        $password_derivate = $this->users->skip_observers()->select('password')->as_value()->get($this->id());

        return $this->users->verify_password($password, $password_derivate);
    }

    // Autologin
    //--------------------------------------------------------------------------

    public function autologin_enabled() {

        return $this->autologin_enabled;
    }

    // Call this method from base controllers, at their initialization.
    public function autologin() {

        if (
            $this->autologin_enabled
            &&
            !$this->is_logged_in()
            &&
            ($user_id = $this->autologin->autologin()) !== false
        ) {

            $this->set_authentication_method(AUTHENTICATION_AUTOLOGIN);

            return $this->login_by_id($user_id);
        }

        return false;
    }

    public function create_autologin($id) {

        if ($this->autologin_enabled) {
            $this->autologin->create_autologin($id);
        }
    }

    public function delete_autologin() {

        if ($this->autologin_enabled) {
            $this->autologin->delete_autologin();
        }
    }

    /**
     * Gets the URL of the current user's photo/avatar.
     * @see User_photo::get()
     * @see Users::photo()
     */
    public function photo($options) {

        return $this->users->photo($this->get(), $options);
    }

}
