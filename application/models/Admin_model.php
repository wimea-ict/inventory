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

        $count_need_attention = 0;
        foreach ($items as $item) {
            if ($item['number_in'] == 0) {
                ++$count_need_attention;
            }
        }

        // Count items given out that have exceeded the expected return date.
        $sql = sprintf("SELECT id, date_out, duration_out FROM items_given_out
                        WHERE status = 'pending'");
        $query = $this->db->query($sql);
        $results = $query->result_array();
        foreach ($results as $r) {
            $expected_return_date = new DateTime(date('Y-m-d H:i:s', strtotime("{$r['date_out']} +{$r['duration_out']}")));
            if (new DateTime() > $expected_return_date) {
                ++$count_need_attention;
            }
        }

        return $count_need_attention;
    }
}
?>