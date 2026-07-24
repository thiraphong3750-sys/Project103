<?php
class Attendance extends Controller {
    private $attendanceModel;
    private $userModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
        }
        $this->attendanceModel = $this->model('AttendanceRecord');
        $this->userModel = $this->model('User');
    }

    public function check() {
        // Employee ID from session
        $employee_id = $_SESSION['employee_id'];
        
        // Get today's attendance record
        $today_record = $this->attendanceModel->getTodayAttendance($employee_id);
        
        // Get Employee Details
        $employee = $this->userModel->getEmployeeByUserId($_SESSION['user_id']);
        
        $data = [
            'title' => 'ลงเวลาเข้า-ออกงาน',
            'employee' => $employee,
            'today_record' => $today_record
        ];

        $this->view('attendance/check', $data);
    }
    
    // API endpoint for checking in/out via AJAX
    public function submit_check() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');
            
            $action = $_POST['action']; // 'checkin' or 'checkout'
            $lat = $_POST['latitude'];
            $lng = $_POST['longitude'];
            // In a real app, process the base64 image from Camera here
            
            $employee_id = $_SESSION['employee_id'];
            $currentTime = date('H:i:s');
            $currentDate = date('Y-m-d');
            
            $settings = $this->attendanceModel->getSettings();
            $late_threshold = $settings['late_threshold'] ?? '09:15:00';
            
            if ($action == 'checkin') {
                // Determine status
                $status = 'Present';
                if (strtotime($currentTime) > strtotime($late_threshold)) {
                    $status = 'Late';
                }
                
                $data = [
                    'employee_id' => $employee_id,
                    'date' => $currentDate,
                    'time' => $currentTime,
                    'lat' => $lat,
                    'lng' => $lng,
                    'status' => $status
                ];
                
                if ($this->attendanceModel->checkIn($data)) {
                    echo json_encode(['success' => true, 'message' => 'ลงเวลาเข้าสำเร็จ', 'time' => $currentTime, 'status' => $status]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการลงเวลาเข้า']);
                }
            } elseif ($action == 'checkout') {
                $today_record = $this->attendanceModel->getTodayAttendance($employee_id);
                
                if ($today_record && !$today_record->check_out_time) {
                    // Calculate working hours and OT (Simplified logic)
                    $check_in_time = $today_record->check_in_time;
                    $diff = strtotime($currentTime) - strtotime($check_in_time);
                    $working_hours = round($diff / 3600, 2);
                    
                    $ot_start = $settings['ot_start_time'] ?? '18:30:00';
                    $ot_hours = 0;
                    if (strtotime($currentTime) > strtotime($ot_start)) {
                        $ot_diff = strtotime($currentTime) - strtotime($ot_start);
                        $ot_hours = round($ot_diff / 3600, 2);
                    }
                    
                    $data = [
                        'attendance_id' => $today_record->id,
                        'time' => $currentTime,
                        'lat' => $lat,
                        'lng' => $lng,
                        'working_hours' => $working_hours,
                        'ot_hours' => $ot_hours
                    ];
                    
                    if ($this->attendanceModel->checkOut($data)) {
                        echo json_encode(['success' => true, 'message' => 'ลงเวลาออกสำเร็จ', 'time' => $currentTime]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการลงเวลาออก']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลการเข้างานวันนี้ หรือลงเวลาออกไปแล้ว']);
                }
            }
        }
    }
    
    public function history() {
        $employee_id = $_SESSION['employee_id'];
        $history = $this->attendanceModel->getEmployeeHistory($employee_id);
        
        $data = [
            'title' => 'ประวัติลงเวลา',
            'history' => $history
        ];
        
        $this->view('attendance/history', $data);
    }
}
