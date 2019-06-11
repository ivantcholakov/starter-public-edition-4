<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('display_order_up')) {

    function display_order_up($table, $id, $param = null, $sort_field = null, $primary_key = null) {

        if (is_object($table)) {
            $table = $table->table();
        }

        if ($sort_field == '') {
            $sort_field = 'display_order';
        }

        if ($primary_key == '') {
            $primary_key = 'id';
        }

        ci()->db
            ->select("t1.$primary_key AS id_t1, t1.$sort_field AS display_order_t1, t2.$sort_field AS display_order_t2")
            ->from("$table AS t1")
            ->join("$table AS t2", "t1.$sort_field < t2.$sort_field", 'inner')
            ->where("t2.$primary_key", $id);

        if (isset($param)) {
            ci()->db->where($param, null, false);
        }

        $row = ci()->db->order_by("t1.$sort_field", 'desc')->limit(1)->get()->row_array();

        if (!empty($row)) {

            $id_1 = $row['id_t1'];
            $display_order_t1 = $row['display_order_t1'];

            $id_2 = $id;
            $display_order_t2 = $row['display_order_t2'];

            ci()->db
                ->set("$sort_field", $display_order_t1)
                ->where("$primary_key", $id_2)
                ->update($table);

            ci()->db
                ->set("$sort_field", $display_order_t2)
                ->where("$primary_key", $id_1)
                ->update($table);
        }

    }

}

if (!function_exists('display_order_down')) {

    function display_order_down($table, $id, $param = null, $sort_field = null, $primary_key = null) {

        if (is_object($table)) {
            $table = $table->table();
        }

        if ($sort_field == '') {
            $sort_field = 'display_order';
        }

        if ($primary_key == '') {
            $primary_key = 'id';
        }

        ci()->db
            ->select("t1.$primary_key AS id_t1, t1.$sort_field AS display_order_t1, t2.$sort_field AS display_order_t2")
            ->from("$table AS t1")
            ->join("$table AS t2", "t1.$sort_field > t2.$sort_field", 'inner')
            ->where("t2.$primary_key", $id);

        if (isset($param)) {
            ci()->db->where($param, null, false);
        }

        $row = ci()->db->order_by("t1.$sort_field", 'asc')->limit(1)->get()->row_array();

        if (!empty($row)) {

            $id_1 = $row['id_t1'];
            $display_order_t1 = $row['display_order_t1'];

            $id_2 = $id;
            $display_order_t2 = $row['display_order_t2'];

            ci()->db
                ->set("$sort_field", $display_order_t1)
                ->where("$primary_key", $id_2)
                ->update($table);

            ci()->db
                ->set("$sort_field", $display_order_t2)
                ->where("$primary_key", $id_1)
                ->update($table);
        }

    }

}
