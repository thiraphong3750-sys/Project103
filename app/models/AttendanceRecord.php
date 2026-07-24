<?php
class AttendanceRecord {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Check if employee already checked in today
    public function getTodayAttendance($employee_id) {
        $today = date('Y-m-d');
        $this->db->query('SELECT * FROM attendance WHERE employee_id = :employee_id AND date = :today');
        $this->db->bind(':employee_id', $employee_id);
        $this->db->bind(':today', $today);
        return $this->db->single();
    }

    // Check In
    public function checkIn($data) {
        $this->db->query('INSERT INTO attendance (employee_id, date, check_in_time, check_in_lat, check_in_lng, status) VALUES (:employee_id, :date, :check_in_time, :lat, :lng, :status)');
        
        $this->db->bind(':employee_id', $data['employee_id']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':check_in_time', $data['time']);
        $this->db->bind(':lat', $data['lat']);
        $this->db->bind(':lng', $data['lng']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    // Check Out
    public function checkOut($data) {
        $this->db->query('UPDATE attendance SET check_out_time = :check_out_time, check_out_lat = :lat, check_out_lng = :lng, working_hours = :working_hours, ot_hours = :ot_hours WHERE id = :id');
        
        $this->db->bind(':id', $data['attendance_id']);
        $this->db->bind(':check_out_time', $data['time']);
        $this->db->bind(':lat', $data['lat']);
        $this->db->bind(':lng', $data['lng']);
        $this->db->bind(':working_hours', $data['working_hours']);
        $this->db->bind(':ot_hours', $data['ot_hours']);

        return $this->db->execute();
    }
    
    // Get History for Employee
    public function getEmployeeHistory($employee_id) {
        $this->db->query('SELECT * FROM attendance WHERE employee_id = :employee_id ORDER BY date DESC, check_in_time DESC');
        $this->db->bind(':employee_id', $employee_id);
        return $this->db->resultSet();
    }
    
    // Get Settings
    public function getSettings() {
        $this->db->query('SELECT * FROM settings');
        $results = $this->db->resultSet();
        $settings = [];
        foreach($results as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }
        return $settings;
    }
}
