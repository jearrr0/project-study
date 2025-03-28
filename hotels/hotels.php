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
    <title>Hotels - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .hotel-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .hotel-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
        .carousel-inner img {
            border-radius: 10px 0 0 10px;
        }
        .btn-primary, .btn-secondary {
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover, .btn-secondary:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/project-study/uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 70px; margin-right: 50px;">
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/project-study/home/index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Attractions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                                <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php">Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/historical-landsites.php">Historical Landsites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php">Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php">Livelihoods</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/ancestral-houses.php">Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/experience.php">Experience</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="hotels.php">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../resto/restaurants.php">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../events/events.php">Events</a>
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
    <div class="hero" style="background-image: url('/project-study/uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Hotels</h1>
            <p>Discover the best hotels in Candon City.</p>
        </div>
    </div>
    <main>
        <section class="section">
            <h2>Hotels</h2>
            <div class="content">
            <?php
            $sql = "SELECT * FROM hotels";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo '<div class="hotel-item d-flex mb-4 p-3">';
                echo '<div id="carousel-' . $row['id'] . '" class="carousel slide me-4" data-bs-ride="carousel" style="width: 300px;">';
                echo '<div class="carousel-inner">';
                $images = explode(',', $row['img']);
                foreach ($images as $index => $image) {
                    $imagePath = '/project-study/uploads/hotels/' . trim($image); // Prepend base path
                    echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
                    echo '<img src="' . $imagePath . '" class="d-block w-100" alt="Hotel Image">';
                    echo '</div>';
                }
                echo '</div>';
                echo '<button class="carousel-control-prev" type="button" data-bs-target="#carousel-' . $row['id'] . '" data-bs-slide="prev">';
                echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Previous</span>';
                echo '</button>';
                echo '<button class="carousel-control-next" type="button" data-bs-target="#carousel-' . $row['id'] . '" data-bs-slide="next">';
                echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Next</span>';
                echo '</button>';
                echo '</div>';
                echo '<div>';
                echo '<h3 class="mb-3">' . $row['title'] . '</h3>';
                echo '<p class="text-muted">' . $row['description'] . '</p>';
                echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                echo '<p><strong>Contact:</strong> ' . $row['contact_number'] . ' | ' . $row['email'] . '</p>';
                echo '<p><strong>Rooms:</strong> ' . $row['rooms'] . '</p>';
                echo '<p><strong>Type:</strong> ' . $row['type'] . '</p>';
                echo '<p><strong>Nearby Places:</strong> ' . $row['nearby_places'] . '</p>';
                echo '<p><strong>Amenities & Facilities:</strong> ' . $row['amenities_facilities'] . '</p>';
                echo '<a href="https://www.google.com/maps/dir/?api=1&destination=' . $row['latitude'] . ',' . $row['longitude'] . '" target="_blank" class="btn btn-primary me-2">Get Directions</a>';
                echo '<a href="hotel-details.php?id=' . $row['id'] . '" class="btn btn-secondary">View More</a>';
                echo '</div>';
                echo '</div>';
                }
            } else {
                echo '<p>No hotels found.</p>';
            }
            ?>
            </div>
        </section>
    </main>
    <footer>
        <p>REPUBLIC OF THE PHILIPPINES</p>
        <p>All content is in the public domain unless otherwise stated.</p>
        <p><a href="#">Privacy Policy</a></p>
        <p>ABOUT GOVPH</p>
        <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
        <p><a href="#">Official Gazette</a> | <a href="#">Open Data Portal</a> | <a href="#">Send us your feedback</a></p>
        <p>GOVERNMENT LINKS</p>
        <p><a href="#">Office of the President</a> | <a href="#">Office of the Vice President</a> | <a href="#">Senate of the Philippines</a> | <a href="#">House of Representatives</a> | <a href="#">Supreme Court</a> | <a href="#">Court of Appeals</a> | <a href="#">Sandiganbayan</a></p>
    </footer>
    <script src="hotels.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
