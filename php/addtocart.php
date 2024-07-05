<?php
session_start();
include "db_conn.php";


// Sanitize input
$productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;

// Validate productId
if ($productId <= 0) {
    echo "Invalid product ID";
    exit();
}

// Get user ID from session
$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $userId = $row['id'];

    // Check if the product already exists in the cart
    $checkCartQuery = "SELECT * FROM cart WHERE user_id = ? AND item_id = ?";
    $stmt = $conn->prepare($checkCartQuery);
    $stmt->bind_param('ii', $userId, $productId);
    $stmt->execute();
    $checkCartResult = $stmt->get_result();

    if ($checkCartResult->num_rows > 0) {
        // Product already exists in the cart, update quantity
        $updateCartQuery = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND item_id = ?";
        $stmt = $conn->prepare($updateCartQuery);
        $stmt->bind_param('ii', $userId, $productId);
        $stmt->execute();
    } else {
        // Product does not exist in the cart, insert it
        $insertCartQuery = "INSERT INTO cart (user_id, item_id, quantity) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($insertCartQuery);
        $stmt->bind_param('ii', $userId, $productId);
        $stmt->execute();
    }
} else {
    echo "User not found";
}

// Redirect to index.php after adding to cart
header('Location: ../index.php');
exit();

$stmt->close();
$conn->close();
?>
