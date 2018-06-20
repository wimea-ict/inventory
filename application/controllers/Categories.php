<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model(['categories_model']);
    }

    public function index() {
        $categories = $this->categories_model->get_categories();
        if (count($categories) == 0) {
            $this->session->set_flashdata([
                'message' => 'There are no categories on record. Please create categories to continue',
                'message_class' => 'danger'
            ]);
        }

        $data['categories'] = $categories;
        $content = $this->load->view('categories/all', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Categories',
            'content' => $content
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_name = $this->input->post('category_name');
            $this->categories_model->create($category_name);

            redirect(base_url('categories'));
        }
        $data = [];
        $content = $this->load->view('categories/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Create New Category',
            'content' => $content
        ]);
    }

    public function edit($category_id) {
        $category = $this->categories_model->get($category_id);
        if ($category == false) { show_404(); }
        
        $data['category'] = $category;
        $content = $this->load->view('categories/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Edit Category',
            'content' => $content
        ]);
    }
}
?>