<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function create_item($item_name, $category_id) {
        $sql = sprintf("INSERT INTO items (category_id, name) VALUES (%d, %s)",
                        $category_id, $this->db->escape($item_name));
        $this->db->query($sql);
    }

    public function update_item($item_id, $item_name, $item_category) {
        $sql = sprintf("UPDATE items SET name = %s, category_id = %d WHERE id = %d",
                        $this->db->escape($item_name), $item_category, $item_id);
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_item($item_id) {
        $sql = sprintf("SELECT * FROM items WHERE id = %d", $item_id);
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row_array();
    }

    public function get_items() {
        $sql = sprintf("SELECT items.*, categories.name AS category_name
                        FROM items
                        LEFT JOIN categories ON(items.category_id = categories.id)
                        ORDER BY items.date_updated DESC");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return [];
        }

        $items = $query->result_array();

        // Get for each item the number in and number out.
        // Formulae:
        //      Number In = (number_in_new_batches - number_given_out + number_returned)
        //      Number Out = (items_given_out - items_returned)
        foreach ($items as &$item) {
            $number_in_new_batchers = $this->get_number_in_transaction_type($item['id'], 'new_batch');
            $number_given_out = $this->get_number_in_transaction_type($item['id'], 'items_out');
            $number_returned = $this->get_number_in_transaction_type($item['id'], 'items_returned');
            
            $item['number_in'] = ($number_in_new_batchers - $number_given_out + $number_returned);
            $item['number_out'] = ($number_given_out - $number_returned);
        }
        unset($item);
        
        return $items;
    }

    private function get_number_in_transaction_type($item_id, $type) {
        $sql = sprintf("SELECT SUM(quantity) as total_quantity
                        FROM transaction_items
                        WHERE (item_id = %d AND transaction_type = %s)",
                        $item_id, $this->db->escape($type));
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            $number = 0;
        }
        else {
            $number = $query->row_array()['total_quantity'];
        }
    }
}
?>