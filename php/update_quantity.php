<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['itemId'])) {
    // Include your database connection file
    include "db_conn.php";

    // Sanitize input
    $itemId = intval($_POST['itemId']);

    // Prepare statement to update quantity in cart
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE item_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $itemId, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Fetch updated quantity after update
        $sql_fetch_quantity = "SELECT quantity FROM cart WHERE item_id = ? AND user_id = ?";
        $stmt_fetch = $conn->prepare($sql_fetch_quantity);
        $stmt_fetch->bind_param('ii', $itemId, $_SESSION['user_id']);
        $stmt_fetch->execute();
        $result = $stmt_fetch->get_result();
        $row = $result->fetch_assoc();
        $updatedQuantity = $row['quantity'];

        echo $updatedQuantity; // Send back updated quantity to JavaScript
    } else {
        echo "error"; // Send error response if update fails
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request"; // Send response for invalid request
}
?>
