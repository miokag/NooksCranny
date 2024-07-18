<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

include "../php/db_conn.php"; // Include your database connection file

$username = $_SESSION['username'];

// Query to fetch cart items for the logged-in user
$sql = "SELECT cart.order_id, cart.item_id, cart.quantity, products.item_name, products.item_price
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
    <link rel="icon" type="image/x-icon" href="../img/Apps.png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="../style/cartstyle.css">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Your existing JavaScript code

            // Function to update quantity and total price dynamically
            function updateQuantity(orderId, change, itemPrice) {
                var quantityElement = $('#quantity' + orderId);
                var currentQuantity = parseInt(quantityElement.val().trim()); // Assuming it's a text input
                var newQuantity = currentQuantity + change;

                if (newQuantity < 1) {
                    alert('Quantity cannot be less than 1.');
                    return;
                }

                quantityElement.val(newQuantity);

                // Update total price for the item
                var totalItemPriceElement = $('#totalItemPrice' + orderId);
                var newTotalItemPrice = itemPrice * newQuantity;

                if (isNaN(newTotalItemPrice)) {
                    alert('Error: Item price is not valid.');
                    return;
                }

                totalItemPriceElement.text(newTotalItemPrice.toFixed(2) + ' Bells');

                // Update total price of all items
                calculateTotalPrice();

                // AJAX request to update quantity in database
                $.ajax({
                    url: '../php/update_quantity.php',
                    method: 'POST',
                    data: {
                        orderId: orderId,
                        change: change
                    },
                    success: function(response) {
                        // Optionally handle success response
                        console.log('Quantity updated successfully in database.');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error updating quantity:', error);
                    }
                });
            }

            // Function to calculate total price of all items
            function calculateTotalPrice() {
                var totalPrice = 0;
                $('.item-total-price').each(function() {
                    var priceText = $(this).text().replace(' Bells', '').trim();
                    totalPrice += parseFloat(priceText);
                });

                $('#totalPrice').text(totalPrice.toFixed(2) + ' Bells');
            }

            // Event listeners for plus and minus buttons
            $(document).on('click', '.btn-minus', function() {
                var orderId = $(this).data('order-id');
                var itemPrice = parseFloat($(this).data('item-price')); 
                updateQuantity(orderId, -1, itemPrice);
            });

            $(document).on('click', '.btn-plus', function() {
                var orderId = $(this).data('order-id');
                var itemPrice = parseFloat($(this).data('item-price')); 
                updateQuantity(orderId, 1, itemPrice);
            });

            // Event listener for checkout button
            $('#checkoutButton').click(function() {
                $('#checkoutModal').modal('show');
            });

            // Event listener for submitting the checkout form
            $('#checkoutForm').submit(function(event) {
                event.preventDefault();
                // Validate form inputs here before submitting
                var cardNumber = $('#cardNumber').val().trim();
                var cardName = $('#cardName').val().trim();
                var address = $('#address').val().trim();
                var expirationDate = $('#expirationDate').val().trim();
                var csv = $('#csv').val().trim();

                // Validate card number format (16 digits)
                if (!(/^\d{16}$/.test(cardNumber))) {
                    $('#cardNumber').addClass('is-invalid');
                    return;
                } else {
                    $('#cardNumber').removeClass('is-invalid');
                }

                // Validate expiration date format (MM/YYYY)
                if (!(/^\d{2}\/\d{4}$/.test(expirationDate))) {
                    $('#expirationDate').addClass('is-invalid');
                    return;
                } else {
                    $('#expirationDate').removeClass('is-invalid');
                }

                // Validate CSV format (3 digits)
                if (!(/^\d{3}$/.test(csv))) {
                    $('#csv').addClass('is-invalid');
                    return;
                } else {
                    $('#csv').removeClass('is-invalid');
                }

                $.ajax({
            url: '../php/checkout.php',
            method: 'POST',
            data: {
                cardNumber: cardNumber,
                cardName: cardName,
                address: address,
                expirationDate: expirationDate,
                csv: csv
            },
            success: function(response) {
                // Parse JSON response
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    // Clear cart items from UI
                    $('#cartTable tbody').empty();
                    // Update total price display if needed
                    $('#totalPrice').text('0.00 Bells');

                    // Show success modal
                    $('#checkoutModal').modal('hide'); // Hide checkout modal first
                    $('#successModal').modal('show'); // Show success modal
                } else {
                    // Handle other response statuses if needed
                    alert('Failed to process checkout. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error processing checkout:', error);
                alert('Failed to process checkout. Please try again.');
            }
        });
    });
});
        
    </script>
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
                    <a class="nav-link active" href="#" id="nav-item-home">About</a>
                    <a class="nav-link" href="#" id="nav-item-about">Furniture</a>
                    <a class="nav-link" href="#" id="nav-item-services">Clothes</a>
                    <a class="nav-link" href="#" id="nav-item-contact">Miscellaneous</a>
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
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
                <h1 class="mb-4 mt-5">Shopping Cart</h1>
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
                        $orderId = $row['order_id'];
                        $itemName = $row['item_name'];
                        $itemPrice = $row['item_price'];
                        $quantity = $row['quantity'];
                        $totalItemPrice = $itemPrice * $quantity;
                        $totalPrice += $totalItemPrice;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($itemName); ?></td>
                            <td><?php echo number_format($itemPrice, 2); ?> Bells</td>
                            <td style="padding: 3vh;">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary btn-minus" data-order-id="<?php echo $orderId; ?>" data-item-price="<?php echo $itemPrice; ?>" style="width: 4vh;">-</button>
                                    <input id="quantity<?php echo $orderId; ?>" type="text" class="form-control form-control-sm quantity-input mx-1" value="<?php echo $quantity; ?>" readonly style="width: 5vh;">
                                    <button class="btn btn-sm btn-outline-secondary btn-plus" data-order-id="<?php echo $orderId; ?>" data-item-price="<?php echo $itemPrice; ?>" style="width: 4vh;">+</button>
                                    <button class="btn btn-sm btn-outline-danger btn-remove" data-order-id="<?php echo $orderId; ?>" style="width: 9vh;">Remove</button>
                                </div>
                            </td>

                            <td id="totalItemPrice<?php echo $orderId; ?>" class="item-total-price"><?php echo number_format($totalItemPrice, 2); ?> Bells</td>
                        </tr>
                    <?php endwhile; ?>


                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td id="totalPrice"><strong><?php echo number_format($totalPrice, 2); ?> Bells</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </<!-- Checkout button -->
                <button id="checkoutButton" class="btn btn-primary">Checkout</button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Purchase Successful!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your items have been successfully purchased and your cart has been cleared.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="checkoutForm" action="../php/checkout.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                        <div class="invalid-feedback">Please enter a valid 16-digit card number.</div>
                    </div>
                    <div class="mb-3">
                        <label for="cardName" class="form-label">Name on Card</label>
                        <input type="text" class="form-control" id="cardName" name="cardName" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Billing Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="expirationDate" class="form-label">Expiration Date (MM/YYYY)</label>
                            <input type="text" class="form-control" id="expirationDate" name="expirationDate" placeholder="MM/YYYY" required>
                            <div class="invalid-feedback">Please enter a valid expiration date in MM/YYYY format.</div>
                        </div>
                        <div class="col">
                            <label for="csv" class="form-label">CSV</label>
                            <input type="text" class="form-control" id="csv" name="csv" required>
                            <div class="invalid-feedback">Please enter a valid 3-digit CSV number.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="checkoutForm" action="../php/checkout.php" method="post">
                    <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                </form>

                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>