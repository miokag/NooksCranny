<?php
session_start();

// Clear session
session_unset();
session_destroy();

// Clear cookies
setcookie('username', '', time() - 3600, '/');
setcookie('userpass', '', time() - 3600, '/');

// Redirect to the login page
header("Location: ../pages/loginsignup.php");
exit();
?>
