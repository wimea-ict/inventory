<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->has_userdata('user') == false) {
            redirect(base_url('auth/login'));
        }

        $this->load->model([
            'transactions_model',
            'categories_model',
            'items_model',
            'admin_model'
        ]);
    }

    public function dashboard() {
        $data['num_transactions'] = $this->transactions_model->get_num_transactions();
        $data['num_need_attention'] = $this->admin_model->get_num_need_attention();
        $data['num_categories'] = $this->categories_model->get_num_categories();
        $data['num_items'] = $this->items_model->get_num_items();
        $content = $this->load->view('dashboard', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Dashboard',
            'content' => $content
        ]);
    }

    /**
     * @param $type [items, transactions]
     */
    public function need_attention($type = '') {
        $num_need_attention = $this->admin_model->get_num_need_attention();

        // By default we show the items tab, but if there are no items that need attention,
        // and there are transactions that need attention, then we show the transactions tab.
        // Think about that for a moment.
        if ($type == 'transactions' ||
            ($num_need_attention['items'] == 0 && $num_need_attention['transactions'] > 0)) {
            $this->session->set_flashdata([
                'message' => 'The following items were given out and have exceeded their
                                expected return date. Please consider reminding the recipients.',
                'message_class' => 'info'
            ]);

            $data['num_need_attention'] = $num_need_attention;
            $data['transactions'] = $this->admin_model->get_transactions_need_attention();
            $content = $this->load->view('admin/need-attention/transactions', $data, TRUE);
        }
        else {
            $this->session->set_flashdata([
                'message' => 'The items are currently not in stock. Am afraid you might have to re-stock them.',
                'message_class' => 'info'
            ]);

            $data['num_need_attention'] = $num_need_attention;
            $data['items'] = $this->admin_model->get_items_need_attention();
            $content = $this->load->view('admin/need-attention/items', $data, TRUE);
        }

        if (is_ajax_request()) {
            echo $content;
            return;
        }

        $this->load->view('main', [
            'title' => 'Need Attention',
            'content' => $content
        ]);
    }
}
?>