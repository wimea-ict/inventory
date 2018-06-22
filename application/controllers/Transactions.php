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

    public function items_returned() {
        $data['transactions'] = $this->transactions_model->get_items_returned();
        $content = $this->load->view('transactions/items-returned', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Returned Items',
            'content' => $content
        ]);
    }

    public function items_given_out() {
        $data['items_given_out'] = $this->transactions_model->get_items_given_out('pending');
        $content = $this->load->view('transactions/items-given-out', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Items Given Out',
            'content' => $content
        ]);
    }

    public function view($transaction_type, $transaction_id) {
        $transaction_type = str_replace('-', '_', $transaction_type);

        $transaction = $this->transactions_model->get_transaction($transaction_id, $transaction_type);
        if ($transaction == false) {
            show_404();
        }

        $data['transaction'] = $transaction;
        switch ($transaction_type) {
            case 'new_batch':
                $view = 'transactions/single-transaction/new-batch';
                break;
            case 'items_out':
                $view = 'transactions/single-transaction/items-given-out';
                break;
            case 'items_returned':
                $view = 'transactions/single-transaction/items-returned';
                break;
            default:
                // Do nothing.
                break;
        }

        $content = $this->load->view($view, $data, TRUE);
        $this->load->view('main', [
            'title' => ucwords(implode(' ', explode('_', $transaction_type))),
            'content' => $content
        ]);
    }
}
?>