<?php
require_once '../includes/functions.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
redirect_if_not_logged_in();

if (!is_admin()) {
    echo "Unauthorized.";
    exit;
}
echo "Welcome Admin: " . $_SESSION['username'];
