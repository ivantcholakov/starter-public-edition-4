<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/**
 * Create a table with the following sample definition
 * and fill it with settings that you intend to use:
 *
 * CREATE TABLE IF NOT EXISTS `settings` (
 *     `id` int(11) NOT NULL AUTO_INCREMENT,
 *     `name` varchar(255) NOT NULL,
 *     `value` varchar(511) NOT NULL,
 *     PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
 */

class Settings_model extends Core_Model {

    protected $check_for_existing_fields = true;
    public $protected_attributes = array('id');

    protected $_table = 'settings';
    protected $return_type = 'array';

    public function __construct() {

        parent::__construct();
    }

}
