<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch ancestral houses from the database
$siteQuery = "SELECT id, title, description, location, img, latitude, longitude FROM ancestral_house ORDER BY title ASC";
$siteResult = $conn->query($siteQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ancestral Houses - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 70px; margin-right: 50px;">
                <span style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 1.5rem; color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">CandonXplore</span>
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/project-study/home/index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Attractions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                                <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php">Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php">Natural Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php">Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php">Livelihoods</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php">Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php">Experience Program</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/project-study/hotels/hotels.php">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/resto/restaurants.php">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/events/events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/profile/login.php">Profile</a>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero" style="background-image: url('/project-study/uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Explore Ancestral Houses</h1>
            <p>Discover the rich history and culture of Candon City! 🏛️📜</p>
        </div>
    </div>

    <!-- Ancestral Houses Section -->
    <main>
        <!-- Title Section -->
        <section class="text-center py-3" style="background-color: lightblue;">
            <div class="container">
            <h3 class="fw-bold">Ancestral Houses</h3>
            <p class="text-muted">Explore the historical treasures of Candon City.</p>
            </div>
        </section>
        
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <section class="section">
                    <div class="row g-4">
                        <?php
                        if ($siteResult->num_rows > 0) {
                            while ($row = $siteResult->fetch_assoc()) {
                                $imageSrc = (!empty($row['img'])) 
                                    ? "data:image/jpeg;base64," . base64_encode($row['img'])
                                    : "/project-study/uploads/default-site.jpg"; // Default image
                                $location = !empty($row['location']) ? htmlspecialchars($row['location']) : "Location not specified"; // Fallback for missing location
                                ?>
                                <div class="col-12">
                                    <div class="card shadow-sm h-100">
                                        <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="House Image" style="height: 200px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-primary"><i class="fas fa-landmark"></i> <?php echo htmlspecialchars($row['title']); ?></h5>
                                            <p class="card-text text-muted"><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($row['description']); ?></p>
                                            <p class="mt-auto"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <?php echo $location; ?></p>
                                            <div class="d-grid gap-2 mt-3">
                                                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>" target="_blank" class="btn btn-outline-primary"><i class="fas fa-compass"></i> Get Directions</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Removed the break statement to display all content
                            }
                        } else {
                            echo "<p class='text-center text-muted'>No ancestral houses found.</p>";
                        }
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<footer style="display: flex; justify-content: space-around; align-items: center; padding: 20px; background-color: #f8f9fa; color: black;">
    <div style="text-align: center; flex: 1;">
        <img src="../uploads/Coat_of_arms_of_the_Philippines.svg.png" alt="Philippine Coat of Arms" style="width: 100px;">
        <p><strong>REPUBLIC OF THE PHILIPPINES</strong></p>
        <p>All content is in the public domain unless otherwise stated.</p>
        <p><a href="#" style="color: black;">Privacy Policy</a></p>
    </div>
    <div style="text-align: center; flex: 1;">
        <p><strong>ABOUT GOVPH</strong></p>
        <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
        <p>
            <a href="#" style="color: black;">Official Gazette</a> | 
            <a href="#" style="color: black;">Open Data Portal</a> | 
            <a href="#" style="color: black;">Send us your feedback</a>
        </p>
    </div>
    <div style="text-align: center; flex: 1;">
        <p><strong>GOVERNMENT LINKS</strong></p>
        <p>
            <a href="#" style="color: black;">Office of the President</a> | 
            <a href="#" style="color: black;">Office of the Vice President</a> | 
            <a href="#" style="color: black;">Senate of the Philippines</a> | 
            <a href="#" style="color: black;">House of Representatives</a> | 
            <a href="#" style="color: black;">Supreme Court</a> | 
            <a href="#" style="color: black;">Court of Appeals</a> | 
            <a href="#" style="color: black;">Sandiganbayan</a>
        </p>
    </div>
</footer>
    <!-- Scripts -->
    <script src="ancestral-houses.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>