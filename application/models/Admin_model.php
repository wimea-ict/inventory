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

    public function get_timeline_items() {
        $timeline_items = [];

        $users = $this->users_model->get_users();
        foreach ($users as $user) {
            $timeline_items[] = $user;
        }

        $items = $this->items_model->get_items();
        foreach ($items as $item) {
            $timeline_items[] = $item;
        }

        $categories = $this->categories_model->get_categories();
        foreach ($categories as $category) {
            $timeline_items[] = $category;
        }

        $new_batches = $this->transactions_model->get_new_batches();
        foreach ($new_batches as $transaction) {
            $timeline_items[] = $transaction;
        }

        $items_returned = $this->transactions_model->get_items_returned();
        foreach ($items_returned as $transaction) {
            $timeline_items[] = $transaction;
        }

        $items_given_out = $this->transactions_model->get_items_given_out();
        foreach ($items_given_out as $transaction) {
            $timeline_items[] = $transaction;
        }

        // Sort timeline items by date.
        usort($timeline_items, self::build_sorter('date_entered'));

        return $timeline_items;
    }

    /**
     * Closure used for sorting notifications.
     *
     * @param $key the field that will be used for sorting.
     */
    private static function build_sorter($key) {
        return function ($a, $b) use ($key) {
            return new DateTime($a[$key]) < new DateTime($b[$key]);
        };
    }
}
?>