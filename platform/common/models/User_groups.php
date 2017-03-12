<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_groups extends CI_Model {

    protected $items;
    protected $cache;

    protected $lang;

    public function __construct() {

        parent::__construct();

        $this->lang = get_instance()->lang;

        $this->items= array(
            array(
                'id' => 1,
                'name' => $this->lang->line('ui_administrators'),
            ),
            array(
                'id' => 2,
                'name' => $this->lang->line('ui_operators'),
            ),
            //array(
            //    'id' => 3,
            //    'name' => $this->lang->line('ui_users'),
            //),
        );

        foreach ($this->items as $item) {

            $this->cache[(int) $item['id']] = $item;
        }
    }

    public function get($id) {

        $id = (int) $id;

        if (isset($this->cache[$id])) {
            return $this->cache[$id];
        }

        return array();
    }

    public function get_name($id) {

        $result = $this->get($id);

        if (empty($result)) {
            return null;
        }

        return $result['name'];
    }

    public function get_all() {

        return $this->items;
    }

    public function valid($id) {

        $data = $this->get($id);
        return !empty($data);
    }

    public function dropdown() {

        return array_column($this->get_all(), 'name', 'id');
    }

}
