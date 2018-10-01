<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->has_userdata('user') == false) {
            redirect(base_url('auth/login'));
        }

        $this->load->model([
            'items_model',
            'categories_model',
            'transactions_model'
        ]);
    }

    public function index() {
        $data['items'] = $this->items_model->get_items();
        $content = $this->load->view('items/all', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Items',
            'content' => $content
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_id = $this->input->post('category');
            $item_name = $this->input->post('item_name');
            $this->items_model->create_item($item_name, $category_id);

            redirect(base_url('items'));
        }

        $categories = $this->categories_model->get_categories();
        if (count($categories) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no categories on record. Please create categories to conitnue.',
                'message_class' => 'danger'
            ]);
        }

        $data['categories'] = $categories;
        $data['panel_heading'] = 'Create New Item';
        $data['form_action'] = base_url('items/create');
        $content = $this->load->view('items/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Create New Item',
            'content' => $content
        ]);
    }

    public function edit($item_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_id = $this->input->post('item_id');
            $item_name = $this->input->post('item_name');
            $item_category = $this->input->post('category');
            $this->items_model->update_item($item_id, $item_name, $item_category);

            $this->session->set_flashdata([
                'message' => 'Item successfully updated.',
                'message_class' => 'success'
            ]);
            redirect(base_url('items'));
        }

        $item = $this->items_model->get_item($item_id);
        if ($item == false) {
            show_404();
        }

        $data['item'] = $item;
        $data['categories'] = $this->categories_model->get_categories();
        $data['panel_heading'] = 'Edit Item';
        $data['form_action'] = base_url("items/edit/{$item_id}");
        $content = $this->load->view('items/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Edit Item',
            'content' => $content
        ]);
    }

    public function new_batch() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $items = $this->input->post('items[]');
            $quantities = $this->input->post('quantities[]');

            $message = '';  // Message returned to the user.

            $batch_items = [];
            for ($i = 0; $i < count($items); ++$i) {
                if ($quantities[$i] == false) {
                    // Quantity is zero or wasn't entered at all.
                    $message = 'Incorrect quantities entered. Please try again.';
                }

                $batch_items[] = [
                    'id' => $items[$i],
                    'quantity' => $quantities[$i]
                ];
            }

            $date_brought = $this->input->post('date_brought');

            // Check for duplicate selection of items.
            if (count($items) != count(array_unique($items))) {
                $message = 'Repetitions detected in items selected. Please try again.';
            }

            if ($message == '') {
                $this->items_model->create_new_batch($batch_items, $date_brought);
                redirect(base_url('transactions/new-batches'));
            }
            else {
                $this->session->set_flashdata([
                    'message' => $message,
                    'message_class' => 'danger'
                ]);

                $data['date_brought'] = $date_brought;
            }
        }

        $items = $this->items_model->get_items();
        if (count($items) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no items on record. Please create items to continue.',
                'message_class' => 'danger'
            ]);
        }

        $data['items'] = $items;
        $content = $this->load->view('items/new-batch', $data, TRUE);

        if (is_ajax_request()) {
            echo json_encode([
                'html' => $content,
                'title' => 'New Transaction'
            ]);
            return;
        }

        $this->load->view('main', [
            'title' => 'New Transaction',
            'content' => $content
        ]);
    }

    public function give_out() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $items = $this->input->post('items');
            $quantities = $this->input->post('quantities');

            $message = '';  // Message returned to the user.

            $items_given_out = [];
            for ($i = 0; $i < count($items); ++$i) {
                if ($quantities[$i] == false) {
                    // Quantity is zero or wasn't entered at all.
                    $message = 'Incorrect quantities entered. Please try again.';
                }

                $items_given_out[] = [
                    'id' => $items[$i],
                    'quantity' => $quantities[$i]
                ];
            }

            $receiver = [
                'name' => $this->input->post('receiver_name'),
                'email' => $this->input->post('email'),
                'contacts' => $this->input->post('contacts')
            ];
            $reason = $this->input->post('reason');
            $date_out = $this->input->post('date_out');

            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $duration_out = "{$duration} {$duration_unit}";

            // Check for duplicate selection of items.
            if (count($items) != count(array_unique($items))) {
                $message = 'Repetitions detected in items selected. Please try again.';
            }

            if ($message == '') {
                $this->items_model->give_out_items($items_given_out, $receiver, $reason, $date_out, $duration_out);
                redirect(base_url('transactions/items-given-out'));
            }
            else {
                $this->session->set_flashdata([
                    'message' => $message,
                    'message_class' => 'danger'
                ]);

                $data = [
                    'receiver' => $receiver,
                    'reason' => $reason,
                    'date_out' => $date_out,
                    'duration' => $duration,
                    'duration_unit' => $duration_unit
                ];
            }
        }

        $items = $this->items_model->get_items();
        if (count($items) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no items on record. Please create items to continue.',
                'message_class' => 'danger'
            ]);
        }

        $data['items'] = $items;
        $content = $this->load->view('items/give-out', $data, TRUE);

        if (is_ajax_request()) {
            echo json_encode([
                'html' => $content,
                'title' => 'New Transaction'
            ]);
            return;
        }

        $this->load->view('main', [
            'title' => 'New Transaction',
            'content' => $content
        ]);
    }

    /**
     * Returning items is a three step process.
     *      1. User views a list of transactions whose items haven't been fully returned.
     *      2. User selects a transaction to return the items.
     *      3. User fill in the number for each item being returned.
     */
    public function return_items($transaction_id = NULL) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $items = $this->input->post('items');
            $quantities = $this->input->post('quantities');

            $returned_items = [];
            for ($i = 0; $i < count($items); ++$i) {
                if ($quantities[$i] == false) {
                    // Quantity is zero or wasn't entered at all.
                    // Skip this item.
                    continue;
                }

                $returned_items[] = [
                    'id' => $items[$i],
                    'quantity' => $quantities[$i]
                ];
            }

            $date_returned = $this->input->post('date_returned');
            $comments = $this->input->post('comments');
            $items_out_id = $this->input->post('items_out_id');
            $this->items_model->return_items($items_out_id, $returned_items, $date_returned, $comments);

            redirect(base_url("transactions/items-returned"));
        }

        if ($transaction_id != NULL) {
            $transaction = $this->transactions_model->get_transaction($transaction_id, 'items_out');
            if ($transaction == false) {
                show_404();
            }

            $data['transaction'] = $transaction;
            $content = $this->load->view('transactions/single-transaction/return-items', $data, TRUE);
        }
        else {
            $_SESSION['message'] = 'Please select a transaction to return the items. You can always search by name or email address.';
            $_SESSION['message_class'] = 'info';

            $data['transactions'] = $this->transactions_model->get_items_given_out('pending');
            $content = $this->load->view('items/return-items', $data, TRUE);
        }

        if (is_ajax_request()) {
            echo json_encode([
                'html' => $content,
                'title' => 'New Transaction'
            ]);
            return;
        }

        $this->load->view('main', [
            'title' => 'New Transaction',
            'content' => $content
        ]);
    }
}
?>
