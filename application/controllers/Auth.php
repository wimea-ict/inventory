<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model(['auth_model']);
    }

    public function index() {
        $this->login();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->auth_model->check($username, $password);
            if ($user) {
                $this->session->set_userdata('user', $user);
                redirect(base_url("admin/dashboard"));
            }
            else {
                $this->session->set_flashdata('message', 'Invalid username/password.');
                redirect(base_url("auth/login"));
            }
        }

        if ($this->session->has_userdata('user')) {
            redirect(base_url("admin/dashboard"));
        }
        $this->load->view('login');
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect(base_url("auth/login"));
    }
}
?>