<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends CI_Controller {
	public function __construct() {
		parent::__construct();

        if ($this->session->has_userdata('user') == false) {
            redirect(base_url('auth/login'));
        }

        $this->load->model([
			'items_model',
			'stations_model'
        ]);
	}

	public function index() {
		$data = [];
        $content = $this->load->view('stations/given-out', $data, TRUE);

        $this->load->view('main', [
            'title' => 'Stations Given Out',
            'content' => $content
        ]);
	}

	public function node($node_id) {
		$data = [];
		$data['node'] = $this->stations_model->get_node($node_id);
		$content = $this->load->view('stations/node', $data, TRUE);

		$this->load->view('main', [
			'title' => '2m Node',
			'content' => $content
		]);
	}

	public function nodes() {
		$data = [];
		$data['nodes'] = $this->stations_model->get_nodes();
		$content = $this->load->view('stations/nodes', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Nodes',
			'content' => $content
		]);
	}

	public function give_out() {
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$nodes = $this->input->post('nodes');
			$num_stations = $this->input->post('num_stations');
			$country = $this->input->post('country');
			$date_out = $this->input->post('date_out');
			$receiver = [
				'name' => $this->input->post('receiver_name'),
				'email' => $this->input->post('email'),
				'contacts' => $this->input->post('contacts')
			];

			if (count($nodes) == 0) {
				$this->session->set_flashdata([
					'message' => 'Please select the nodes for the station.',
					'message_class' => 'danger'
				]);
				$data['receiver'] = $receiver;
				$data['num_stations'] = $num_stations;
				$data['country_id'] = $country;
				$data['date_out'] = $date_out;
			}
			else {
				$this->stations_model->give_out($nodes, $num_stations, $receiver, $country, $date_out);
			}
		}

		$nodes = $this->stations_model->get_nodes(false);
		$countries = $this->stations_model->get_countries();
        if (count($countries) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no countries on record. Please insert the countries to conitnue.',
                'message_class' => 'danger'
            ]);
        }
        if (count($nodes) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no nodes on record. Please create nodes to conitnue.',
                'message_class' => 'danger'
            ]);
		}

		$data['nodes'] = $nodes;
		$data['countries'] = $countries;
		$content = $this->load->view('stations/give-out', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Give Out Station',
			'content' => $content
		]);
	}
}