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
        header("Location: ../pages/loginsignup.php?signuperror=Username is required");
        exit();
    } else if (empty($userpass)) {
        header("Location: ../pages/loginsignup.php?signuperror=Password is required");
        exit();
    } else if (empty($userfirstname)) {
        header("Location: ../pages/loginsignup.php?signuperror=First Name is required");
        exit();
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: ../pages/loginsignup.php?signuperror=Username already exists");
            exit();
        } else {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$hashed_password', '$userfirstname')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: ../pages/loginsignup.php?success=Your account has been created successfully");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn); // Debugging purposes
                header("Location: ../pages/loginsignup.php?signuperror=Unknown error occurred");
                exit();
            }
        }
    }
} else {
    header("Location: ../pages/loginsignup.php?signuperror=Invalid request");
    exit();
}
?>
