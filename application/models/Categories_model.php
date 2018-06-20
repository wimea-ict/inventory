<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_category($category_id) {
        $sql = sprintf("SELECT * FROM categories WHERE id = %d", $category_id);
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row_array();
    }

    public function get_categories() {
        $sql = sprintf("SELECT * FROM categories ORDER BY date_updated DESC");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return [];
        }

        $categories = $query->result_array();

        // Get the number of items in each category.
        $sql = sprintf("SELECT category_id, COUNT(*) AS num_items
                        FROM items GROUP BY category_id");
        $query = $this->db->query($sql);
        $results = $query->result_array();
        foreach ($categories as &$c) {
            $c['num_items'] = 0;
            foreach ($results as $r) {
                if ($r['category_id'] == $c['id']) {
                    $c['num_items'] = $r['num_items'];
                }
            }
        }
        unset($c);

        return $categories;
    }

    public function create_category($category_name) {
        $sql = sprintf("INSERT INTO categories (name) VALUES (%s)",
                        $this->db->escape($category_name));
        $this->db->query($sql);
    }

    public function update_category($category_id, $category_name) {
        $sql = sprintf("UPDATE categories SET name = %s WHERE id = %d",
                        $this->db->escape($category_name), $category_id);
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}
?>