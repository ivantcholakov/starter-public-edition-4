<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*

-- Sample structure for the table `languages`

CREATE TABLE IF NOT EXISTS `languages` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `lang` varchar(8) NOT NULL,
    `active` tinyint(1) NOT NULL DEFAULT '0',
    `default` tinyint(1) NOT NULL DEFAULT '0',
    `display_order` int(11) UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `lang` (`lang`),
    KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/

class Languages extends Core_Model {

    protected $check_for_existing_fields = true;
    public $protected_attributes = array('id');

    protected $_table = 'languages';
    protected $return_type = 'array';

    protected $languages;
    protected $active_languages;

    public function __construct() {

        parent::__construct();

        // Let us not disturb the other models, probability is high,
        // so this model will use a clone of the query builder.
        $db = $this->database();
        if (is_object($db)) {
            $clone_db = clone $db;
            $clone_db->reset_query();
            $this->set_database($clone_db);
        }
    }

    public function & all() {

        if (isset($this->languages)) {
            return $this->languages;
        }

        $this->languages = array();
        $enabled_languages = $this->lang->enabled();

        $default_language_exists = false;

        if (!empty($enabled_languages) && is_array($enabled_languages)) {

            // Read the default values from the configuration file.

            foreach ($enabled_languages as $language) {

                $item = $this->lang->get($language);

                if (!empty($item) && is_array($item)) {

                    $item['active'] = $this->table_exists() ? false : true;
                    $item['default'] = false;

                    if ($language == $this->lang->current()) {

                        $item['active'] = true;
                        $item['default'] = true;
                    }

                    $this->languages[$language] = $item;
                }
            }

            // Read database values.

            if ($this->table_exists()) {
                $db_items = $this->order_by('display_order', 'asc')->find();
            } else {
                $db_items = array();
            }

            $sorted_languages = array();

            foreach ($db_items as $item) {

                $language = $this->lang->by_code($item['lang']);

                if (!isset($this->languages[$language])) {

                    $this->delete((int) $item['id']);
                    continue;
                }

                $this->languages[$language]['id'] = (int) $item['id'];

                $this->languages[$language]['active'] = !empty($item['active']);
                $this->languages[$language]['default'] = !$default_language_exists && !empty($item['default']);

                // Moving the default and active languages on the top.

                if ($this->languages[$language]['default']) {

                    $default_language_exists = true;    // Limit the default language to only one.
                    $this->languages[$language]['active'] = true;
                    $sorted_languages[$language] = $this->languages[$language];
                }
            }

            foreach ($db_items as $item) {

                $language = $this->lang->by_code($item['lang']);

                if (isset($this->languages[$language]) && !isset($sorted_languages[$language]) && $this->languages[$language]['active']) {
                    $sorted_languages[$language] = $this->languages[$language];
                }
            }

            foreach ($db_items as $item) {

                $language = $this->lang->by_code($item['lang']);

                if (isset($this->languages[$language]) && !isset($sorted_languages[$language])) {
                    $sorted_languages[$language] = $this->languages[$language];
                }
            }

            foreach ($this->languages as $language => $item) {

                if (!isset($sorted_languages[$language]) && $this->languages[$language]['default']) {

                    $sorted_languages[$language] = $this->languages[$language];
                    break;
                }
            }

            foreach ($this->languages as $language => $item) {

                if (!isset($sorted_languages[$language]) && $this->languages[$language]['active']) {
                    $sorted_languages[$language] = $this->languages[$language];
                }
            }

            foreach ($this->languages as $language => $item) {

                if (!isset($sorted_languages[$language])) {
                    $sorted_languages[$language] = $item;
                }
            }

            $this->languages = $sorted_languages;
        }

        return $this->languages;
    }

    public function & active() {

        if (isset($this->active_languages)) {
            return $this->active_languages;
        }

        $this->active_languages = array();

        $languages = & $this->all();

        foreach ($languages as $language => $item) {

            if (!empty($item['active'])) {
                $this->active_languages[$language] = $item;
            }
        }

        return $this->active_languages;
    }

}
