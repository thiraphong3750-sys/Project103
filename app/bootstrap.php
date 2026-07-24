<?php
// Load Config
require_once 'config/config.php';
// Load Helpers
require_once 'helpers/session_helper.php';

// Autoload Core Libraries
spl_autoload_register(function($className){
    if (file_exists(__DIR__ . '/core/' . $className . '.php')) {
        require_once 'core/' . $className . '.php';
    }
});
