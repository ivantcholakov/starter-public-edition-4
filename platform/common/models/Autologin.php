<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Read the information from the provided links carefully.
 *
 * See http://fishbowl.pastiche.org/2004/01/19/persistent_login_cookie_best_practice/
 * See http://jaspan.com/improved_persistent_login_cookie_best_practice
 *
 * Some code has been taken and adapted from a sample implementation by Jens Segers.
 * See http://jenssegers.be/blog/12/codeigniter-authentication-library-1-3
 * See https://github.com/jenssegers/codeigniter-authentication-library
 *
 * Use this autologin feature on front/public parts of sites only, it is
 * for easing the end-users. Don't use this feature on administrative panels.
 */

/*
CREATE TABLE IF NOT EXISTS `autologin` (
    `user_id` int(11) unsigned NOT NULL,
    `series_id` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`user_id`,`series_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

class Autologin extends Core_Model {

    protected $_table = 'autologin';
    protected $return_type = 'array';

    protected $enabled;
    protected $cookie_name = 'autologin';
    protected $expiration_time = 5184000; // 60 days
    protected $hash_algorithm = 'sha256';
    protected $encryption_key;
    protected $automatic_purge;

    /**
     * Get the settings from config.
     */
    public function __construct() {

        parent::__construct();

        $this->before_create[] = 'created_at';
        $this->before_create[] = 'updated_at';
        $this->before_update[] = 'updated_at';

        $enabled = $this->config->item('autologin_enabled');
        $this->enabled = !empty($enabled) && !is_cli();

        $database_table_name = $this->config->item('autologin_database_table_name');

        if ($database_table_name != '') {
            $this->_table = $database_table_name;
        }

        $cookie_name = $this->config->item('autologin_cookie_name');

        if ($cookie_name != '') {
            $this->cookie_name = $cookie_name;
        }

        $expiration_time = (int) $this->config->item('autologin_expiration_time');

        if ($expiration_time > 0) {
            $this->expiration_time = $expiration_time;
        }

        $hash_algorithm = $this->config->item('autologin_hash_algorithm');

        if ($hash_algorithm != '') {
            $this->hash_algorithm = $hash_algorithm;
        }

        // Make sure that $this->encryption_key is not empty!
        // Set in your configuration the corresponding encryption keys!

        $this->encryption_key = $this->config->item('encryption_key_for_autologin');

        if ($this->encryption_key == '') {
            $this->encryption_key = $this->config->item('encryption_key');
        }

        $automatic_purge = $this->config->item('autologin_automatic_purge');
        $this->automatic_purge = !empty($automatic_purge);
    }

    //--------------------------------------------------------------------------

    /**
     * Reads the autologin cookie, and validates it to determine whether a user
     * can login automatically.
     * Also, this method prepares the autologin cookie for the next autologin attempt.
     *
     * @return mixed    User ID on success, FALSE on failure.
     */
    public function autologin() {

        if (is_cli()) {
            return false;
        }

        if (!$this->enabled) {
            return false;
        }

        if ($cookie = $this->read_cookie()) {

            // If you have setup a crontab script for cleaning expired autologins,
            // set $config['autologin_automatic_purge'] to FALSE.

            if ($this->automatic_purge) {

                // Remove all expired private tokens.
                $this->purge();
            }

            // Get the current private token.
            $private = $this->get_private_token($cookie['user_id'], $cookie['series_id']);

            if ($this->validate_public_and_private_tokens($cookie['token'], $private)) {

                // The user has valid tokens, extend the current series
                // with new public/private token pair.
                $this->create_autologin($cookie['user_id'], $cookie['series_id']);

                // Implement login by user within your authentication library/model.
                // Use this returned id for user logging in.
                // If login there is not successfull (user might be suspended
                // or due to other similar reason), then don't forget to call there
                // delete_autologin() method of this class instance.

                return (int) $cookie['user_id'];

            } else {

                // Normally we should not be here. Delete autologin at all.
                $this->delete_autologin();

                // Notification may be implemented for sniffing for possible theft.
                Events::trigger('invalid_autologin_attempt', $cookie);
            }
        }

        return false;
    }

    /**
     * Generate a new public/private token pair and create the autologin cookie.
     * This method is to be used by the old authentication library/model that
     * serves logging by username and password when "Remember me" option is set.
     * When this method is called from outside, only $user_id parameter is to be set.
     *
     * @param int $user_id
     * @param string $series_id
     */
    public function create_autologin($user_id, $series_id = false) {

        if (is_cli()) {
            return;
        }

        if (!$this->enabled) {
            return;
        }

        list($public, $private) = $this->generate_public_and_private_tokens();

        // Create a new series or expand the current one.

        if (!$series_id) {

            list($series_id) = $this->generate_public_and_private_tokens();

            $this->create_series($user_id, $series_id, $private);

        } else {

            $this->set_private_token($user_id, $series_id, $private);
        }

        $this->write_cookie(array('user_id' => $user_id, 'series_id' => $series_id, 'token' => $public));
    }

    /**
     * Disable the current autologin series and clear the cookie.
     *
     * This method is to be used by your authentication library/model that
     * serves logging by username and password and when "Remember me" option is not set.
     *
     * Also, call this method on logging out. If the external login by id fails
     * for some reason, don't forget to call this method too.
     */
    public function delete_autologin() {

        if (is_cli()) {
            return;
        }

        if (!$this->enabled) {
            return;
        }

        if ($cookie = $this->read_cookie()) {

            $this->delete_series($cookie['user_id'], $cookie['series_id']);

            $this->input->set_cookie(array('name' => $this->cookie_name, 'value' => '', 'expire' => ''));
        }
    }

    public function enabled() {

        return $this->enabled;
    }

    //--------------------------------------------------------------------------

    /**
     * Remove all expired private tokens.
     */
    public function purge() {

        $this->where('created_at <', date('Y-m-d H:i:s', time() - $this->expiration_time))->delete_many_by();
    }

    /**
     * Get the private token for a specific user and series.
     */
    protected function get_private_token($user_id, $series_id) {

        return $this->where('user_id', (int) $user_id)->where('series_id', $series_id)->value('token');
    }

    /**
     * Extend a user's current series with a new private token.
     */
    protected function set_private_token($user_id, $series_id, $token) {

        return $this->where('user_id', (int) $user_id)->where('series_id', $series_id)->update_by(array('token' => $token));
    }

    /**
     * Start a new series for a user.
     */
    protected function create_series($user_id, $series_id, $token) {

        return $this->insert(array('user_id' => (int) $user_id, 'series_id' => $series_id, 'token' => $token));
    }

    /**
     * Delete a user's series.
     */
    protected function delete_series($user_id, $series_id) {

        return $this->where('user_id', (int) $user_id)->where('series_id', $series_id)->delete_by();
    }

    //--------------------------------------------------------------------------

    /**
     * Generate public/private token pair.
     *
     * @return array
     */
    protected function generate_public_and_private_tokens() {

        $public = hash($this->hash_algorithm, uniqid(mt_rand()));
        $private = hash_hmac($this->hash_algorithm, $public, $this->encryption_key);

        return array($public, $private);
    }

    /**
     * Validate public/private token pair.
     *
     * @param string $public
     * @param string $private
     * @return boolean
     */
    protected function validate_public_and_private_tokens($public, $private) {

        $check = hash_hmac($this->hash_algorithm, $public, $this->encryption_key);

        return $check == $private;
    }

    /**
     * Write data to autologin cookie.
     *
     * @param array $data
     */
    protected function write_cookie($data = array()) {

        $this->load->library('gibberish');

        return $this->input->set_cookie(array(
            'name' => $this->cookie_name,
            'value' => (string) $this->gibberish->encrypt(serialize($data), $this->encryption_key),
            'expire' => $this->expiration_time
        ));
    }

    /**
     * Read data from autologin cookie.
     *
     * @return boolean
     */
    protected function read_cookie() {

        $this->load->library('gibberish');

        $cookie = $this->input->cookie($this->cookie_name, true);

        if (!$cookie) {
            return false;
        }

        $data = @unserialize($this->gibberish->decrypt($cookie, $this->encryption_key));

        if (isset($data['user_id']) && isset($data['series_id']) && isset($data['token'])) {
            return $data;
        }

        return false;
    }

}
