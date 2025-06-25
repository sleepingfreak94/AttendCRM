<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// Start the session at the beginning of the script
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: " . BASE_URL . "/auth/login.php");
        exit;
    }
}

