<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php'); // Redirect if not logged in
    exit();
}

include "db_conn.php"; // Include your database connection file

$username = $_SESSION['username'];

// Query to delete cart items for the logged-in user
$sql_delete_cart = "DELETE FROM cart WHERE user_id = (SELECT id FROM users WHERE username = ?)";
$stmt_delete_cart = $conn->prepare($sql_delete_cart);
$stmt_delete_cart->bind_param('s', $username);
$stmt_delete_cart->execute();
$stmt_delete_cart->close();

// Optionally, you can also log the purchase or update other tables as needed

// Example response for successful checkout
$response = array(
    'status' => 'success',
    'message' => 'Purchase successful! Your items have been cleared from the cart.'
);

echo json_encode($response);
header('Location: ../index.php');
exit();

?>
