<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function dashboard() {
        $data = [];
        $content = $this->load->view('dashboard', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Dashboard',
            'content' => $content
        ]);
    }
}
?>