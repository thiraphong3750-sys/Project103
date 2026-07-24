<?php
class Settings extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
        }
        if (!in_array($_SESSION['user_role'], ['Super Admin', 'Admin'])) {
            header('Location: ' . URLROOT . '/dashboard');
        }
    }

    public function index() {
        $data = [
            'title' => 'ตั้งค่าระบบ (System Settings)',
            'settings' => [
                'company_name' => 'My Company',
                'work_start_time' => '09:00',
                'work_end_time' => '18:00',
                'late_threshold' => '09:15',
                'ot_start_time' => '18:30'
            ]
        ];

        $this->view('settings/index', $data);
    }
}
