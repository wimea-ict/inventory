<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_transaction($transaction_id, $transaction_type) {
        // Determine which table to SELECT FROM.
        switch ($transaction_type) {
            case 'new_batch':
                $sql = sprintf("SELECT * FROM new_batches WHERE id = %d",
                                $transaction_id);
                break;
            case 'items_out':
                $sql = sprintf("SELECT * FROM items_given_out WHERE id = %d",
                                $transaction_id);
                break;
            case 'items_returned':
                $sql = sprintf("SELECT io.name, io.email, io.contacts, io.name, ir.*
                                FROM items_returned ir
                                LEFT JOIN items_given_out io ON(ir.items_out_id = io.id)
                                WHERE ir.id = %d", $transaction_id);
                break;
            default:
                // Do nothing.
                break;
        }

        // Perform the SELECT.
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        $transaction = $query->row_array();

        // Get transaction items.
        $this->get_items_in_transaction($transaction, $transaction_type);

        return $transaction;
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

    public function get_items_returned() {
        $sql = sprintf("SELECT io.name, io.email, io.contacts, io.name, ir.*
                        FROM items_returned ir
                        LEFT JOIN items_given_out io ON(ir.items_out_id = io.id)
                        ORDER BY date_entered DESC");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return [];
        }

        $transactions = $query->result_array();

        // Get the items in each transaction.
        foreach ($transactions as &$transaction) {
            $this->get_items_in_transaction($transaction, 'new_batch');
        }
        unset($transaction);

        return $transactions;
    }

    /**
     * @param status [pending, cleared or all]
     */
    public function get_items_given_out($status = 'all') {
        if ($status == 'all') {
            $sql = sprintf("SELECT * FROM items_given_out ORDER BY date_entered DESC");
        }
        else {
            $sql = sprintf("SELECT * FROM items_given_out WHERE status = %s
                            ORDER BY date_entered DESC", $this->db->escape($status));
        }

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

        $sql = sprintf("SELECT ti.item_id, ti.quantity, items.name FROM transaction_items ti
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