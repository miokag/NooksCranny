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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nook's Cranny</title>
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
    <link rel="stylesheet" href="style/indexstyle.css">
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
                    <a class="nav-link active" href="#" id="nav-item-home">Home</a>
                    <a class="nav-link" href="pages/furniture.php" id="nav-item-about">Furniture</a>
                    <a class="nav-link" href="pages/clothes.php" id="nav-item-services">Clothes</a>
                    <a class="nav-link" href="pages/miscellaneous.php" id="nav-item-contact">Miscellaneous</a>
                </div>
                <ul class="navbar-nav ms-auto" id="navbar-nav-right">
                    <li class="nav-item dropdown" id="nav-item-login">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['name']); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li><a class="dropdown-item" href="userprofile.php">Profile</a></li> -->
                                <li><a class="dropdown-item" href="pages/cart.php">Cart</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                            </ul>
                        <?php else: ?>
                            <div class="dropdown user-toggle">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="userdropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person"></i>
                                </button>
                                <form class="dropdown-menu p-4 dropdown-menu-end" aria-labelledby="userdropdownMenuButton" action="php/login.php" method="post">
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
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('https://pbs.twimg.com/media/GKlZFlwW4AARSZX?format=jpg&name=large')">
                    <div class="carousel-caption">
                        <h5>New Horizons!</h5>
                        <p>In New Horizons, you who moves to a deserted island after purchasing a getaway package from Tom Nook, can accomplish assigned tasks, and develop the island as they choose.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- Video slide -->
                    <video autoplay muted loop class="w-100">
                        <source src="img/carouselvid.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>
  
    <div class="container-fluid p-5 mt-5">
        <div class="row row-cols-1 g-4">
            <?php
            // Database connection code
            $con = mysqli_connect('localhost', 'root', '', 'NooksCranny');

            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            // Database query to fetch distinct item types
            $sql = "SELECT DISTINCT item_type FROM products";
            $result = $con->query($sql);

            if ($result) {
                // Fetch all item types into an array
                $itemTypes = [];
                while ($row = $result->fetch_assoc()) {
                    $itemTypes[] = $row['item_type'];
                }

                // Loop through each item type
                foreach ($itemTypes as $itemType) {
                    // Query products by item_type
                    $sqlProducts = "SELECT * FROM products WHERE item_type = '$itemType'";
                    $resultProducts = $con->query($sqlProducts);

                    if ($resultProducts->num_rows > 0) {
                        // Fetch all products for the current item type
                        $products = mysqli_fetch_all($resultProducts, MYSQLI_ASSOC);

                        // Start a new column for each item type with heading
                        echo '<div class="col">';
                        echo '<h2>' . ucfirst($itemType) . '</h2>'; // Display item type as heading

                        // Start carousel for this item type
                        echo '<div id="carousel_' . $itemType . '" class="carousel slide mb-5" style="max-height: 40vh; overflow: hidden;" data-bs-ride="carousel" data-bs-interval="3000">';
                        echo '<div class="carousel-inner">';

                        $numItems = count($products);
                        $itemsPerSlide = 5; // Number of items per slide

                        for ($slide = 0; $slide < ceil($numItems / $itemsPerSlide); $slide++) {
                            echo '<div class="carousel-item ' . ($slide === 0 ? 'active' : '') . '">';
                            echo '<div class="row row-cols-1 row-cols-md-5 g-4 align-items-stretch" style="max-height: 40vh">'; // Row for product cards, align items to stretch height

                            // Loop through items for this slide
                            for ($i = 0; $i < $itemsPerSlide; $i++) {
                                $index = ($slide * $itemsPerSlide + $i) % $numItems;
                                if ($index < $numItems) {
                                    $product = $products[$index];

                                    // Construct image path
                                    $imagePath = "img/products/" . $product["item_name"] . ".png"; 

                                    // Product card
                                    echo '<div class="col mb-4">';
                                    echo '<div class="card product-card h-100">'; // Ensure each card is the same height
                                    echo '<img src="' . $imagePath . '" class="card-img-top" alt="' . $product["item_name"] . '">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">' . $product["item_name"] . '</h5>';
                                    echo '<p class="card-text">Price: ' . $product["item_price"] . ' Bells</p>';
                                    echo '</div>'; // Close card-body
                                    
                                    // Add to Cart form
                                    echo '<form action="php/addtocart.php" method="post">';
                                    echo '<input type="hidden" name="productId" value="' . $product["item_id"] . '">';

                                    // Check if user is logged in
                                    if (isset($_SESSION['username'])) {
                                        echo '<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center" style="width: 100%; height: 3vh; margin-bottom: 3vh">Add to Cart</button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-primary d-flex justify-content-center align-items-center" style="width: 100%; height: 3vh; margin-bottom: 3vh" onclick="showLoginPrompt()">Add to Cart</button>';
                                    }
                                    echo '</form>';

                                    echo '</div>'; // Close card
                                    echo '</div>'; // Close col
                                }
                            }
                            echo '</div>'; // Close row
                            echo '</div>'; // Close carousel-item
                        }

                        // Previous and next buttons
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carousel_' . $itemType . '" data-bs-slide="prev">';
                        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Previous</span>';
                        echo '</button>';

                        echo '<button class="carousel-control-next" type="button" data-bs-target="#carousel_' . $itemType . '" data-bs-slide="next">';
                        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Next</span>';
                        echo '</button>';

                        echo '</div>'; // Close carousel
                        echo '</div>'; // Close col
                        echo '</div>'; // Close col (added for each item type)
                    } else {
                        echo '<p>No products found for ' . $itemType . '</p>';
                    }
                }
            } else {
                echo "Error: " . $con->error;
            }

            // Close connection
            $con->close();
            ?>
        </div>
        
    </div>

    

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

    <!-- Script to show login prompt -->
    <script>
        function showLoginPrompt() {
            $('#loginPromptModal').modal('show');
        }
    </script>

</body>
</html>