<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Find user by username
    public function findUserByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($username, $password) {
        $this->db->query('SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.username = :username AND u.is_active = 1');
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        return false;
    }

    // Get Employee Details by User ID
    public function getEmployeeByUserId($user_id) {
        $this->db->query('SELECT * FROM employees WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
}
