<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_new_batches() {
        $sql = sprintf("SELECT * FROM new_batches");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return [];
        }

        $batches = $query->result_array();

        // Get the items in each batch.
        foreach ($batches as &$batch) {
            $batch['items'] = [];

            $sql = sprintf("SELECT ti.*, items.name FROM transaction_items ti
                            LEFT JOIN items ON(ti.item_id = items.id)
                            WHERE (transaction_id = %d AND transaction_type = 'new_batch')",
                            $batch['id']);
            $query = $this->db->query($sql);

            $results = $query->result_array();
            foreach ($results as $r) {
                $batch['items'][] = $r;
            }
        }
        unset($batch);

        return $batches;
    }
}
?>