<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_new_batches() {
        $sql = sprintf("SELECT * FROM new_batches ORDER BY date_entered DESC");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return [];
        }

        $batches = $query->result_array();

        // Get the items in each transaction.
        foreach ($batches as &$transaction) {
            $this->get_items_in_transaction($transaction, 'new_batch');
        }
        unset($transaction);

        return $batches;
    }

    public function get_items_given_out() {
        $sql = sprintf("SELECT * FROM items_given_out ORDER BY date_entered DESC");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return [];
        }

        $items_given_out = $query->result_array();

        // Get the items in each transaction.
        foreach ($items_given_out as &$transaction) {
            $this->get_items_in_transaction($transaction, 'items_out');
        }
        unset($transaction);

        return $items_given_out;
    }

    private function get_items_in_transaction(&$transaction, $transaction_type) {
        $transaction['items'] = [];

        $sql = sprintf("SELECT ti.*, items.name FROM transaction_items ti
                        LEFT JOIN items ON(ti.item_id = items.id)
                        WHERE (transaction_id = %d AND transaction_type = %s)",
                        $transaction['id'], $this->db->escape($transaction_type));
        $query = $this->db->query($sql);

        $results = $query->result_array();
        foreach ($results as $r) {
            $transaction['items'][] = $r;
        }
    }
}
?>