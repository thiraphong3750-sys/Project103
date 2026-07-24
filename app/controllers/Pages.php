<?php
class Pages extends Controller {
    public function __construct() {
    }

    public function index() {
        if(isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/dashboard');
        } else {
            header('Location: ' . URLROOT . '/users/login');
        }
    }
}
