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

// Fetch historical tourist sites from the database
$siteQuery = "SELECT id, title, description, img, latitude, longitude, location FROM histo ORDER BY title ASC"; // Updated table
$siteResult = $conn->query($siteQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Historical Tourist Sites - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->

    <style>
    /* General card styling */
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    /* Image adjustments */
    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    /* Card body layout */
    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
    }

    /* Contact details */
    .hotel-contact {
        font-size: 0.85rem;
        color: #777;
        margin-top: 10px;
    }

    /* Buttons */
    .btn {
        border-radius: 8px;
        padding: 10px;
        font-size: 0.9rem;
    }

    /* Amenities */
    .amenities {
        font-size: 0.9rem;
        color: #444;
        margin-top: 10px;
        font-weight: 500;
    }

    /* Location text */
    .location {
        font-size: 0.9rem;
        color: #007bff;
        font-weight: 600;
    }

    /* Nearby places */
    .nearby {
        font-size: 0.85rem;
        color: #666;
        font-style: italic;
        margin-top: 5px;
    }

    /* Recommended events carousel styling */
    .recommendation-section {
        text-align: center;
        margin-bottom: 20px;
        width: 100%;
    }

    .recommendation-card img {
        max-height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .recommendation-card h6 {
        font-size: 1rem;
        font-weight: bold;
        margin-top: 10px;
    }

    .recommendation-card p {
        font-size: 0.85rem;
        color: #555;
    }

    .recommendation-card .btn {
        font-size: 0.8rem;
        padding: 5px 10px;
    }

    /* Where to Stay Section Styling */
    .where-to-stay {
        text-align: center;
        margin-top: 30px;
        padding: 20px;
        background: linear-gradient(135deg, #007bff, #00c6ff);
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .where-to-stay:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .where-to-stay h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .where-to-stay p {
        font-size: 1rem;
        margin: 0;
    }

    /* Add colors to icons */
    .card-body i {
        color: #007bff; /* Primary color for icons */
    }

    .recommendation-card i {
        color: #ff9800; /* Orange for recommendation icons */
    }

    /* Button colors */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }
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
                                <li><a class="dropdown-item" href="../pages/historical-tourist-sites.php">Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../pages/natural_tourist_sites.php">Natural Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../pages/recreational-facilities.php">Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="../pages/livelihoods.php">Livelihoods</a></li>
                                <li><a class="dropdown-item" href="../pages/ancestral_houses.php">Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="../pages/experienceprogram.php">Experience Program</a></li>
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
            <h1>Explore Historical Sites</h1>
            <p>Discover the rich history and culture of Candon City! 🏛️📜</p>
        </div>
    </div>

    <!-- Where to Stay Section (Top) -->
    <div class="container-fluid mt-4">
        <div class="where-to-stay">
            <h2>Historical Tourist Sites in Candon City</h2>
            <p>Explore the landmarks that define the city's heritage.</p>
        </div>
    </div>

    <!-- Historical Sites Section -->
    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <!-- Single Column Site Display -->
                <div class="col-12 col-md-9">
                    <section class="section">
                        <div class="row">
                            <?php
                            if ($siteResult->num_rows > 0) {
                                while ($row = $siteResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['img'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['img'])
                                        : "/project-study/uploads/default-site.jpg"; // Default image
                                    $location = !empty($row['location']) ? htmlspecialchars($row['location']) : "Location not specified"; // Fallback for missing location
                                    ?>
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="Site Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-landmark"></i> <?php echo htmlspecialchars($row['title']); ?></h5>
                                                <p class="card-text"><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($row['description']); ?></p>
                                                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <?php echo $location; ?></p>
                                                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>" target="_blank" class="btn btn-primary"><i class="fas fa-compass"></i> Get Directions</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>No historical sites found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>
