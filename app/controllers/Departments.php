<?php
class Departments extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
        }
        if (!in_array($_SESSION['user_role'], ['Super Admin', 'Admin', 'HR'])) {
            header('Location: ' . URLROOT . '/dashboard');
        }
    }

    public function index() {
        $data = [
            'title' => 'แผนก (Departments)',
            'departments' => [
                (object)['id' => 1, 'name' => 'IT', 'description' => 'Information Technology', 'head' => 'John Doe', 'count' => 5],
                (object)['id' => 2, 'name' => 'HR', 'description' => 'Human Resources', 'head' => 'Jane Smith', 'count' => 2],
            ]
        ];

        $this->view('departments/index', $data);
    }
}
