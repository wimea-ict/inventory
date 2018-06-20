<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function dashboard() {
        $this->load->view('partials/header');
        $this->load->view('partials/navigation');
        $this->load->view('dashboard');
        $this->load->view('partials/footer');
    }
}
?>