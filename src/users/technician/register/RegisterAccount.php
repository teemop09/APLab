<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php';

if (isset($_POST['role']))
    $role = $_POST['role'];

if ($role == "Student" || $role == "Lecturer") {
    $stmt = $conn->prepare("INSERT INTO user_t (user_id, user_first_name, user_last_name, user_email, user_password, user_contact_number, user_role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $id, $fname, $lname, $email, $passwd, $contact, $role);

    // set parameters and execute
    if (isset($_POST['id']))
        $id = $_POST['id'];
    if (isset($_POST['fname']))
        $fname = $_POST['fname'];
    if (isset($_POST['lname']))
        $lname = $_POST['lname'];
    if (isset($_POST['email']))
        $email = $_POST['email'];
    if (isset($_POST['passwd']))
        $passwd = $_POST['passwd'];
    if (isset($_POST['contact']))
        $contact = $_POST['contact'];

    //check
    $query = "SELECT * FROM user_t WHERE user_id ='$id'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $user_exists = true;
    }

    $query = "SELECT * FROM user_t WHERE user_email ='$email'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $email_exists = true;
    }

    if ($user_exists && $email_exists) {
        header('Location: RegisterAccountUser.html?idemail_exists');
    } else if ($user_exists) {
        header('Location: RegisterAccountUser.html?id_exists');
    } else if ($email_exists) {
        header('Location: RegisterAccountUser.html?email_exists');
    } else {
        $stmt->execute();
        header('Location: RegisterAccountUser.html');
    }
} else {

    $stmt = $conn->prepare("INSERT INTO technician_t (tech_first_name, tech_last_name, tech_email, tech_password, tech_contact_number, tech_id, tech_role, tech_department) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $passwd, $contact, $ts, $role, $department);

    // set parameters and execute
    if (isset($_POST['fname']))
        $fname = $_POST['fname'];
    if (isset($_POST['lname']))
        $lname = $_POST['lname'];
    if (isset($_POST['email']))
        $email = $_POST['email'];
    if (isset($_POST['passwd']))
        $passwd = $_POST['passwd'];
    if (isset($_POST['contact']))
        $contact = $_POST['contact'];
    if (isset($_POST['ts']))
        $ts = $_POST['ts'];
    if (isset($_POST['department']))
        $department = $_POST['department'];

    //check
    $query = "SELECT * FROM technician_t WHERE tech_id ='$ts'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $user_exists = true;
    }

    $query = "SELECT * FROM technician_t WHERE tech_email ='$email'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $email_exists = true;
    }

    if ($user_exists && $email_exists) {
        header('Location: RegisterAccountTechnician.html?tsemail_exists');
    } else if ($user_exists) {
        header('Location: RegisterAccountTechnician.html?ts_exists');
    } else if ($email_exists) {
        header('Location: RegisterAccountTechnician.html?email_exists');
    } else {
        $stmt->execute();



        header('Location: RegisterAccountTechnician.html');
    }

}

$stmt->close();
$conn->close();

?>