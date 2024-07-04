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
            <a class="navbar-brand" href="#" id="navbar-brand">Nook's Cranny</a>
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
                    <li class="nav-item" id="nav-item-cart">
                        <a class="nav-link" href="#">Cart</a>
                    </li>
                    <li class="nav-item" id="nav-item-login">
                        <a class="nav-link" href="pages\loginsignup.php">Login</a>
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
    <div class="container">
      <h1 class="fw-light">Full Page Image Slider</h1>
      <p class="lead">The background images for the slider are set directly in the HTML using inline CSS. The images
        in this snippet are from <a href="https://unsplash.com">Unsplash</a>, taken by <a href="https://unsplash.com/@joannakosinska">Joanna Kosinska</a>!</p>
    </div>
  </section>
</body>
</html>