<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_countries() {
		$sql = sprintf("SELECT * FROM countries");
		$query = $this->db->query($sql);
		$results = $query->result_array();

		return $results;
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
		$sql = sprintf("SELECT * FROM nodes");
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

    public function get_node_items(&$node) {
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

	public function give_out($nodes, $num_stations, $receiver, $country, $date_out) {
		// Record the transaction.
		$sql = sprintf("INSERT INTO stations_given_out (name, email, contacts, country, number_out, date_out)
						VALUES(%s, %s, %s, %d, %d, %s)",
						$this->db->escape($receiver['name']), $this->db->escape($receiver['email']),
						$this->db->escape($receiver['contacts']),
						$country, $num_stations, $this->db->escape($date_out));
		$this->db->query($sql);

		$station_out_id = $this->db->insert_id();

		// Record the nodes
		foreach ($nodes as $node_id) {
			$sql = sprintf("INSERT INTO station_out_nodes (station_out_id, node_id) VALUES (%d, %d)",
							$station_out_id, $node_id);
			$this->db->query($sql);
		}
	}
}
