<?php
session_start();
$conn = new mysqli("localhost", "root", "", "candonxplore_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Session Timeout (10 mins)
$timeout_duration = 600;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

// Logout Handler
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../home/index.php");
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user']['uname'];

// Fetch user details
$query = $conn->prepare("SELECT * FROM users WHERE uname=?");
$query->bind_param("s", $user);
$query->execute();
$userData = $query->get_result()->fetch_assoc();

// Fetch restaurant ratings
$ratingsQuery = $conn->prepare("
    SELECT rr.id, r.title, rr.rating 
    FROM resto_ratings rr 
    JOIN resto r ON rr.resto_id = r.id 
    WHERE rr.uname = ?");
$ratingsQuery->bind_param("s", $user);
$ratingsQuery->execute();
$restoRatingsResult = $ratingsQuery->get_result();

// Fetch hotel ratings
$hotelRatingsQuery = $conn->prepare("
    SELECT hr.id, h.title, hr.rating 
    FROM hotel_ratings hr 
    JOIN hotels h ON hr.hotel_id = h.id 
    WHERE hr.uname = ?");
$hotelRatingsQuery->bind_param("s", $user);
$hotelRatingsQuery->execute();
$hotelRatingsResult = $hotelRatingsQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CandonXplore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #007bff, #6610f2);
            color: #333;
        }
        .profile-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .ratings-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }
        .ratings-section {
            flex: 1;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .rating-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        .rating-item:last-child {
            border-bottom: none;
        }
        .star {
            color: gold;
        }
        .edit-rating {
            color: blue;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
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
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger text-black px-3 ms-2" href="profile.php?logout=true" style="border: 2px solid #dc3545; border-radius: 20px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Logout</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</nav>

<!-- Profile Card -->
<div class="container">
    <div class="profile-container">
        <div class="profile-header">
            <h3 class="fw-bold">Welcome, <?= htmlspecialchars($userData['name']) ?>!</h3>
            <hr>
        </div>
        <p><strong>Username:</strong> <?= htmlspecialchars($userData['uname']) ?></p>
        <p><strong>Contact:</strong> <?= htmlspecialchars($userData['contact']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($userData['address']) ?></p>

        <div class="mt-4 text-center">
            <a href="edit_profile.php" class="btn btn-warning text-white">Edit Profile</a>
            <a href="change_password.php" class="btn btn-secondary">Change Password</a>
        </div>

        <!-- User Ratings Section -->
        <div class="ratings-container">
            <!-- Restaurants (Left) -->
            <div class="ratings-section">
                <h5 class="fw-bold">Restaurant Ratings</h5>
                <?php if ($restoRatingsResult->num_rows > 0): ?>
                    <?php while ($rating = $restoRatingsResult->fetch_assoc()): ?>
                        <div class="rating-item">
                            <span><?= htmlspecialchars($rating['title']) ?></span>
                            <span>
                                <?php for ($i = 0; $i < $rating['rating']; $i++): ?>
                                    <span class="star">&#9733;</span>
                                <?php endfor; ?>
                                <a href="edit_rating.php?id=<?= $rating['id'] ?>&type=restaurant" class="edit-rating">✎</a>
                            </span>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted">No restaurant ratings yet.</p>
                <?php endif; ?>
            </div>

            <!-- Hotels (Right) -->
            <div class="ratings-section">
                <h5 class="fw-bold">Hotel Ratings</h5>
                <?php if ($hotelRatingsResult->num_rows > 0): ?>
                    <?php while ($rating = $hotelRatingsResult->fetch_assoc()): ?>
                        <div class="rating-item">
                            <span><?= htmlspecialchars($rating['title']) ?></span>
                            <span>
                                <?php for ($i = 0; $i < $rating['rating']; $i++): ?>
                                    <span class="star">&#9733;</span>
                                <?php endfor; ?>
                                <a href="edit_rating.php?id=<?= $rating['id'] ?>&type=hotel" class="edit-rating">✎</a>
                            </span>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted">No hotel ratings yet.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
