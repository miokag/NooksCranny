<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    include 'db_conn.php';

    // Get POST data
    $orderId = $_POST['orderId'];
    $change = $_POST['change']; // This will be either +1 or -1

    // Update quantity in database
    $sqlUpdateQuantity = "UPDATE cart SET quantity = quantity + ? WHERE order_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdateQuantity);
    $stmtUpdate->bind_param('ii', $change, $orderId);
    $stmtUpdate->execute();

    if ($stmtUpdate->affected_rows > 0) {
        // Quantity updated successfully
        echo json_encode(['status' => 'success']);
    } else {
        // Error updating quantity
        echo json_encode(['status' => 'error', 'message' => 'Failed to update quantity in database.']);
    }

    // Close statement and database connection
    $stmtUpdate->close();
    $conn->close();
}
?>
