<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 
require_once '../includes/functions.php';

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['username'] = $user['username'];

    if ($user['role'] === 'admin') {
        header("Location: " . BASE_URL . "/admin/dashboard.php");

    } else {
        header("Location: ". BASE_URL . "/user/dashboard.php");
    }
} else {
    echo "Invalid credentials.";
}