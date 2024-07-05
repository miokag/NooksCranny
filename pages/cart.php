<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

include "../php/db_conn.php"; // Include your database connection file

$username = $_SESSION['username'];

// Query to fetch cart items for the logged-in user
$sql = "SELECT products.item_name, products.item_price, cart.quantity
        FROM cart
        INNER JOIN products ON cart.item_id = products.item_id
        INNER JOIN users ON cart.user_id = users.id
        WHERE users.username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

// Initialize total price variable
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nook's Cranny - Shopping Cart</title>
    <link rel="icon" type="image/x-icon" href="img/Apps.png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="../style/cartstyle.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid" id="navbar-container">
            <a class="navbar-brand" href="../index.php" id="navbar-brand">Nook's Cranny</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav mx-auto" id="navbar-nav-center">
                    <p>No proper layout for this yet, will add the checkout and will customize it though.</p>
                    <!-- <a class="nav-link active" href="#" id="nav-item-home">About</a>
                    <a class="nav-link" href="#" id="nav-item-about">Furniture</a>
                    <a class="nav-link" href="#" id="nav-item-services">Clothes</a>
                    <a class="nav-link" href="#" id="nav-item-contact">Miscellaneous</a> -->
                </div>
                <ul class="navbar-nav ms-auto" id="navbar-nav-right">
                    <li class="nav-item dropdown" id="nav-item-login">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['name']); ?>
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center align-items-center"> <!-- Center the content vertically and horizontally -->
            <div class="col-lg-8"> <!-- Adjust the width of the column as per your design -->
                <h1 class="mb-4">Shopping Cart</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <?php
                                $itemName = $row['item_name'];
                                $itemPrice = $row['item_price'];
                                $quantity = $row['quantity'];
                                $totalItemPrice = $itemPrice * $quantity;
                                $totalPrice += $totalItemPrice;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($itemName); ?></td>
                                    <td><?php echo number_format($itemPrice, 2); ?> Bells</td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo number_format($totalItemPrice, 2); ?> Bells</td>
                                </tr>
                            <?php endwhile; ?>

                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong><?php echo number_format($totalPrice, 2); ?> Bells</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
