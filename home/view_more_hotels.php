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

// Get hotel ID from URL
$hotelId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($hotelId > 0) {
    // Fetch hotel details
    $sql = "SELECT id, title, description, location, contact_number, email, rooms, type, nearby_places, amenities_facilities, img, latitude, longitude, website_link FROM hotels WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hotelId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hotel = $result->fetch_assoc();
    } else {
        echo "<p>Hotel not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid hotel ID.</p>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($hotel['title']); ?> - Hotel Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 70px; margin-right: 50px;">
                <span style="font-family: 'Arial', sans-serif; font-weight: bold;">CandonXplore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">CandonXplore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../attractions/pages/historical-tourist-sites.php">Attractions</a></li>
                        <li class="nav-item"><a class="nav-link" href="hotels.php">Hotels</a></li>
                        <li class="nav-item"><a class="nav-link" href="../resto/restaurants.php">Restaurants</a></li>
                        <li class="nav-item"><a class="nav-link" href="/project-study/events/events.php">Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="/project-study/profile/login.php">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo htmlspecialchars($hotel['title']); ?></h1>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <img src="<?php echo (!empty($hotel['img'])) ? "data:image/jpeg;base64," . base64_encode($hotel['img']) : "/project-study/uploads/default-hotel.jpg"; ?>" alt="Hotel Image" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($hotel['location']); ?></p>
                        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($hotel['contact_number']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($hotel['email']); ?></p>
                        <p><strong>Rooms Available:</strong> <?php echo $hotel['rooms']; ?></p>
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($hotel['type']); ?></p>
                        <p><strong>Nearby Places:</strong> <?php echo htmlspecialchars($hotel['nearby_places']); ?></p>
                        <p><strong>Amenities & Facilities:</strong> <?php echo htmlspecialchars($hotel['amenities_facilities']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($hotel['description']); ?></p>
                        <p><strong>Latitude:</strong> <?php echo htmlspecialchars($hotel['latitude']); ?></p>
                        <p><strong>Longitude:</strong> <?php echo htmlspecialchars($hotel['longitude']); ?></p>
                        <p><strong>Website:</strong> <a href="<?php echo htmlspecialchars($hotel['website_link']); ?>" target="_blank"><?php echo htmlspecialchars($hotel['website_link']); ?></a></p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="/project-study/hotels/hotels.php" class="btn btn-primary">Back to Hotels</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center py-4 mt-5">
        <p>REPUBLIC OF THE PHILIPPINES</p>
        <p>All content is in the public domain unless otherwise stated.</p>
        <p><a href="#">Privacy Policy</a></p>
        <p>ABOUT GOVPH</p>
        <p>Learn more about the Philippine government, its structure, how government works, and the people behind it.</p>
        <p><a href="#">Official Gazette</a> | <a href="#">Open Data Portal</a> | <a href="#">Send us your feedback</a></p>
    </footer>
</body>
</html>
