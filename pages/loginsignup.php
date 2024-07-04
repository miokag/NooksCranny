<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nook's Cranny</title>
    <link rel="icon" type="image/x-icon" href="imgs/Apps.png">
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
    <link rel="stylesheet" href="../style/signuploginstyle.css">
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
            </div>
        </div>
    </nav>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <form action="../php/login.php" method="post">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Log In</h4>
                                                <?php if(isset($_GET['loginerror'])) { ?>
                                                    <p class="error"><?php echo $_GET['loginerror']; ?></p>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <input type="text" name="loginusername" class="form-style" placeholder="Username" id="loginusername" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="loginpass" class="form-style" placeholder="Your Password" id="loginpass" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2 form-check">
                                                    <input class="checkbox" type="checkbox" id="remember-me" name="remember-me"/>
                                                    <label for="remember-me">Remember Me</label>
                                                </div>
                                                <button type="submit" class="btn mt-4">Login</button>
                                                <p class="mb-0 mt-4 text-center"><a href="forgotpass.html" class="link">Forgot your password?</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <form action="../php/signup.php" method="post">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Sign Up</h4>
                                                <?php if(isset($_GET['signuperror'])) { ?>
                                                    <p class="error"><?php echo $_GET['signuperror']; ?></p>
                                                <?php } ?>
                                                <?php if(isset($_GET['success'])) { ?>
                                                    <p class="success"><?php echo $_GET['success']; ?></p>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-style" placeholder="Username" id="username" autocomplete="off">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="userpass" class="form-style" placeholder="Your Password" id="userpass" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="userfirstname" class="form-style" placeholder="Your Name" id="userfirstname" autocomplete="off">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../scripts/uservalidation.js"></script>
</body>
</html>
