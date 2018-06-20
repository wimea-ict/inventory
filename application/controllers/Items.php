<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model(['items_model', 'categories_model']);
    }

    public function index() {
        $items = $this->items_model->get_items();
        if (count($items) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no items on record. Please create items to continue.',
                'message_class' => 'warning'
            ]);
        }
        $data['items'] = $items;
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
        $content = $this->load->view('items/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Edit Item',
            'content' => $content
        ]);
    }
}
?>