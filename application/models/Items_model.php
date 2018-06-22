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
            $number_in_new_batches = $this->get_number_in_transaction_type($item['id'], 'new_batch');
            $number_given_out = $this->get_number_in_transaction_type($item['id'], 'items_out');
            $number_returned = $this->get_number_in_transaction_type($item['id'], 'items_returned');
            
            $item['number_in'] = ($number_in_new_batches - $number_given_out + $number_returned);
            $item['number_out'] = ($number_given_out - $number_returned);
        }
        unset($item);
        
        return $items;
    }

    public function create_new_batch($batch_items, $date_brought) {
        // Record transaction.
        $sql = sprintf("INSERT INTO new_batches (date_brought) VALUES(%s)",
                        $this->db->escape($date_brought));
        $this->db->query($sql);

        $new_batch_id = $this->db->insert_id();
        $this->record_transaction_items($new_batch_id, 'new_batch', $batch_items);
    }

    public function give_out_items($items_given_out, $receiver, $reason, $date_out, $duration_out) {
        // Record the transaction.
        $sql = sprintf("INSERT INTO items_given_out (name, contacts, email, reason, date_out, duration_out)
                        VALUES(%s, %s, %s, %s, %s, %s)",
                        $this->db->escape($receiver['name']), $this->db->escape($receiver['contacts']),
                        $this->db->escape($receiver['email']), $this->db->escape($reason),
                        $this->db->escape($date_out), $this->db->escape($duration_out));
        $this->db->query($sql);

        $items_out_id = $this->db->insert_id();
        $this->record_transaction_items($items_out_id, 'items_out', $items_given_out);
    }

    public function return_items($items_out_id, $returned_items, $date_returned, $comments) {
        // Record the transaction.
        $sql = sprintf("INSERT INTO items_returned (items_out_id, date_returned, comments)
                        VALUES(%d, %s, %s)", $items_out_id,
                        $this->db->escape($date_returned), $this->db->escape($comments));
        $this->db->query($sql);

        $items_returned_id = $this->db->insert_id();
        $this->record_transaction_items($items_returned_id, 'items_returned', $returned_items);

        // Were all items returned?
        $items_out_transaction = $this->transactions_model->get_transaction($items_out_id, 'items_out');
        $items_taken_out = $items_out_transaction['items'];

        $all_items_returned = TRUE;

        // Too much nesting, but bare with me on this one.
        foreach ($returned_items as $item_returned) {
            foreach ($items_taken_out as $item_taken_out) {
                if ($item_taken_out['item_id'] == $item_returned['id']) {
                    if ($item_taken_out['quantity'] != $item_returned['quantity']) {
                        $all_items_returned = false;
                    }
                }
            }
        }

        if ($all_items_returned == TRUE) {
            $sql = sprintf("UPDATE items_given_out
                            SET status = 'returned'
                            WHERE id = %d", $items_out_id);
            $this->db->query($sql);
        }
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

        return $number;
    }

    private function record_transaction_items($transaction_id, $transaction_type, $items) {
        foreach ($items as $item) {
            $sql = sprintf("INSERT INTO transaction_items
                                (transaction_id, transaction_type, item_id, quantity)
                                VALUES(%d, %s, %d, %d)",
                                $transaction_id, $this->db->escape($transaction_type), $item['id'], $item['quantity']);
            $this->db->query($sql);
        }
    }
}
?>