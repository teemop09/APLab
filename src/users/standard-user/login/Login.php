<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/conn.php');

$userLogin = false;
if (isset($_POST['login']))
    $login = $_POST['login'];
if (isset($_POST['passwd']))
    $passwd = $_POST['passwd'];

//check
$query = "SELECT * FROM user_t WHERE user_email =? AND user_password =?;";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo "Error: " . $query . "<br>" . $conn->error;
}
var_dump($stmt);
$stmt->bind_param("ss", $login, $passwd);
$stmt->execute();
$result = $stmt->get_result();



if ($result->num_rows > 0) {
    $userLogin = true;
}
session_start();

if ($userLogin) {
    $row = $result->fetch_assoc();
    $_SESSION['userID'] = $row["user_id"];
    header('Location: /src/users/standard-user/homepage/userHomepage.php');
} else {
    $query = "SELECT * FROM technician_t WHERE tech_email ='$login' AND tech_password ='$passwd' AND tech_role = 'Technical Assistant'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $TALogin = true;
    }

    if ($TALogin) {
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row["tech_id"];
        header('Location: /src/users/technician/homepage/taHomepage.php');
    } else {
        $query = "SELECT * FROM technician_t WHERE tech_email ='$login' AND tech_password ='$passwd' AND tech_role = 'Technical Service Staff'";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            $TSSLogin = true;
        }

        if ($TSSLogin) {
            $row = $result->fetch_assoc();
            $_SESSION['userID'] = $row["tech_id"];
            header('Location: /src/users/technician/homepage/tssHomepage.php');
        } else {
            header('Location: Login.html?login_failed');
        }
    }
}

$conn->close();

?>