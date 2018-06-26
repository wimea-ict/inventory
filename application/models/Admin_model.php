<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Count the number of items whose quantity in is zero
     * Plus items given out that have gone beyond the expected return date.
     */
    public function get_num_need_attention() {
        // Count items whose quantity is zero.
        $items = $this->items_model->get_items();

        $count_need_attention['items'] = 0;
        foreach ($items as $item) {
            if ($item['number_in'] == 0) {
                ++$count_need_attention['items'];
            }
        }

        // Count items given out that have exceeded the expected return date.
        $sql = sprintf("SELECT id, date_out, duration_out FROM items_given_out
                        WHERE status = 'pending'");
        $query = $this->db->query($sql);
        $transactions = $query->result_array();

        $count_need_attention['transactions'] = 0;
        foreach ($transactions as $transaction) {
            $expected_return_date = new DateTime(date('Y-m-d', strtotime("{$transaction['date_out']} +{$transaction['duration_out']}")));

            // We start reporting one day past the expected return date.
            if (new DateTime() > $expected_return_date->add(new DateInterval('P1D'))) {
                ++$count_need_attention['transactions'];
            }
        }

        return $count_need_attention;
    }

    public function get_items_need_attention() {
        $items = $this->items_model->get_items();

        $need_attention = [];
        foreach ($items as $item) {
            if ($item['number_in'] == 0) {
                $need_attention[] = $item;
            }
        }

        return $need_attention;
    }

    public function get_transactions_need_attention() {
        $sql = sprintf("SELECT * FROM items_given_out WHERE status = 'pending'");
        $query = $this->db->query($sql);
        $transactions = $query->result_array();

        $need_attention = [];
        foreach ($transactions as $transaction) {
            $expected_return_date = new DateTime(date('Y-m-d', strtotime("{$transaction['date_out']} +{$transaction['duration_out']}")));

            // We start reporting one day past the expected return date.
            if (new DateTime() > $expected_return_date->add(new DateInterval('P1D'))) {
                $this->transactions_model->get_items_in_transaction($transaction, 'items_given_out');
                $need_attention[] = $transaction;
            }
        }

        return $need_attention;
    }
}
?>