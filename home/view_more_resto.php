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
    <style>
        body {
            margin-top: 100px; /* Prevent content from being blocked by the header */
            margin-bottom: 120px; /* Ensure footer does not block content */
            padding-bottom: 120px; /* Add padding to prevent content from being blocked by the footer */
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        footer {
            position: fixed; /* Fix the footer at the bottom */
            bottom: 0;
            width: 100%;
            z-index: 10;
            padding: 20px;
            background-color: #f8f9fa;
            color: black;
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar bg-body-tertiary fixed-top" style="padding: 0.5rem 1rem;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 50px; margin-right: 10px;">
            <span style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 1.2rem; color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">CandonXplore</span>
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
        <div class="card-body">
            <h1 class="card-title text-center mb-4"><?php echo htmlspecialchars($resto['title']); ?></h1>
            <div class="row">
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
                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo urlencode($resto['latitude'] . ',' . $resto['longitude']); ?>" target="_blank" class="btn btn-primary ms-2">Get Directions</a>
            </div>
        </div>
    </div>
</div>

<footer style="display: flex; justify-content: space-around; align-items: center; padding: 20px; background-color: #f8f9fa; color: black; position: relative; bottom: 0; width: 100%;">
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
</body>
</html>
