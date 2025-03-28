<?php
session_start();

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

$user_logged_in = isset($_SESSION['username']) ? true : false;
$username = $user_logged_in ? $_SESSION['username'] : null;

// Handle rating submission (Update instead of Insert)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rate_hotel'])) {
    if (!$user_logged_in) {
        echo json_encode(["status" => "error", "message" => "You must log in to rate."]);
        exit;
    }

    $hotel_id = $_POST['hotel_id'];
    $rating = $_POST['rating'];

    // Check if user already rated this hotel
    $check_query = "SELECT * FROM hotel_ratings WHERE hotel_id = '$hotel_id' AND uname = '$username'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // If rating exists, update it
        $update_query = "UPDATE hotel_ratings SET rating = '$rating' WHERE hotel_id = '$hotel_id' AND uname = '$username'";
        $conn->query($update_query);
        echo json_encode(["status" => "success", "message" => "Your rating has been updated!"]);
    } else {
        // If no rating exists, insert new
        $insert_query = "INSERT INTO hotel_ratings (uname, hotel_id, rating) VALUES ('$username', '$hotel_id', '$rating')";
        $conn->query($insert_query);
        echo json_encode(["status" => "success", "message" => "Thank you for rating!"]);
    }
    exit;
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
</head>
    <style>
        .hotel-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn-warning {
            color: #fff;
        }
        .stars {
            color: #f39c12;
            font-size: 1.2em;
        }
        footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
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
                            <a class="nav-link" href="../hotels/hotels.php">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="restaurants.php">Restaurants</a>
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

<div class="container mt-5">
    <h2>Hotels</h2>
    <div class="row">
        <?php
        $sql = "SELECT h.*, 
                (SELECT AVG(rating) FROM hotel_ratings WHERE hotel_id = h.id) AS avg_rating,
                (SELECT rating FROM hotel_ratings WHERE hotel_id = h.id AND uname = '$username' LIMIT 1) AS user_rating 
                FROM hotels h";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $avg_rating = round($row['avg_rating'], 1);
                $user_rating = $row['user_rating'] ? $row['user_rating'] : "Not Rated";
                echo '<div class="col-md-4">';
                echo '<div class="hotel-item">';
                echo '<h4>' . $row['title'] . '</h4>';
                echo '<p><strong>Average Rating:</strong> ' . displayStars($avg_rating) . ' (' . $avg_rating . '/5)</p>';
                echo '<p><strong>Your Rating:</strong> ' . ($user_rating !== "Not Rated" ? displayStars($user_rating) : $user_rating) . '</p>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<a href="https://www.google.com/maps/dir/?api=1&destination=' . $row['latitude'] . ',' . $row['longitude'] . '" target="_blank" class="btn btn-primary me-2">Get Directions</a>';
                echo '<a href="hotel-details.php?id=' . $row['id'] . '" class="btn btn-secondary me-2">View More</a>';
                echo '<button class="btn btn-warning" onclick="openRatingModal(' . $row['id'] . ', ' . ($user_rating !== "Not Rated" ? $user_rating : "0") . ')">Rate</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No hotels found.</p>';
        }

        function displayStars($rating) {
            $fullStars = floor($rating);
            $halfStar = ($rating - $fullStars) >= 0.5 ? '★' : '';
            return str_repeat('★', $fullStars) . $halfStar . str_repeat('☆', 5 - $fullStars - ($halfStar ? 1 : 0));
        }
        ?>
    </div>
</div>

<!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rate This Hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if ($user_logged_in): ?>
                    <form id="ratingForm">
                        <input type="hidden" id="hotel_id" name="hotel_id">
                        <label for="rating">Select Rating:</label>
                        <select class="form-control" id="rating" name="rating" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-3">Submit Rating</button>
                    </form>
                <?php else: ?>
                    <p>You must <a href="register.php">create an account</a> or <a href="login.php">log in</a> to rate this hotel.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
