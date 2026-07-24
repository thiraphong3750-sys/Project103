<?php
class Dashboard extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
        }
    }

    public function index() {
        $data = [
            'title' => 'Dashboard',
            // Mock data for Phase 2
            'total_employees' => 150,
            'present_today' => 120,
            'absent_today' => 5,
            'on_leave' => 10,
            'late_today' => 15
        ];

        $this->view('dashboard/index', $data);
    }
}
