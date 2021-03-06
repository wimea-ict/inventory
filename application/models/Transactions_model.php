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
            $this->get_items_in_transaction($transaction, 'items_returned');
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

	public function get_stations_given_out() {
		$sql = sprintf("SELECT * FROM stations_given_out ORDER BY date_entered DESC");
		$query = $this->db->query($sql);

		$stations_given_out = $query->result_array();
		foreach ($stations_given_out as &$transaction) {
			$sql = sprintf("SELECT son.node_id, n.name FROM station_out_nodes son
							LEFT JOIN nodes n ON (n.id = son.node_id)
							WHERE (station_out_id = %d)", $transaction['id']);
			$query = $this->db->query($sql);
			$nodes = $query->result_array();

			$transaction['nodes'] = $nodes;
		}
		unset($transaction);

		return $stations_given_out;
	}

    public function get_num_transactions() {
        $sql = sprintf("SELECT COUNT(DISTINCT transaction_id, transaction_type) AS num_transactions
                        FROM transaction_items");
        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result['num_transactions'];
    }

    public function get_items_in_transaction(&$transaction, $transaction_type) {
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
