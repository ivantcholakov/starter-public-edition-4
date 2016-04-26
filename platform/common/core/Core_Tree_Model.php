<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Code repository: https://github.com/ivantcholakov/codeigniter-base-model
 *
 * This is experimental and undocumented code. Examine and understand it before use.
 *
 * This model is intended to serve hierarhical structure within the table -
 * hierarhical set of pages, categories of products, etc., with internal
 * relationship id - parent_id (tree-like logical structure).
 *
 * A quick example that tests everithing (create Pages model that extends Core_Tree_Model):
 *
 * // Converting and dumping the tree structure as a list.
 * $menu = $this->pages->get_list(
 *     null,                                                        // No root id specified, dump all.
 *     'name, slug, display_order',                                 // Which fields to select.
 *     array(array('display_on_menu', 1), array('left_menu', 1)),   // Where conditions.
 *     array('display_order', 'asc')                                // Order.
 * );
 * var_dump($menu);                                                 // The result rows are arrays, always.
 */

// If your system uses class autoloading feature,
// then the following require statement would not be needed.
//if (!class_exists('Core_Model', false)) {
//    require dirname(__FILE__).'/Core_Model.php';
//}

class Core_Tree_Model extends Core_Model {

    protected $parent_id_key = 'parent_id';
    protected $level_index = 'level';
    protected $children_index = 'children';
    protected $has_children_index = 'has_children';
    protected $children_count_index = 'children_count';
    protected $display_level_index = 'display_level';

    protected $tree_list_total_count = 0;

    protected $cache = null;

    public function __construct() {

        parent::__construct();

        $this->clear_cache();
    }

    public function clear_cache() {

        $this->cache = array();
    }

    public function get_parent($id) {

        $id = (int) $id;

        if (isset($this->cache[$id])) {

            if (array_key_exists('parent_id', $this->cache[$id])) {
                return $this->cache[$id]['parent_id'];
            }

        } else {

            $this->cache[$id] = array();
        }

        $db = clone $this;
        $db->reset_query();

        $parent_id = (int) $db->select($this->parent_id_key)->as_value()->get($id);
        $this->cache[$id]['parent_id'] = $parent_id;

        return $parent_id;
    }

    public function get_parents($id) {

        $id = (int) $id;

        $result = array();

        while (!empty($id)) {

            $id = $this->get_parent($id);

            if (!empty($id)) {
                $result[] = $id;
            }
        }

        return $result;
    }

    public function get_level($id) {

        $id = (int) $id;

        if (isset($this->cache[$id])) {

            if (array_key_exists('level', $this->cache[$id])) {
                return $this->cache[$id]['level'];
            }

        } else {

            $this->cache[$id] = array();
        }

        if (!isset($this->cache[$id]['level'])) {

            $this->cache[$id]['level'] = 0;
        }

        $parent_id = $id;

        while (!empty($parent_id)) {

            $parent_id = $this->get_parent($parent_id);

            if (!empty($parent_id)) {
                $this->cache[$id]['level']++;
            }
        }

        return $this->cache[$id]['level'];
    }

    public function contains($id, $child_id) {

        $id = (int) $id;
        $child_id = (int) $child_id;

        if (empty($id) || empty($child_id)) {
            return false;
        }

        if ($id == $child_id) {
            return true;
        }

        $child_id = $this->get_parent($child_id);

        return $this->contains($id, $child_id);
    }

    public function contains_one($id, $children_ids) {

        $id = (int) $id;

        if (!is_array($children_ids)) {
            $children_ids = array($children_ids);
        }

        foreach ($children_ids as $child_id) {

            if ($this->contains($id, $child_id)) {
                return true;
            }
        }

        return false;
    }

    public function contains_all($id, $children_ids) {

        $id = (int) $id;

        if (!is_array($children_ids)) {
            $children_ids = array($children_ids);
        }

        foreach ($children_ids as $child_id) {

            if (!$this->contains($id, $child_id)) {
                return false;
            }
        }

        return true;
    }

    public function has_children($id) {

        $id = (int) $id;

        if (isset($this->cache[$id])) {

            if (array_key_exists('has_children', $this->cache[$id])) {
                return $this->cache[$id]['has_children'];
            }

        } else {

            $this->cache[$id] = array();
        }

        $db = clone $this;
        $db->reset_query();

        $has_children = !is_null($db->select($this->primary_key)->as_value()->first($this->parent_id_key, $id));
        $this->cache[$id]['has_children'] = $has_children;

        return $has_children;
    }

    public function children_count($id) {

        $id = (int) $id;

        if (isset($this->cache[$id])) {

            if (array_key_exists('children_count', $this->cache[$id])) {
                return $this->cache[$id]['children_count'];
            }

        } else {

            $this->cache[$id] = array();
        }

        $db = clone $this;
        $db->reset_query();

        $children_count = (int) $db->select('COUNT('.$this->protect_identifiers($this->primary_key).')')->as_value()->first($this->parent_id_key, $id);
        $this->cache[$id]['children_count'] = $children_count;

        return $children_count;
    }

    public function get_children($id = null, $select = '', $where = array(), $order_by = array(), $depth = null) {

        $id = (int) $id;

        if (empty($id)) {

            $level = 0;

        } else {

            $level = $this->get_level($id);
            $level++;
        }

        if ($depth !== null) {

            $depth = (int) $depth;

            if ($depth < $level) {
                return null;
            }
        }

        if (!is_array($select)) {

            $select = trim($select);
            $select = $select == '' ? $this->_table.'.*' : $select;
            $select = explode(',', $select);

        } elseif (empty($select)) {

            $select = array($this->_table.'.*');
        }

        $select = array_merge(
            array(
                $this->_table.'.'.$this->primary_key,
                $this->_table.'.'.$this->parent_id_key,
                "$level AS {$this->level_index}"
            ),
            $select
        );

        $db = clone $this;

        $db->offset(0);
        $db->limit(PHP_INT_MAX);

        $db->select($select);

        if (is_array($where) && !empty($where)) {

            if ($this->_is_multidimensional_array($where)) {

                foreach ($where as $w) {

                    switch (count($w)) {

                        case 1:
                            $db->where($w[0]);
                            break;

                        case 2:
                            if (is_array($w[1])) {
                                $db->where_in($w[0], $w[1]);
                            } else {
                                $db->where($w[0], $w[1]);
                            }
                            break;

                        case 3:
                            if (is_array($w[1])) {
                                $db->where_in($w[0], $w[1], $w[2]);
                            } else {
                                $db->where($w[0], $w[1], $w[2]);
                            }
                            break;
                    }
                }

            } else {

                switch (count($where)) {

                    case 1:
                        $db->where($where[0]);
                        break;

                    case 2:
                        if (is_array($where[1])) {
                            $db->where_in($where[0], $where[1]);
                        } else {
                            $db->where($where[0], $where[1]);
                        }
                        break;

                    case 3:
                        if (is_array($where[1])) {
                            $db->where_in($where[0], $where[1], $where[2]);
                        } else {
                            $db->where($where[0], $where[1], $where[2]);
                        }
                        break;
                }
            }
        }

        if (is_array($order_by) && !empty($order_by)) {

            if ($this->_is_multidimensional_array($order_by)) {

                foreach ($order_by as $o) {

                    switch (count($o)) {

                        case 1:
                            $db->order_by($o[0]);
                            break;

                        case 2:
                            $db->order_by($o[0], $o[1]);
                            break;

                        case 3:
                            $db->order_by($o[0], $o[1], $o[2]);
                            break;
                    }
                }

            } else {

                switch (count($order_by)) {

                    case 1:
                        $db->order_by($order_by[0]);
                        break;

                    case 2:
                        $db->order_by($order_by[0], $order_by[1]);
                        break;

                    case 3:
                        $db->order_by($order_by[0], $order_by[1], $order_by[2]);
                        break;
                }
            }
        }

        if (empty($id)) {

            return $db
                ->group_start()
                    ->where($this->_table.'.'.$this->parent_id_key, 0)
                    ->or_where($this->_table.'.'.$this->parent_id_key, null)
                ->group_end()
                ->as_array()
                ->find();
        }

        return $db
            ->where($this->_table.'.'.$this->parent_id_key, $id)
            ->as_array()
            ->find();
    }

    public function get_tree($id = null, $select = '', $where = array(), $order_by = array(), $depth = null) {

        $id = (int) $id;

        $result = $this->get_children($id, $select, $where, $order_by, $depth);

        if (!empty($result)) {

            foreach ($result as $key => $row) {

                $children = $this->get_children($row[$this->primary_key], $select, $where, $order_by, $depth);

                if (!empty($children)) {

                    $result[$key][$this->children_index] = $children;
                    $result[$key][$this->has_children_index] = true;
                    $result[$key][$this->children_count_index] = count($children);

                } else {

                    $result[$key][$this->has_children_index] = false;
                    $result[$key][$this->children_count_index] = 0;
                }
            }

            $this->reset_query();

            return $result;
        }

        $this->reset_query();

        return null;
    }

    public function get_tree_list($id = null, $select = '', $where = array(), $order_by = array(), $depth = null) {

        // This code is not effective way for large results.

        $offset = $this->get_offset();
        $limit = $this->get_limit();

        $this->tree_list_total_count = 0;

        $result = $this->get_tree($id, $select, $where, $order_by, $depth);
        $result = $this->_tree_to_list($result);

        $this->tree_list_total_count = count($result);

        if ($offset !== false || $limit !== false) {

            $offset = (int) $offset;

            if ($limit === false) {
                return array_slice($result, $offset);
            }

            return array_slice($result, $offset, $limit);
        }

        return $result;
    }

    public function get_last_tree_list_total_count() {

        return $this->tree_list_total_count;
    }

    /**
     * @deprecated
     */
    public function get_list($id = null, $select = '', $where = array(), $order_by = array(), $depth = null) {

        return $this->get_tree_list($id, $select, $where, $order_by, $depth);
    }

    protected function _tree_to_list(& $tree, $display_level = 0) {

        $result = array();

        if (!empty($tree)) {

            foreach ($tree as $row) {

                $item = $row;

                if (isset($item[$this->children_index])) {
                    unset($item[$this->children_index]);
                }

                $item[$this->display_level_index] = $display_level;

                $result[] = $item;

                if (!empty($row[$this->children_index])) {
                    $result = array_merge($result, $this->_tree_to_list($row[$this->children_index], $display_level + 1));
                }
            }
        }

        return $result;
    }

    protected function _is_multidimensional_array($array) {

        foreach ($array as $element) {

            if (!is_array($element)) {

                return false;
            }
        }

        return true;
    }

    public function get_path($id, $select = '') {

        $result = array();

        $id = (int) $id;

        if (empty($id)) {
            return $result;
        }

        if (!is_array($select)) {

            $select = trim($select);
            $select = $select == '' ? $this->_table.'.*' : $select;
            $select = explode(',', $select);

        } elseif (empty($select)) {

            $select = array($this->_table.'.*');
        }

        $select = array_merge(
            array(
                $this->primary_key,
                $this->parent_id_key,
            ),
            $select
        );

        $item = $this->select($select)->as_array()->get($id);

        if (empty($item)) {
            return $result;
        }

        $result[] = $item;

        $parent_id = (int) $item[$this->parent_id_key];

        while (!empty($parent_id)) {

            $item = $this->select($select)->as_array()->get($parent_id);

            if (empty($item)) {
                break;
            }

            $result[] = $item;

            $parent_id = $this->get_parent($parent_id);
        }

        return array_reverse($result);
    }

}
