<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station_nodes_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_node($node_id) {
		// Get the node
		$sql = sprintf("SELECT * FROM nodes WHERE id = %d", $node_id);
		$query = $this->db->query($sql);
		$node = $query->row_array();

		// Get it's items
		$this->get_node_items($node);

		return $node;
	}

	public function get_nodes($include_items = true) {
		// Get the nodes.
		$sql = sprintf("SELECT * FROM nodes ORDER BY date_entered DESC");
		$query = $this->db->query($sql);
		$nodes = $query->result_array();

		if ($include_items) {
			// Get the items in each node.
			foreach ($nodes as &$node) {
				$this->get_node_items($node);
			}
			unset($node);
		}

		return $nodes;
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

    private function get_node_items(&$node) {
        $node['items'] = [];

        $sql = sprintf("SELECT ni.item_id, ni.quantity, items.name FROM node_items ni
                        LEFT JOIN items ON(ni.item_id = items.id)
                        WHERE (node_id = %d)", $node['id']);
        $query = $this->db->query($sql);

        $results = $query->result_array();
        foreach ($results as $r) {
            $node['items'][] = $r;
        }
	}
}

?>
