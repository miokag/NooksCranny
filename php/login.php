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
        header("Location: ../pages/loginsignup.php?error=Username is required");
        exit();
    } else if (empty($loginpass)) {
        header("Location: ../pages/loginsignup.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$loginusername' AND password='$loginpass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $loginusername && $row['password'] === $loginpass) {
                echo "Logged in!";
            }
        } else {
            header("Location: ../pages/loginsignup.php?error=Incorrect Username or Password");
            exit();
        }
    }

} else {
    header("Location: ../pages/loginsignup.php?error");
    exit();
}

?>
