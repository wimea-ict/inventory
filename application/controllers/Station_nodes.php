<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station_nodes extends CI_Controller {
	public function __construct() {
		parent::__construct();

        if ($this->session->has_userdata('user') == false) {
            redirect(site_url('auth/login'));
        }

		$this->load->model(['items_model', 'station_nodes_model']);
	}

	public function index() {
		$data = [];
		$data['nodes'] = $this->station_nodes_model->get_nodes();
		$content = $this->load->view('station-nodes/all', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Nodes',
			'content' => $content
		]);
	}

	public function node($node_id) {
		$data = [];
		$data['node'] = $this->station_nodes_model->get_node($node_id);
		$content = $this->load->view('station-nodes/node', $data, TRUE);

		$this->load->view('main', [
			'title' => ucwords($data['node']['name']),
			'content' => $content
		]);
	}

	public function create() {
		$data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$name = $this->input->post("node_name");

            $items = $this->input->post('items');
            $quantities = $this->input->post('quantities');

            $message = '';  // Message returned to the user.

            $node_items = [];
            for ($i = 0; $i < count($items); ++$i) {
                if ($quantities[$i] == false) {
                    // Quantity is zero or wasn't entered at all.
                    $message = 'Incorrect quantities entered. Please try again.';
                }

                $node_items[] = [
                    'id' => $items[$i],
                    'quantity' => $quantities[$i]
                ];
            }

            // Check for duplicate selection of items.
            if (count($items) != count(array_unique($items))) {
                $message = 'Repetitions detected in items selected. Please try again.';
            }

            if ($message == '') {
                $this->station_nodes_model->create_node($name, $node_items);
                redirect(site_url('station-nodes'));
            }
            else {
                $this->session->set_flashdata([
                    'message' => $message,
                    'message_class' => 'danger'
                ]);

                $data = [
                    'node_name' => $name
                ];
            }
		}

		$data['items'] = $this->items_model->get_items();
		$content = $this->load->view('station-nodes/create', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Create Node',
			'content' => $content
		]);
	}

	public function add_items($node_id) {
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $items = $this->input->post('items');
            $quantities = $this->input->post('quantities');

            $message = '';  // Message returned to the user.

            $added_items = [];
            for ($i = 0; $i < count($items); ++$i) {
                if ($quantities[$i] == false) {
                    // Quantity is zero or wasn't entered at all.
                    $message = 'Incorrect quantities entered. Please try again.';
                }

                $added_items[] = [
                    'id' => $items[$i],
                    'quantity' => $quantities[$i]
                ];
            }

            // Check for duplicate selection of items.
            if (count($items) != count(array_unique($items))) {
                $message = 'Repetitions detected in items selected. Please try again.';
            }

            if ($message == '') {
                $this->station_nodes_model->add_items($node_id, $added_items);
                redirect(site_url("station-nodes/node/{$node_id}"));
            }
            else {
                $this->session->set_flashdata([
                    'message' => $message,
                    'message_class' => 'danger'
                ]);

                $data = [
                    'node_name' => $name
                ];
            }
		}

		$data['node'] = $this->station_nodes_model->get_node($node_id);
		$data['items'] = $this->items_model->get_items();
		$content = $this->load->view('station-nodes/add-items', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Add Items',
			'content' => $content
		]);
	}

	public function remove_item($node_id, $item_id) {
		$this->station_nodes_model->remove_item($node_id, $item_id);

		$this->session->set_flashdata([
			'message' => 'Item successfully removed.',
			'message_class' => 'success'
		]);
		redirect(site_url("station-nodes/node/{$node_id}"));
	}
}
?>
