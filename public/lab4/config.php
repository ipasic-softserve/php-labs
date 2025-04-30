<?php
$host = 'localhost';
$dbname = 'users_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
