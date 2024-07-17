<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Handle case if user is not logged in
    exit();
}

include "../php/db_conn.php"; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Perform SQL query to delete item from cart
    $sql = "DELETE FROM cart WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        // Item removed successfully
        echo 'Item removed from cart.';
    } else {
        // Error occurred while removing item
        echo 'Failed to remove item from cart.';
    }

    $stmt->close();
}
a
$conn->close();
?>
