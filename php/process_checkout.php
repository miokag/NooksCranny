<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

include "../php/db_conn.php"; // Include your database connection file

$username = $_SESSION['username'];

// Query to delete cart items for the logged-in user
$sql = "DELETE cart FROM cart
        INNER JOIN users ON cart.user_id = users.id
        WHERE users.username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();

// Check if the cart items were successfully deleted
if ($stmt->affected_rows > 0) {
    // Cart items cleared successfully
    $_SESSION['cart_cleared'] = true; // Flag to indicate cart was cleared
} else {
    // No cart items found to delete
    $_SESSION['cart_cleared'] = false; // Flag to indicate no cart items were found
}

$stmt->close();
$conn->close();

// Redirect back to cart page
header('Location: ../pages/cart.php');
exit();
?>
