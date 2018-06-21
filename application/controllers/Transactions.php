<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->has_userdata('user') == false) {
            redirect(base_url('auth/login'));
        }

        $this->load->model(['transactions_model']);
    }

    public function new_batches() {
        $data['batches'] = $this->transactions_model->get_new_batches();
        $content = $this->load->view('transactions/new-batches', $data, TRUE);
        $this->load->view('main', [
            'title' => 'New Batches',
            'content' => $content
        ]);
    }
}
?>