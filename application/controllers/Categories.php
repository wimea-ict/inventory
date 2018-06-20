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
            $this->categories_model->create_category($category_name);

            redirect(base_url('categories'));
        }
        $data['panel_heading'] = 'Create New Category';
        $content = $this->load->view('categories/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Create New Category',
            'content' => $content
        ]);
    }

    public function edit($category_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_id = $this->input->post('category_id');
            $category_name = $this->input->post('category_name');
            $this->categories_model->update_category($category_id, $category_name);

            $this->session->set_flashdata([
                'message' => 'Category successfully updated.',
                'message_class' => 'success'
            ]);
            redirect(base_url('categories'));
        }

        $category = $this->categories_model->get_category($category_id);
        if ($category == false) { show_404(); }
        
        $data['category'] = $category;
        $data['panel_heading'] = 'Edit Category';
        $content = $this->load->view('categories/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Edit Category',
            'content' => $content
        ]);
    }
}
?>