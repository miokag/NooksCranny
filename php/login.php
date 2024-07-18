<?php
include "db_conn.php";

session_start();

if (isset($_POST['loginusername']) && isset($_POST['loginpass'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $loginusername = validate($_POST['loginusername']);
    $loginpass = validate($_POST['loginpass']);
    $remember = isset($_POST['remember']);

    if (empty($loginusername)) {
        header("Location: ../index.php?loginerror=Username is required");
        exit();
    } else if (empty($loginpass)) {
        header("Location: ../index.php?loginerror=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$loginusername'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($loginpass, $row['password'])) {
                // Store user information in session variables
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];

                if ($remember) {
                    setcookie('username', $row['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
                    setcookie('userpass', $loginpass, time() + (86400 * 30), "/"); // Hashed password
                }

                header("Location: ../index.php");
                exit();
            } else {
                header("Location: ../index.php?loginerror=Incorrect username or password");
                exit();
            }
        } else {
            header("Location: ../index.php?loginerror=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: ../index.php?loginerror=Invalid request");
    exit();
}
?>
