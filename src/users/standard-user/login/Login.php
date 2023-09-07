<?php
include('dbConnect.php');

if (isset($_POST['login'])) $login = $_POST['login'];
if (isset($_POST['passwd'])) $passwd = $_POST['passwd'];

//check
$query = "SELECT * FROM user_t WHERE user_email ='$login' AND user_password ='$passwd'";
$result = mysqli_query($conn, $query);

if($result->num_rows > 0) {
    $userLogin = true;
}

if($userLogin) {
    $row = $result->fetch_assoc();
    $_SESSION['userID'] = $row["user_id"];
    header('Location: UserHomePage.php');
} else {
    $query = "SELECT * FROM technician_t WHERE tech_email ='$login' AND tech_password ='$passwd' AND tech_role = 'Technical Assistant'";
    $result = mysqli_query($conn, $query);

    if($result->num_rows > 0) {
        $TALogin = true;
    }

    if($TALogin) {
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row["tech_id"];
        header('Location: TAHomePage.php');
    } else {
        $query = "SELECT * FROM technician_t WHERE tech_email ='$login' AND tech_password ='$passwd' AND tech_role = 'Technical Service Staff'";
        $result = mysqli_query($conn, $query);

        if($result->num_rows > 0) {
            $TSSLogin = true;
        }
        
        if($TSSLogin) {
            $row = $result->fetch_assoc();
            $_SESSION['userID'] = $row["tech_id"];
            header('Location: TSSHomePage.php');
        } else {
            header('Location: Login.html?login_failed');
        }
    }
}

?>