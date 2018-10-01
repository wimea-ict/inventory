<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_node($node_id) {
		// Get the node
		$sql = sprintf("SELECT * FROM station_nodes WHERE id = %d", $node_id);
		$query = $this->db->query($sql);
		$node = $query->row_array();

		// Get it's items
		$this->get_node_items($node);

		return $node;
	}

	public function get_nodes() {
		// Get the nodes.
		$sql = sprintf("SELECT * FROM station_nodes");
		$query = $this->db->query($sql);
		$nodes = $query->result_array();

		// Get the items in each node.
        foreach ($nodes as &$node) {
            $this->get_node_items($node);
        }
		unset($node);
		
		return $nodes;
	}

    public function get_node_items(&$node) {
        $node['items'] = [];

        $sql = sprintf("SELECT ni.item_id, ni.quantity, items.name FROM station_node_items ni
                        LEFT JOIN items ON(ni.item_id = items.id)
                        WHERE (station_node_id = %d)", $node['id']);
        $query = $this->db->query($sql);

        $results = $query->result_array();
        foreach ($results as $r) {
            $node['items'][] = $r;
        }
    }
}
