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
                    <a class="nav-link active" href="#" id="nav-item-home">About</a>
                    <a class="nav-link" href="#" id="nav-item-about">Furniture</a>
                    <a class="nav-link" href="#" id="nav-item-services">Clothes</a>
                    <a class="nav-link" href="#" id="nav-item-contact">Miscellaneous</a>
                </div>
                <ul class="navbar-nav ms-auto" id="navbar-nav-right">
                    <li class="nav-item dropdown" id="nav-item-login">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['name']); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="userprofile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Cart</a></li>
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
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('https://pbs.twimg.com/media/GIG4b2JWoAAxiAe?format=jpg&name=large')">
                    <div class="carousel-caption">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('https://pbs.twimg.com/media/F55_GbuaUAAdPic?format=jpg&name=large')">
                    <div class="carousel-caption">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
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
  
    <!-- Page Content -->
    <section class="py-5">
    <div class="row row-cols-3 g-3">  
    <?php
    // database connection code
    $con = mysqli_connect('localhost', 'root', '','NooksCranny');

    // database insert SQL code
    $sql = "SELECT * FROM products";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo '<div class="col">';
        echo '<div class="card">';
        echo '<img src="'.$row["img"]. '" class="card-img-top" alt="coffee" />';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row["item_name"].'</h5>';
        echo '<p class="card-text">'. $row["item_desc"].'</p>';
        echo '<p class="qty">'. $row["item_price"].' Bells</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    }
    } else {
    echo "0 results";
    }
    $con->close();

    ?>
    </div>
    </section>
</body>
</html>
