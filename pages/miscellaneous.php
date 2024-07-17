<?php
session_start();

// Check if the user is already logged in via session or cookies
if (!isset($_SESSION['username']) && isset($_COOKIE['username']) && isset($_COOKIE['userpass'])) {
    include "db_conn.php";

    $username = htmlspecialchars($_COOKIE['username']);
    $userpass = htmlspecialchars($_COOKIE['userpass']);

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($userpass, $row['password'])) {
            // Store user information in session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
        }
    }
}

// Pagination variables
$itemsPerPage = 6; // Number of items per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get current page number

// Calculate OFFSET for SQL query
$offset = ($page - 1) * $itemsPerPage;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miscellaneous - Nook's Cranny</title>
    <link rel="icon" type="image/x-icon" href="img/Apps.png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Your custom styles -->
    <link rel="stylesheet" href="../style/miscstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid" id="navbar-container">
            <a class="navbar-brand" href="index.php" id="navbar-brand">Nook's Cranny</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav mx-auto" id="navbar-nav-center">
                    <a class="nav-link" href="../index.php" id="nav-item-home">Home</a>
                    <a class="nav-link" href="furniture.php" id="nav-item-about">Furniture</a>
                    <a class="nav-link" href="clothes.php" id="nav-item-services">Clothes</a>
                    <a class="nav-link active" href="miscellaneous.php" id="nav-item-contact">Miscellaneous</a>
                </div>
                <ul class="navbar-nav ms-auto" id="navbar-nav-right">
                    <li class="nav-item dropdown" id="nav-item-login">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['name']); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../pages/cart.php">Cart</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../php/logout.php">Logout</a></li>
                            </ul>
                        <?php else: ?>
                            <div class="dropdown user-toggle">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="userdropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person"></i>
                                </button>
                                <form class="dropdown-menu p-4 dropdown-menu-end" aria-labelledby="userdropdownMenuButton" action="../php/login.php" method="post">
                                    <div class="form-group">
                                        <label for="loginusername">Username</label>
                                        <input type="text" class="form-control" id="loginusername" name="loginusername" placeholder="Username" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginpass">Password</label>
                                        <input type="password" class="form-control" id="loginpass" name="loginpass" placeholder="Password" autocomplete="off">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
                                        <label class="form-check-label" for="remember-me">
                                            Remember me
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary custom-signin-btn">Sign in</button>
                                    <?php if(isset($_GET['loginerror'])) { ?>
                                        <div class="alert alert-danger mt-3" role="alert">
                                            <?php echo htmlspecialchars($_GET['loginerror']); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="pages/loginsignup.php">New around here? Sign up</a>
                                    <a class="dropdown-item" href="pages/user/forgotpass.html">Forgot password?</a>
                                </form>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- Video slide -->
                    <video autoplay muted loop class="w-100">
                        <source src="../img/toolscaro.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            
        </div>
    </header>

    <div class="header">
        <img src="../img/MiscPic.png" alt="Header Image" styles="text-align: center;">
        <h1 styles="text-align: center;">Miscellaneous</h1>
    </div>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
            <?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'NooksCranny');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Pagination variables
$itemsPerPage = 6; // Number of items per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get current page number

// Calculate OFFSET for SQL query
$offset = ($page - 1) * $itemsPerPage;

// Function to fetch reviews for a product
function getReviewsForProduct($productId, $conn) {
    $sql = "SELECT * FROM reviews WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    return $reviews;
}

// Function to calculate average rating for a product
function calculateAverageRating($productId, $conn) {
    $sql = "SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['avg_rating'] ?: 0; // Return average rating or 0 if no reviews
}

// Function to fetch username based on user_id
function fetchUserName($userId, $conn) {
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['username'] ?? 'Unknown User';
}

// Fetch misc products with pagination
$sql = "SELECT * FROM products WHERE item_type='tools' LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $itemsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Start row container for products
    echo '<div class="row row-cols-1 row-cols-md-2 g-3 justify-content-center">'; // Center align products
    
    while ($row = $result->fetch_assoc()) {
        $imagePath = "../img/products/" . $row["item_name"] . ".png"; 
    
        // Splitting item_desc at the second period
        $description = htmlspecialchars($row['item_desc']);
        $sentences = explode('.', $description);
        $shortened_desc = implode('.', array_slice($sentences, 0, 2)); // Take first two sentences
    
        // Product card start
        echo '<div class="col mb-4">';
        echo '<div class="card h-100">';
        echo '<div class="d-flex justify-content-center align-items-center">';
        echo '<img class="card-img-top img-fluid" src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($row['item_name']) . '" style="max-height: 300px;">'; // Adjust max-height here
        echo '</div>'; // End image container
    
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">' . htmlspecialchars($row['item_name']) . '</h5>'; // Center align product name
        
        // Calculate average rating
        $avgRating = calculateAverageRating($row['item_id'], $conn);
        
        // Display star ratings based on average rating
        echo '<div class="d-flex justify-content-center align-items-center mb-2">';
        echo '<div class="ratings mr-2">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= round($avgRating)) {
                echo '<i class="fa fa-star"></i>';
            } else {
                echo '<i class="fa fa-star-o"></i>';
            }
        }
        echo '</div>';
        echo '<span class="ms-2">' . count(getReviewsForProduct($row['item_id'], $conn)) . ' Reviews</span>'; // Display total number of reviews with space
        echo '</div>';
    
        echo '<p class="card-text text-center">' . $shortened_desc . '</p>'; // Center align description
        
        // Display item price
        echo '<p class="card-text text-center"><strong>Price: </strong>' . htmlspecialchars($row['item_price']) . ' Bells</p>';
        
        // Button to open modal with product details and reviews
        echo '<div class="d-flex justify-content-center">';
        echo '<button class="btn btn-primary btn-sm me-2" type="button" data-bs-toggle="modal" data-bs-target="#productModal' . $row['item_id'] . '">Details</button>';
        
        // Add to cart button (conditional based on login)
        if (isset($_SESSION['username'])) {
            echo '<form action="../php/addtocart.php" method="post">';
            echo '<input type="hidden" name="productId" value="' . htmlspecialchars($row['item_id']) . '">';
            echo '<button class="btn btn-outline-primary btn-sm" type="submit">Add to Cart</button>';
            echo '</form>';
        } else {
            echo '<button class="btn btn-outline-primary btn-sm" onclick="showLoginPrompt()">Add to Cart</button>';
        }
        echo '</div>'; // End button container

        echo '</div>'; // End card-body
        
        echo '</div>'; // End card
        echo '</div>'; // End col
        
        // Modal for product details and reviews
        echo '<div class="modal fade" id="productModal' . $row['item_id'] . '" tabindex="-1" aria-labelledby="productModalLabel' . $row['item_id'] . '" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered modal-lg">'; // Adjust modal-lg class for wider modal
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="productModalLabel' . $row['item_id'] . '">' . htmlspecialchars($row['item_name']) . '</h5>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="modal-body text-center px-4 py-4">'; // Add padding classes for larger spacing
        echo '<img class="img-fluid mb-3 mx-auto d-block" src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($row['item_name']) . '">'; // Center image with mx-auto

        if (isset($_SESSION['username'])) {
            echo '<form action="../php/addtocart.php" method="post">';
            echo '<input type="hidden" name="productId" value="' . htmlspecialchars($row['item_id']) . '">';
            echo '<p class="text-center"><strong>Price: </strong>' . htmlspecialchars($row['item_price']) . '</p>'; // Add item price above quantity input
            echo '<div class="input-group mb-3 mx-auto" style="max-width: 200px;">'; // Center the input group
            echo '<input type="number" name="quantity" class="form-control text-center" value="1" min="1">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-outline-primary mb-3">Add to Cart</button>'; // Add margin bottom to button
            echo '</form>';
        } else {
            echo '<p class="text-center"><strong>Price: </strong>' . htmlspecialchars($row['item_price']) . '</p>'; // Add item price above quantity input
            echo '<div class="input-group mb-3 mx-auto" style="max-width: 200px;">'; // Center the input group
            echo '<button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>';
            echo '<input type="number" name="quantity" class="form-control text-center" value="1" min="1">';
            echo '<button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>';
            echo '</div>';
            echo '<button class="btn btn-outline-primary mb-3" onclick="showLoginPrompt()">Add to Cart</button>'; // Add margin bottom to button
        }



// Split the description into sentences
$description = htmlspecialchars($row['item_desc']);
$sentences = preg_split('/(?<=[.!?])\s+/', $description);

// Group sentences into paragraphs with 2 sentences each
$paragraphs = array_chunk($sentences, 2);

// Display the paragraphs
foreach ($paragraphs as $paragraph) {
    echo '<p class="text-left">' . implode(' ', $paragraph) . '</p>';
}
        
        echo '<h4 class="text-center">Reviews</h4>';
        $reviews = getReviewsForProduct($row['item_id'], $conn);
        if (!empty($reviews)) {
            foreach ($reviews as $review) {
                $userName = fetchUserName($review['user_id'], $conn); // Fetch username based on user_id
                echo '<div class="card m-2">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">' . htmlspecialchars($userName) . '</h5>'; // Center align user name
                echo '<p class="card-text text-center"><strong>Rating:</strong> ' . htmlspecialchars($review['rating']) . '</p>';
                echo '<p class="card-text text-center"><strong>Review:</strong> ' . htmlspecialchars($review['review_text']) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">No reviews available for this product yet.</p>';
        }
        
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    // End row container for products
    echo '</div>'; // End row

} else {
    echo "<p class='text-center'>No products found in the 'miscellaneous' category.</p>";
}

// Calculate total number of pages
$sql = "SELECT COUNT(*) AS total FROM products WHERE item_type='tools'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalPages = ceil($row['total'] / $itemsPerPage);

// Pagination links
echo '<div class="mt-3">';
echo '<ul class="pagination justify-content-center">';
if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).'">&laquo; Previous</a></li>';
}
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
}
if ($page < $totalPages) {
    echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).'">Next &raquo;</a></li>';
}
echo '</ul>';
echo '</div>';

$conn->close();
?>










<script>
    function showLoginPrompt() {
        $('#loginPromptModal').modal('show');
    }
</script>

<!-- Modal -->
<div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginPromptModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You need to login to add items to your cart.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
