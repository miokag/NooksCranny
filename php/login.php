<?php
include "db_conn.php";

if (isset($_POST['loginusername']) && isset($_POST['loginpass'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $loginusername = validate($_POST['loginusername']);
    $loginpass = validate($_POST['loginpass']);

    if (empty($loginusername)) {
        header("Location: ../pages/loginsignup.php?loginerror=Username is required");
        exit();
    } else if (empty($loginpass)) {
        header("Location: ../pages/loginsignup.php?loginerror=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$loginusername'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($loginpass, $row['password'])) {
                // Start a session and store user information
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: ../pages/loginsignup.php?loginerror=Incorrect Username or Password");
                exit();
            }
        } else {
            header("Location: ../pages/loginsignup.php?loginerror=Incorrect Username or Password");
            exit();
        }
    }
} else {
    header("Location: ../pages/loginsignup.php?loginerror=Invalid request");
    exit();
}
?>
