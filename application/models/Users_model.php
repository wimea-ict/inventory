<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function create_user($data) {
        extract($data);
        $sql = sprintf("INSERT INTO users (first_name, other_names, email, username, passwd, contacts)
                        VALUES (%s, %s, %s, %s, '%s', %s)",
                        $this->db->escape($first_name), $this->db->escape($other_names),
                        $this->db->escape($email), $this->db->escape($username),
                        password_hash($password, PASSWORD_BCRYPT),
                        $this->db->escape($contacts));
        $this->db->query($sql);
    }

    public function change_password($user_id, $old_password, $new_password) {
        $sql = sprintf("SELECT passwd FROM users WHERE id = %d", $user_id);
        $query = $this->db->query($sql);
        $result = $query->row_array();
        if (password_verify($old_password, $result['passwd']) == false) {
            return false;
        }

        // Change the password.
        $sql = sprintf("UPDATE users SET passwd = '%s' WHERE id = %d",
                        password_hash($new_password, PASSWORD_BCRYPT), $user_id);
        $this->db->query($sql);

        return true;
    }

    public function update_user($user_id, $data) {
        extract($data);
        $sql = sprintf("UPDATE users SET first_name = %s, other_names = %s, email = %s, contacts = %s
                        WHERE id = %d",
                        $this->db->escape($first_name), $this->db->escape($other_names),
                        $this->db->escape($email), $this->db->escape($contacts),
                        $user_id);
        $this->db->query($sql);
    }

    public function get_user($user_id) {
        $sql = sprintf("SELECT id, first_name, other_names, CONCAT(first_name, ' ', other_names) AS name, email, username, contacts, date_entered
                        FROM users WHERE id = %d", $user_id);
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row_array();
    }

    public function get_users() {
        $sql = sprintf("SELECT id, CONCAT(first_name, ' ', other_names) AS name, email, username, contacts, date_entered
                        FROM users ORDER BY date_entered DESC");
        $query = $this->db->query($sql);

        return $query->result_array();
    }
}