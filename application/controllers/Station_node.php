<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station_node extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model(['items_model', 'stations_model', 'station_node_model']);
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
                $this->station_node_model->create_node($name, $node_items);
                redirect(site_url('stations/nodes'));
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
		$content = $this->load->view('nodes/create', $data, TRUE);

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
                $this->station_node_model->add_items($node_id, $added_items);
                redirect(site_url("stations/node/{$node_id}"));
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

		$data['node'] = $this->stations_model->get_node($node_id);
		$data['items'] = $this->items_model->get_items();
		$content = $this->load->view('nodes/add-items', $data, TRUE);

		$this->load->view('main', [
			'title' => 'Add Items',
			'content' => $content
		]);
	}

	public function remove_item($node_id, $item_id) {
		$this->station_node_model->remove_item($node_id, $item_id);

		$this->session->set_flashdata([
			'message' => 'Item successfully removed.',
			'message_class' => 'success'
		]);
		redirect(site_url("stations/node/{$node_id}"));
	}
}
?>
