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
    $sql = "SELECT id, title, description, location, contact_number, email, rooms, type, nearby_places, amenities_facilities, img, latitude, longitude FROM hotels WHERE id = ?";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin-top: 100px;
            margin-bottom: 80px;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .card-title {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .social-icons a {
            font-size: 1.5rem;
            margin: 0 10px;
            color: #007bff;
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar bg-body-tertiary fixed-top" style="padding: 0.5rem 1rem;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 50px; margin-right: 10px;">
            <span>CandonXplore</span>
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
                        <a class="nav-link active" aria-current="page" href="/project-study/home/index.php">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-map"></i> Attractions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                            <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php"><i class="bi bi-people"></i> Experience Program</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/hotels/hotels.php"><i class="bi bi-building"></i> Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/resto/restaurants.php"><i class="bi bi-shop"></i> Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/events/events.php"><i class="bi bi-calendar-event"></i> Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/profile/login.php"><i class="bi bi-person"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger text-black px-3 ms-2" href="profile.php?logout=true" style="border: 2px solid #dc3545; border-radius: 20px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body text-center">
            <img src="<?php echo (!empty($hotel['img'])) ? "data:image/jpeg;base64," . base64_encode($hotel['img']) : "/project-study/uploads/default-hotel.jpg"; ?>" alt="Hotel Image" class="img-fluid rounded mb-4">
            <h1 class="card-title">
                <i class="bi bi-building"></i> <?php echo htmlspecialchars($hotel['title']); ?>
            </h1>
            <p><i class="bi bi-info-circle"></i> <strong>Description:</strong> <?php echo htmlspecialchars($hotel['description']); ?></p>
            <p><i class="bi bi-geo-alt"></i> <strong>Location:</strong> <?php echo htmlspecialchars($hotel['location']); ?></p>
            <p><i class="bi bi-telephone"></i> <strong>Contact Number:</strong> <?php echo htmlspecialchars($hotel['contact_number']); ?></p>
            <p><i class="bi bi-envelope"></i> <strong>Email:</strong> <?php echo htmlspecialchars($hotel['email']); ?></p>
            <p><i class="bi bi-door-open"></i> <strong>Rooms Available:</strong> <?php echo $hotel['rooms']; ?></p>
            <p><i class="bi bi-building"></i> <strong>Type:</strong> <?php echo htmlspecialchars($hotel['type']); ?></p>
            <p><i class="bi bi-map"></i> <strong>Nearby Places:</strong> <?php echo htmlspecialchars($hotel['nearby_places']); ?></p>
            <p><i class="bi bi-list-check"></i> <strong>Amenities & Facilities:</strong> <?php echo htmlspecialchars($hotel['amenities_facilities']); ?></p>
            <div class="social-icons mt-3">
                <p>No website links available.</p>
            </div>
            <div class="text-center mt-4">
                <a href="/project-study/hotels/hotels.php" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Back to Hotels
                </a>
                <a href="<?php echo (!empty($hotel['latitude']) && !empty($hotel['longitude'])) 
    ? "https://www.google.com/maps/dir/?api=1&destination={$hotel['latitude']},{$hotel['longitude']}" 
    : '#'; ?>" 
    target="_blank" 
    class="btn btn-success" 
    <?php if (empty($hotel['latitude']) || empty($hotel['longitude'])) echo 'disabled'; ?>>
    <i class="bi bi-geo-alt"></i> Get Directions
</a>
            </div>
        </div>
    </div>
</div>

<footer style="display: flex; justify-content: space-around; align-items: center; padding: 20px; background-color: #f8f9fa; color: black;">
    <div style="text-align: center; flex: 1;">
        <img src="../uploads/Coat_of_arms_of_the_Philippines.svg.png" alt="Philippine Coat of Arms" style="width: 100px;">
        <p><strong>REPUBLIC OF THE PHILIPPINES</strong></p>
        <p>All content is in the public domain unless otherwise stated.</p>
        <p><a href="#" style="color: black;"><i class="bi bi-shield-lock"></i> Privacy Policy</a></p>
    </div>
    <div style="text-align: center; flex: 1;">
        <p><strong>ABOUT GOVPH</strong></p>
        <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
        <p>
            <a href="#" style="color: black;"><i class="bi bi-journal"></i> Official Gazette</a> | 
            <a href="#" style="color: black;"><i class="bi bi-bar-chart"></i> Open Data Portal</a> | 
            <a href="#" style="color: black;"><i class="bi bi-chat-dots"></i> Send us your feedback</a>
        </p>
    </div>
    <div style="text-align: center; flex: 1;">
        <p><strong>GOVERNMENT LINKS</strong></p>
        <p>
            <a href="#" style="color: black;"><i class="bi bi-building"></i> Office of the President</a> | 
            <a href="#" style="color: black;"><i class="bi bi-person-badge"></i> Office of the Vice President</a> | 
            <a href="#" style="color: black;"><i class="bi bi-bank"></i> Senate of the Philippines</a> | 
            <a href="#" style="color: black;"><i class="bi bi-house"></i> House of Representatives</a> | 
            <a href="#" style="color: black;"><i class="bi bi-gavel"></i> Supreme Court</a> | 
            <a href="#" style="color: black;"><i class="bi bi-columns-gap"></i> Court of Appeals</a> | 
            <a href="#" style="color: black;"><i class="bi bi-scales"></i> Sandiganbayan</a>
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    function getDirections(destinationLat, destinationLng) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                const directionsUrl = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${destinationLat},${destinationLng}`;
                window.open(directionsUrl, '_blank');
            }, function(error) {
                alert('Unable to retrieve your location. Please enable location services and try again.');
            });
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    }
</script>
</body>
</html>
