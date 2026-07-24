<?php
class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
        // Redirect to login if not logged in
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/dashboard');
        } else {
            $this->login();
        }
    }

    public function login() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            
            // CSRF validation
            if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
                die('CSRF token validation failed');
            }

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            // Validate Username
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if ($this->userModel->findUserByUsername($data['username'])) {
                // User found
            } else {
                $data['username_err'] = 'No user found';
            }

            // Make sure errors are empty
            if (empty($data['username_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // Init data
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_role'] = $user->role_name;

        // Get Employee info
        $employee = $this->userModel->getEmployeeByUserId($user->id);
        if ($employee) {
            $_SESSION['employee_id'] = $employee->id;
            $_SESSION['employee_name'] = $employee->first_name . ' ' . $employee->last_name;
            $_SESSION['employee_photo'] = $employee->profile_image;
        }

        header('Location: ' . URLROOT . '/dashboard');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_role']);
        unset($_SESSION['employee_id']);
        unset($_SESSION['employee_name']);
        unset($_SESSION['employee_photo']);
        session_destroy();
        header('Location: ' . URLROOT . '/users/login');
    }
}
