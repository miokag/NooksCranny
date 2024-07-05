<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nook's Cranny</title>
    <link rel="icon" type="image/x-icon" href="imgs/Apps.png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
        </div>
    </nav>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <label for="reg-log"></label>
                <div class="card-3d-wrap mx-auto">
                    <div class="card-front">
                        <div class="center-wrap">
                            <form action="../php/signup.php" method="post">
                                <div class="section text-center">
                                    <h4 class="mb-4 pb-3">Sign Up</h4>
                                    <!-- Bootstrap alert for displaying errors -->
                                    <?php
                                    if (isset($_GET['signuperror'])) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo htmlspecialchars($_GET['signuperror']);
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-style" placeholder="Username" id="username" autocomplete="off" required>
                                        <i class="input-icon uil uil-user"></i>
                                        <p id="usernameCond1" class="condition-container"></p>
                                        <p id="usernameCond2" class="condition-container"></p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="password" name="userpass" class="form-style" placeholder="Your Password" id="userpass" autocomplete="off" required>
                                        <i class="input-icon uil uil-lock-alt"></i>
                                        <p id="passwordCond1" class="condition-container"></p>
                                        <p id="passwordCond2" class="condition-container"></p>
                                        <p id="passwordCond3" class="condition-container"></p>
                                        <p id="passwordCond4" class="condition-container"></p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="text" name="userfirstname" class="form-style" placeholder="Your Name" id="userfirstname" autocomplete="off" required>
                                        <i class="input-icon uil uil-user"></i>
                                    </div>
                                    <button type="submit" class="btn mt-4" id="signUpBtn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../scripts/uservalidation.js"></script>
</body>
</html>
