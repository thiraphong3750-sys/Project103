<?php
class Employees extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
        }
        // Access control: only Admin/HR/Manager can view this
        if (!in_array($_SESSION['user_role'], ['Super Admin', 'Admin', 'HR', 'Manager'])) {
            header('Location: ' . URLROOT . '/dashboard');
        }
    }

    public function index() {
        $data = [
            'title' => 'พนักงาน (Employees)',
            // Mock data for UI presentation
            'employees' => [
                (object)[
                    'id' => 1,
                    'employee_code' => 'EMP-0001',
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'position' => 'Software Engineer',
                    'department' => 'IT',
                    'email' => 'john.d@example.com',
                    'status' => 'Active'
                ],
                (object)[
                    'id' => 2,
                    'employee_code' => 'EMP-0002',
                    'first_name' => 'Jane',
                    'last_name' => 'Smith',
                    'position' => 'HR Manager',
                    'department' => 'HR',
                    'email' => 'jane.s@example.com',
                    'status' => 'Active'
                ]
            ]
        ];

        $this->view('employees/index', $data);
    }
}
