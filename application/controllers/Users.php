<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model(['users_model', 'auth_model']);
    }

    public function index() {
        $data['users'] = $this->users_model->get_users();
        $content = $this->load->view('users/all', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Users',
            'content' => $content
        ]);
    }

    public function create() {
        if ($_SESSION['user']['username'] != 'admin') {
            redirect(base_url('admin/dashboard'));
        }

        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = [
                'first_name' => $this->input->post('first_name'),
                'other_names' => $this->input->post('other_names'),
                'email' => $this->input->post('email'),
                'contacts' => $this->input->post('contacts'),
                'username' => $this->input->post('username')
            ];

            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');

            if ($this->auth_model->user_exists($user['username'])) {
                $data['user'] = $user;
                $this->session->set_flashdata([
                    'message' => 'That username is already taken!',
                    'message_class' => 'danger'
                ]);
            }
            elseif ($password1 != $password2) {
                $data['user'] = $user;
                $this->session->set_flashdata([
                    'message' => 'The two passwords do not match!',
                    'message_class' => 'danger'
                ]);
            }
            else {
                $user['password'] = $this->input->post('password1');
                $this->users_model->create_user($user);

                redirect(base_url('users'));
            }
        }

        $content = $this->load->view('users/create', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Create New User',
            'content' => $content
        ]);
    }

    public function profile($user_id) {
        $user = $this->users_model->get_user($user_id);
        if ($user == false) {
            show_404();
        }

        if ($user['id'] != $_SESSION['user']['id']) {
            redirect(base_url('admin/dashboard'));
        }

        $data['user'] = $user;
        $content = $this->load->view('users/profile', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Profile',
            'content' => $content
        ]);
    }

    public function edit_profile($user_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'first_name' => $this->input->post('first_name'),
                'other_names' => $this->input->post('other_names'),
                'contacts' => $this->input->post('contacts'),
                'email' => $this->input->post('email')
            ];
            $this->users_model->update_user($_SESSION['user']['id'], $data);

            $this->session->set_flashdata([
                'message' => 'You profile has been successfully updated',
                'message_class' => 'success'
            ]);
            redirect(base_url("users/profile/{$_SESSION['user']['id']}"));
        }

        $user = $this->users_model->get_user($user_id);
        if ($user == false) {
            show_404();
        }

        if ($user['id'] != $_SESSION['user']['id']) {
            redirect(base_url('admin/dashboard'));
        }

        $data['user'] = $user;
        $content = $this->load->view('users/edit-profile', $data, TRUE);
        $this->load->view('main', [
            'title' => 'Edit User',
            'content' => $content
        ]);
    }

    public function change_password() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('password1');
            if ($new_password != $this->input->post('password2')) {
                $this->session_setflashdata([
                    'message' => 'The two passwords do not match',
                    'message_class' => 'danger'
                ]);
            }
            else {
                if ($this->users_model->change_password($_SESSION['user']['id'], $old_password, $new_password)) {
                    $this->session->set_flashdata([
                        'message' => 'Your password has been successfully changed',
                        'message_class' => 'success'
                    ]);

                    redirect(base_url("users/profile/{$_SESSION['user']['id']}"));
                }
                else {
                    $this->session->set_flashdata([
                        'message' => 'Your old password is not correct',
                        'message_class' => 'danger'
                    ]);
                }
            }
        }

        $content = $this->load->view('users/change-password', [], TRUE);
        $this->load->view('main', [
            'title' => 'Change Password',
            'content' => $content
        ]);
    }
}
?>