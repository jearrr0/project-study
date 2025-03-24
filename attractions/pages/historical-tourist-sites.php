<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if database exists
$db_selected = mysqli_select_db($conn, $dbname);
if (!$db_selected) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historical Tourist Sites - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="historical-tourist-sites.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 70px; margin-right: 50px;">
                <span style="font-family: 'Arial', sans-serif; font-weight: bold;">CandonXplore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">CandonXplore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a class="nav-link active" href="../../home/index.php">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown">Attractions</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="historical-tourist-sites.php">Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="historical-landsites.php">Historical Landsites</a></li>
                                <li><a class="dropdown-item" href="recreational-facilities.php">Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="livelihoods.php">Livelihoods</a></li>
                                <li><a class="dropdown-item" href="ancestral-houses.php">Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="experience.php">Experience</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../../hotels">Hotels</a></li>
                        <li class="nav-item"><a class="nav-link" href="../../resto">Restaurants</a></li>
                        <li class="nav-item"><a class="nav-link" href="../../events">Events</a></li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero" style="background-image: url('../../uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Historical Tourist Sites</h1>
            <p>Discover the historical tourist sites of Candon City.</p>
        </div>
    </div>

    <main>
        <section class="section">
            <h2>Historical Tourist Sites</h2>
            <div class="content">
                <div id="carouselExampleDark" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="../../uploads/home/1 (1).jpg" class="d-block w-100" alt="First Slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First Tourist Spot</h5>
                                <p>Explore this beautiful location.</p>
                                <a href="https://www.google.com/maps/search/?api=1&query=First+Tourist+Spot+Candon+City" target="_blank" class="btn btn-primary">Get Directions</a>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="../../uploads/home/1 (2).jpg" class="d-block w-100" alt="Second Slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second Tourist Spot</h5>
                                <p>Visit this amazing place.</p>
                                <a href="https://www.google.com/maps/search/?api=1&query=Second+Tourist+Spot+Candon+City" target="_blank" class="btn btn-primary">Get Directions</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../../uploads/home/1 (3).jpg" class="d-block w-100" alt="Third Slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third Tourist Spot</h5>
                                <p>Enjoy the view at this site.</p>
                                <a href="https://www.google.com/maps/search/?api=1&query=Third+Tourist+Spot+Candon+City" target="_blank" class="btn btn-primary">Get Directions</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <!-- General Get Directions Button -->
                
            </div>
        </section>
    </main>

    <footer>
        <p>REPUBLIC OF THE PHILIPPINES | All content is in the public domain unless otherwise stated.</p>
    </footer>

    <script src="../../home/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
