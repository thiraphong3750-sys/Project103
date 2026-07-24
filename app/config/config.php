<?php
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'attendance_system');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root (Adjust to your local server setup, e.g., http://localhost/attendance-system)
// For php built-in server 'php -S localhost:8000', URLROOT is http://localhost:8000
define('URLROOT', 'http://localhost/attendance-system');
// Site Name
define('SITENAME', 'Enterprise Attendance System');

// Timezone
date_default_timezone_set('Asia/Bangkok');
