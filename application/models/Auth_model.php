<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function check($username, $password) {
        $sql = sprintf("SELECT *, CONCAT(first_name, ' ', other_names) AS name
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

    public function user_exists($username) {
        $sql = sprintf("SELECT id FROM users WHERE username = %s",
                        $this->db->escape($username));
        $query = $this->db->query($sql);

        return ($query->num_rows() > 0);
    }
}
?>