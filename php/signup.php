<?php
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['userpass']) && isset($_POST['userfirstname'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $userpass = validate($_POST['userpass']);
    $userfirstname = validate($_POST['userfirstname']);

    if (empty($username)) {
        header("Location: ../pages/loginsignup.php?error=Username is required");
        exit();
    } else if (empty($userpass)) {
        header("Location: ../pages/loginsignup.php?error=Password is required");
        exit();
    } else if (empty($userfirstname)) {
        header("Location: ../pages/loginsignup.php?error=First Name is required");
        exit();
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: ../pages/loginsignup.php?error=Username already exists");
            exit();
        } else {
            // Insert the new user into the database with plain text password
            $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$userpass', '$userfirstname')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: ../pages/loginsignup.php?success=Your account has been created successfully");
                exit();
            } else {
                echo mysqli_error($conn); // Debugging purposes
                header("Location: ../pages/loginsignup.php?error=Unknown error occurred");
                exit();
            }
        }
    }
} else {
    header("Location: ../pages/loginsignup.php?error=Invalid request");
    exit();
}
?>
