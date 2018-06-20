<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function check($username, $password) {
        $sql = sprintf("SELECT id, CONCAT(first_name, ' ', other_names) AS name, passwd
                        FROM users WHERE username = %s", $this->db->escape($username));
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        $user = $query->row_array();
        if (password_verify($password, $user['passwd']) == false) {
            return false;
        }

        return $user;
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
}
?>