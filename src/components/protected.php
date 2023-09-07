<?php
session_start();

if (!isset($_SESSION['userID'])) {
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='/src/users/standard-user/login/Login.html';</script>";
    exit;
}
// include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/protected.php';

?>