<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station_node_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function create_node($name, $items) {
		// Record the node
		$sql = sprintf("INSERT INTO nodes (name) VALUES (%s)", $this->db->escape("$name"));
		$this->db->query($sql);

		// Record the node items
		$node_id = $this->db->insert_id();
        foreach ($items as $item) {
            $sql = sprintf("INSERT INTO node_items
                                (node_id, item_id, quantity)
                                VALUES(%d, %d, %d)",
                                $node_id, $item['id'], $item['quantity']);
            $this->db->query($sql);
        }
	}

	public function remove_item($node_id, $item_id) {
		$sql = sprintf("DELETE FROM node_items
						WHERE (node_id = %d AND item_id = %d) LIMIT 1",
						$node_id, $item_id);
		$this->db->query($sql);
	}

	public function add_items($node_id, $items) {
		foreach ($items as $item) {
			$sql = sprintf("INSERT INTO node_items (node_id, item_id, quantity) VALUES (%d, %d, %d)",
							$node_id, $item['id'], $item['quantity']);
			$this->db->query($sql);
		}
	}
}

?>
