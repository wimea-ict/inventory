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
