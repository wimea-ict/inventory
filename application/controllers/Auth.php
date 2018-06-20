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

    // TODO: Remove.
    // public function dummy() {
    //     $user = [
    //         'first_name' => 'Robert',
    //         'other_names' => 'Elvis Odoch',
    //         'email' => 'robertelvisodoch@gmail.com',
    //         'username' => 'rodoch',
    //         'password' => 'dummy',
    //         'contacts' => '0779322831/0704580010'
    //     ];
    //     $this->auth_model->create_user($user);
    // }

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

        $this->load->view('login');
    }

    public function logout() {
        
    }
}
?>