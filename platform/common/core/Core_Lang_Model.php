<?php

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Read @link http://www.apphp.com/tutorials/index.php?page=multilanguage-database-design-in-mysql
 * "Multilanguage Database Design in MySQL" by Leumas Naypoka
 * "4. Additional Translation Table Approach"
 */

/*

A Practical Example
===================

You have a multi-language slideshow with non-changing background
images and translated in diferent languages title and html-content.

Here are the sample tables to be created:
-----------------------------------------

The parent table, it contains data that is not to be translated.

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '',
  `display_order` int(11) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `display_order` (`display_order`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

The child table, it contains translations only. The field item_id is the
external key that is linked to the primary key of the parent table.

CREATE TABLE IF NOT EXISTS `slides_lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `lang` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

Then, you may create the following models.
------------------------------------------

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slides extends Core_Model {

    protected $check_for_existing_fields = true;
    public $protected_attributes = array('id');

    protected $_table = 'slides';
    protected $return_type = 'array';

    protected $lang_model_name = 'slides_lang';

    public function __construct() {

        parent::__construct();

        $this->user_id_getter = 'user_id_getter_for_models';

        $this->before_create[] = 'created_at';
        $this->before_create[] = 'created_by';

        $this->before_create[] = 'updated_at';
        $this->before_create[] = 'updated_by';

        $this->before_update[] = 'updated_at';
        $this->before_update[] = 'updated_by';
    }

    public function get_name($id, $language = null, $with_translation_fallback = false, $fall_back_template = null) {

        if ($fall_back_template === null) {
            $fall_back_template = 'Slide #{id}';
        }

        return $this->lang($id, 'name', $language, $with_translation_fallback, $fall_back_template);
    }

    public function get_content($id, $language = null, $with_translation_fallback = false, $fall_back_template = null) {

        return $this->lang($id, 'content', $language, $with_translation_fallback, $fall_back_template);
    }

}

and

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slides_lang extends Core_Lang_Model {

    protected $_table = 'slides_lang';

    public function __construct() {

        parent::__construct();
    }

}

Usage
-----

$this->load->model('slides');

$id = 1;    // The current slide to be processed.

// Get some translations - the generic method, examples.

$name = $this->slides->lang($id, 'name');               // This is the name of the slide in the current language.
$name = $this->slides->lang($id, 'name', 'bulgarian');  // This is the name of the slide in Bulgarian language.
$name = $this->slides->lang($id, 'name', 'bulgarian', true);   // Enforce translation fallback.
$name = $this->slides->lang($id, 'name', null, true, 'Slide #{id}');  // Enforce translation fallback with template failed translation, the language is the current one.

$translations = $this->slides->lang($id, array('name', 'content')); // Get translated values as an associative array.

// Get some translations - custom methods (not mandatory to be defined and used).

$name = $this->slides->get_name($id);
$name = $this->slides->get_name($id, 'bulgarian');
$name = $this->slides->get_name($id, 'bulgarian', true);
$name = $this->slides->get_name($id, null, true);

$content = $this->slides->get_content($id);                 // Etc.

// Set translations, examples.

$this->slides->set_lang($id, 'name', 'Test Name');          // Set the name in the current language.
$this->slides->set_lang($id, array('name' => 'Test Name', 'content' => '<h1>Test Content</h1>');    // Set name and content in the current language.
$this->slides->set_lang($id, 'name', 'Test Name', 'english);// Set the name in the current language.
$this->slides->set_lang($id, array('name' => 'Test Name', 'content' => '<h1>Test Content</h1>', null, 'english');   // Etc.

// Delete translations.

$this->slides->delete_lang($id);                            // Deletes the whole translation for the current language.
$this->slides->delete_lang($id, 'english');                 // Deletes the whole translation for English language.

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Lang_Model extends Core_Model {

    protected $check_for_existing_fields = true;
    public $protected_attributes = array('id');
    protected $external_key_field = 'item_id';
    protected $lang_field = 'lang';
    public $translations = array();     // A list of the translated fields, a public property,
                                        // if list autodetection fails, set it manually at the extender class.

    public function __construct() {

        parent::__construct();

        if (empty($this->translations)) {

            // Autodetect fields containing translations.

            $this->translations = array_keys(array_except(array_flip($this->fields()), array(
                $this->primary_key,
                $this->external_key_field,
                $this->lang_field,
            )));
        }
    }

    /**
     * Gets translated string from the specified field by the specified parent id.
     * @deprecated Use lang() method instead.
     *
     * @param int           $id                         The id from the parent table.
     * @param string/array  $field                      The target translated field, or an array of target field names.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @param boolean       $with_translation_fallback  Turn on/off translation fallback.
     * @param string        $fall_back_template         A template for the returned value if fallback translation fails. Example: '{field} #{id}'
     * @return string/array                             Returns the translated string or an associative array of translated strings.
     */
    public function get_lang($id, $field, $language = null, $with_translation_fallback = true, $fall_back_template = null) {

        return $this->lang($id, $field, $language, $with_translation_fallback, $fall_back_template);
    }

    /**
     * Gets translated string from the specified field by the specified parent id.
     *
     * @param int           $id                         The id from the parent table.
     * @param string/array  $field                      The target translated field, or an array of target field names.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @param boolean       $with_translation_fallback  Turn on/off translation fallback.
     * @param string        $fall_back_template         A template for the returned value if fallback translation fails. Example: '{field} #{id}'
     * @return string/array                             Returns the translated string or an associative array of translated strings.
     */
    public function lang($id, $field, $language = null, $with_translation_fallback = false, $fall_back_template = null) {

        if (is_array($field)) {

            $result = array();

            foreach ($field as $f) {
                $result[$f] = $this->lang($id, $f, $language, $with_translation_fallback, $fall_back_template);
            }

            return $result;
        }

        $id = (int) $id;

        // Try to find the value in the specified language.
        $result = $this
            ->where($this->external_key_field, $id)
            ->where($this->lang_field, $this->lang->code($language))
            ->value($field);

        if ($result === null && $with_translation_fallback) {

            // Try to find the value in English language.
            $result = $this->lang($id, $field, $this->lang->english(), false);

            if ($result === null) {

                // Try to find an existing value in some language.
                $result = $this
                    ->where($this->external_key_field, $id)
                    ->order_by($this->primary_key, 'asc')
                    ->value($field);

                if ($result === null) {

                    if ($fall_back_template === null) {

                        // Give up.
                        $result = null;

                    } else {

                        // Return value based on the given fallback template.
                        $result = str_replace('{field}', $field, str_replace('{id}', $id, $fall_back_template));
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Sets translated string on the specified field at the specified parent id.
     * An associated array of strings can be set too.
     *
     * @param int           $id                         The id from the parent table.
     * @param string/array  $field                      The target translated field, or an array of target field names.
     * @param string        $value                      The string in correspondent language.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @return object                                   Returns this instance.
     */
    public function set_lang($id, $field, $value = null, $language = null) {

        $id = (int) $id;

        $lang = $this->lang->code($language);

        if ($lang == '') {
            return $this;
        }

        if (is_array($field)) {
            $data = array_only($field, $this->translations);
        } else {
            $data = array_only(array($field => $value), $this->translations);
        }

        if (empty($data)) {
            return $this;
        }

        $record = $this
            ->where($this->external_key_field, $id)
            ->where($this->lang_field, $lang)
            ->as_array()
            ->first();

        if ($record === null) {

            $nulls_only = true;

            foreach ($data as $value) {

                if ($value !== null) {

                    $nulls_only = false;
                    break;
                }
            }

            if ($nulls_only) {
                return $this;
            }

            $data = array_merge(array($this->external_key_field => $id, $this->lang_field => $lang), $data);

            $this->insert($data);

        } else {

            $primary_id = (int) $record[$this->primary_key];

            $data = array_replace(array_only($record, $this->translations), $data);

            $nulls_only = true;

            foreach ($data as $value) {

                if ($value !== null) {

                    $nulls_only = false;
                    break;
                }
            }

            if ($nulls_only) {
                $this->delete($primary_id);
            } else {
                $this->update($primary_id, $data);
            }
        }

        return $this;
    }

    /**
     * Deletes a whole translation, specified by the id from the parent table and language.
     *
     * @param int           $id                         The id from the parent table.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @return object                                   Returns this instance.
     */
    public function delete_lang($id, $language = null) {

        $id = (int) $id;

        $this
            ->where($this->external_key_field, $id)
            ->where($this->lang_field, $this->lang->code($language))
            ->delete_by();

        return $this;
    }

    /**
     * Deletes all the translations specified by the id from the parent table.
     *
     * @param int           $id                         The id from the parent table.
     * @return object                                   Returns this instance.
     */
    public function delete_langs($id) {

        $id = (int) $id;

        $this
            ->where($this->external_key_field, $id)
            ->delete_many_by();

        return $this;
    }

    /**
     * Checks whether a translation exists, specified by the id from the parent table and language.
     *
     * @param int           $id                         The id from the parent table.
     * @param string        $language                   The desired language (the current language if nothing has been specified).
     * @return boolean
     */
    public function lang_exists($id, $language = null) {

        $id = (int) $id;

        $row = $this
            ->select($this->external_key_field)
            ->where($this->external_key_field, $id)
            ->where('lang', $this->lang->code($language))
            ->as_array()
            ->first();

        return !empty($row);
    }

}
