<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, null);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get restaurant ID from URL
$restoId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($restoId > 0) {
    // Fetch restaurant details
    $sql = "SELECT id, title, type_of_resto, location, contacts, services, best_seller_images, resto_image, description, latitude, longitude FROM resto WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resto = $result->fetch_assoc();
    } else {
        echo "<p>Restaurant not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid restaurant ID.</p>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($resto['title']); ?> - Restaurant Details</title>
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
                        <li class="nav-item"><a class="nav-link" href="../hotels/hotels.php">Hotels</a></li>
                        <li class="nav-item"><a class="nav-link" href="restaurants.php">Restaurants</a></li>
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
                <h1 class="card-title text-center"><?php echo htmlspecialchars($resto['title']); ?></h1>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <img src="<?php echo (!empty($resto['resto_image'])) ? "data:image/jpeg;base64," . base64_encode($resto['resto_image']) : "/project-study/uploads/default-resto.jpg"; ?>" alt="Restaurant Image" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($resto['type_of_resto']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($resto['location']); ?></p>
                        <p><strong>Contact:</strong> <?php echo htmlspecialchars($resto['contacts']); ?></p>
                        <p><strong>Services:</strong> <?php echo htmlspecialchars($resto['services']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($resto['description']); ?></p>
                        <p><strong>Latitude:</strong> <?php echo htmlspecialchars($resto['latitude']); ?></p>
                        <p><strong>Longitude:</strong> <?php echo htmlspecialchars($resto['longitude']); ?></p>
                        <p><strong>Best Sellers:</strong></p>
                        <img src="<?php echo (!empty($resto['best_seller_images'])) ? "data:image/jpeg;base64," . base64_encode($resto['best_seller_images']) : "/project-study/uploads/default-food.jpg"; ?>" alt="Best Seller" class="img-fluid rounded">
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="/project-study/resto/restaurants.php" class="btn btn-primary">Back to Restaurants</a>
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
