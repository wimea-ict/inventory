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
		$content = $this->load->view('stations/give-out', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Give Out Station',
			'content' => $content
		]);
	}
}
