<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * A unique hit counter that respects users' privacy
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 * Inspired by https://github.com/defuse/phpcount , Taylor Hornby
 */

// Sample database shema (rename the tables accordingly)
/*
CREATE TABLE IF NOT EXISTS `hits` (
    `pageid` varchar(100) NOT NULL,
    `isunique` tinyint(1) NOT NULL,
    `hitcount` int(11) unsigned NOT NULL,
    KEY `pageid` (`pageid`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `nodupes` (
    `ids_hash` char(64) NOT NULL,
    `time` bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`ids_hash`)
) DEFAULT CHARSET=utf8;
 */

/*
A Usage Example:

Create an extender class within a separate model-file Page_hits.php:

class Page_hits extends Hit_counter {

    public function __construct() {

        parent::__construct();
    }

}

Create the tables 'page_hits' and 'page_hits_nodupes' using the schemes above and go.
*/

abstract class Hit_counter extends CI_Model {

    protected $hit_old_after_seconds = 2592000; // default: 30 days.

    // Don't count hits from search robots and crawlers.
    protected $ignore_search_bots = true;

    // Don't count the hit if the browser sends the DNT: 1 header.
    protected $honor_do_not_track = false;

    protected $ip_ignore_list = array(
        '127.0.0.1',
    );

    /**
     * This model's default database table. Automatically
     * guessed by pluralising the model name.
     */
    protected $_table;
    protected $_nodupes_table;

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
    protected $_database;

    public function __construct() {

        parent::__construct();

        $this->load->helper('inflector');
        $this->load->library('user_agent');

        $this->_set_database();
        $this->_fetch_table();
    }

    /*
     * Adds a hit to a page specified by a unique $page_id string.
     */
    public function add_hit($page_id) {

        if (is_cli()) {
            return false;
        }

        if ($this->ignore_search_bots && $this->agent->is_robot()) {
            return false;
        }

        if (!empty($this->ip_ignore_list) && is_array($this->ip_ignore_list) && in_array($this->input->ip_address(), $this->ip_ignore_list)) {
            return false;
        }

        $this->cleanup();
        $this->create_counts_if_not_present($page_id);

        if ($this->unique_hit($page_id)) {

            $this->count_hit($page_id, true);
            $this->log_hit($page_id);
        }

        $this->count_hit($page_id, false);
    }

    /*
     * Returns (int) the amount of hits a page has
     * $page_id - the page identifier
     * $unique - true if you want unique hit count
     */

    public function get_hits($page_id, $unique = false) {

        $unique = empty($unique) ? 0 : 1;

        $this->create_counts_if_not_present($page_id);

        $row = $this->_database
                ->select('hitcount')
                ->from($this->_table)
                ->where('pageid', $page_id)
                ->where('isunique', $unique)
                ->limit(1)
                ->get()
                ->row_array();

        if (!empty($row)) {
            return (int) $row['hitcount'];
        }

        return false;
    }

    /*
     * Returns the total amount of hits to the entire website
     * When $unique is FALSE, it returns the sum of all non-unique hit counts
     * for every page. When $unique is TRUE, it returns the sum of all unique
     * hit counts for every page, so the value that's returned IS NOT the
     * amount of site-wide unique hits, it is the sum of each page's unique
     * hit count.
     */

    public function get_total_hits($unique = false) {

        $unique = empty($unique) ? 0 : 1;

        $row = $this->_database
                ->select('SUM(hitcount) AS cnt')
                ->from($this->_table)
                ->where('isunique', $unique)
                ->get()
                ->row_array();

        return (int) $row['cnt'];
    }

    // Non-public methods ------------------------------------------------------

    protected function create_counts_if_not_present($page_id) {

        // Non-unique

        $row = $this->_database
                ->select('pageid')
                ->from($this->_table)
                ->where('pageid', $page_id)
                ->where('isunique', 0)
                ->limit(1)
                ->get()
                ->row_array();

        if (empty($row)) {
            $this->_database
                    ->insert($this->_table, array('pageid' => $page_id, 'isunique' => 0, 'hitcount' => 0));
        }

        // Unique

        $row = $this->_database
                ->select('pageid')
                ->from($this->_table)
                ->where('pageid', $page_id)
                ->where('isunique', 1)
                ->limit(1)
                ->get()
                ->row_array();

        if (empty($row)) {
            $this->_database
                    ->insert($this->_table, array('pageid' => $page_id, 'isunique' => 1, 'hitcount' => 0));
        }
    }

    protected function cleanup() {

        $last_interval = time() - $this->hit_old_after_seconds;
        $this->_database
                ->where('time <', $last_interval)
                ->delete($this->_nodupes_table);
    }

    protected function unique_hit($page_id) {

        $ids_hash = $this->id_hash($page_id);

        $row = $this->_database
                ->select('time')
                ->from($this->_nodupes_table)
                ->where('ids_hash', $ids_hash)
                ->limit(1)
                ->get()
                ->row_array();

        if (!empty($row) && $row['time'] > time() - $this->hit_old_after_seconds) {
            return false;
        }

        return true;
    }

    protected function id_hash($page_id) {

        return hash('SHA256', $page_id . $this->input->ip_address());
    }

    protected function count_hit($page_id, $unique) {

        $unique = empty($unique) ? 0 : 1;

        $this->_database
                ->set('hitcount', 'hitcount + 1', false)
                ->where('pageid', $page_id)
                ->where('isunique', $unique)
                ->update($this->_table);
    }

    protected function log_hit($page_id) {

        $ids_hash = $this->id_hash($page_id);

        $row = $this->_database
                ->select('time')
                ->from($this->_nodupes_table)
                ->where('ids_hash', $ids_hash)
                ->limit(1)
                ->get()
                ->row_array();

        $this->_database->set('time', time());

        if (!empty($row)) {

            $this->_database
                    ->where('ids_hash', $ids_hash)
                    ->update($this->_nodupes_table);
        } else {

            $this->_database
                    ->set('ids_hash', $ids_hash)
                    ->insert($this->_nodupes_table);
        }
    }

    /**
     * Guess the table name by pluralising the model name
     */
    private function _fetch_table() {

        if ($this->_table == '') {
            $this->_table = plural(preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this))));
        }

        if ($this->_nodupes_table == '') {
            $this->_nodupes_table = $this->_table . '_nodupes';
        }
    }

    /**
     * Establish the database connection.
     */
    private function _set_database() {

        if (!class_exists('CI_DB', FALSE)) {

            // There is no connection. Skip silently.
            // Possibly specific requests do not require database connection.
            return;
        }

        // Was a DB group specified by the user?
        if (isset($this->_db_group)) {
            $this->_database = $this->load->database($this->_db_group, TRUE, TRUE);
        }

        // No DB group specified, use the default connection.
        else {

            $db = @ get_instance()->db;

            // Has the default connection been loaded yet?
            if (!isset($db) OR !is_object($db) OR empty($db->conn_id)) {
                get_instance()->load->database('', FALSE, TRUE);
            }

            $this->_database = get_instance()->db;
        }
    }

}
