<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model(['reports_model', 'items_model', 'transactions_model']);
        $this->load->helper('download');
    }

    public function items() {
        $data['items'] = $this->items_model->get_items();
        $content = $this->load->view('reports/items', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Items',
            'content' => $content
        ]);
    }

    public function batches() {
        $data['transactions'] = $this->transactions_model->get_new_batches();
        $content = $this->load->view('reports/new-batches', $data, TRUE);
        $this->load->view('main', [
            'title' => 'New Batches',
            'content' => $content
        ]);
    }

    public function items_returned() {
        $data['transactions'] = $this->transactions_model->get_items_returned();
        $content = $this->load->view('reports/items-returned', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Items Returned',
            'content' => $content
        ]);
    }

    public function items_given_out() {
        $data['transactions'] = $this->transactions_model->get_items_given_out('pending');
        $content = $this->load->view('reports/items-given-out', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Items Given Out',
            'content' => $content
        ]);
    }

    public function download($report) {
        switch ($report) {
            case 'items':
                $file = $this->reports_model->make_items_report();
                break;
            case 'batches':
                $file = $this->reports_model->make_batches_report();
                break;
            case 'items-returned':
                $file = $this->reports_model->make_items_returned_report();
                break;
            case 'items-given-out':
                $file = $this->reports_model->make_items_given_out_report();
                break;
            default:
                show_404();
                break;
        }

        force_download($file, NULL);
    }
}