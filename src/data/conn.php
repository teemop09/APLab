<?php
// Include the configuration file
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// Create a connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>