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

// Fetch hotels from the database
$sql = "SELECT hotels.*, IFNULL(AVG(hotel_ratings.rating), 0) AS avg_rating, COUNT(hotel_ratings.rating) AS rating_count 
        FROM hotels 
        LEFT JOIN hotel_ratings ON hotels.id = hotel_ratings.hotel_id 
        GROUP BY hotels.id 
        ORDER BY RAND() LIMIT 3"; // Fetch 3 random hotels with average ratings and rating count
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hotels - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->

    <style>
        /* Add your styles here */
        /* Modern button styles */
        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            border-radius: 50px;
            font-weight: bold;
        }

        .btn-modern-primary {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            color: white;
            border: none;
        }

        .btn-modern-primary:hover {
            background: linear-gradient(45deg, #0056b3, #0099cc);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
            transform: translateY(-2px);
        }

        .btn-modern-warning {
            background: linear-gradient(45deg, #ffc107, #ff8c00);
            color: white;
            border: none;
        }

        .btn-modern-warning:hover {
            background: linear-gradient(45deg, #e0a800, #cc7000);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.5);
            transform: translateY(-2px);
        }

        .btn-modern-secondary {
            background: linear-gradient(45deg, #6c757d, #343a40);
            color: white;
            border: none;
        }

        .btn-modern-secondary:hover {
            background: linear-gradient(45deg, #5a6268, #23272b);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.5);
            transform: translateY(-2px);
        }

        .btn-modern i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include '../includes/nav_footer.php'; ?>
    <?php renderNav(); ?>

    <!-- Hero Section -->
    <div class="hero" style="background-image: url('/project-study/uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Hotels</h1>
            <p>Find the best hotels in Candon City.</p>
        </div>
    </div>

    <!-- Where to Stay Section (Top) -->
    <div class="container-fluid mt-4">
        <div class="where-to-stay text-center py-5" style="background: linear-gradient(to right, #007bff, #00d4ff); border-radius: 10px; color: white;">
            <h2 class="fw-bold">Affordable Stays in Candon City</h2>
            <p>Explore budget-friendly hotels and enjoy your stay without breaking the bank.</p>
        </div>
    </div>

    <!-- Recommendations (High Avg Rate and Must Try Low Rate) -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- High Average Rating Section -->
            <div class="col-md-6">
                <div class="recommendation-section">
                    <h4 class="text-center">Highly Rated Hotels</h4>
                    <div id="highAvgRateCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $highRateQuery = "SELECT hotels.*, IFNULL(AVG(hotel_ratings.rating), 0) AS avg_rating, COUNT(hotel_ratings.rating) AS rating_count 
                                              FROM hotels 
                                              LEFT JOIN hotel_ratings ON hotels.id = hotel_ratings.hotel_id 
                                              GROUP BY hotels.id 
                                              ORDER BY avg_rating DESC LIMIT 3"; // Top 3 highly rated hotels with rating count
                            $highRateResult = $conn->query($highRateQuery);

                            if ($highRateResult->num_rows > 0) {
                                $active = true;
                                while ($highRow = $highRateResult->fetch_assoc()) {
                                    $highImageSrc = (!empty($highRow['img'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($highRow['img'])
                                        : "/project-study/uploads/default-hotel.jpg"; // Default image
                                    ?>
                                    <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                        <div class="recommendation-card text-center mx-auto" style="max-width: 600px;">
                                            <img src="<?php echo $highImageSrc; ?>" class="img-fluid rounded" alt="Highly Rated Hotel Image" style="width: 100%; height: 300px; object-fit: cover;">
                                            <h6 class="mt-3"><?php echo htmlspecialchars($highRow['title']); ?></h6>
                                            <p><?php echo htmlspecialchars($highRow['location']); ?></p>
                                            <p><i class="fas fa-star" style="color: #ffc107;"></i> Average Rating: <?php echo number_format($highRow['avg_rating'], 1); ?> / 5</p>
                                            <p><?php echo $highRow['rating_count']; ?> user(s) rated this hotel</p>
                                            <a href="/project-study/home/view_more_hotels.php?id=<?php echo $highRow['id']; ?>" 
                                               class="btn btn-modern btn-modern-primary btn-sm mt-2">
                                                <i class="fa-solid fa-eye"></i> View More
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $active = false;
                                }
                            } else {
                                echo "<p class='text-center'>No highly rated hotels available.</p>";
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#highAvgRateCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#highAvgRateCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Must Try Low Rate Section -->
            <div class="col-md-6">
                <div class="recommendation-section">
                    <h4 class="text-center">Must Try Budget Hotels</h4>
                    <div id="lowRateCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $lowRateQuery = "SELECT hotels.*, IFNULL(AVG(hotel_ratings.rating), 0) AS avg_rating, COUNT(hotel_ratings.rating) AS rating_count 
                                             FROM hotels 
                                             LEFT JOIN hotel_ratings ON hotels.id = hotel_ratings.hotel_id 
                                             GROUP BY hotels.id 
                                             ORDER BY avg_rating ASC LIMIT 3"; // Top 3 low-rated hotels with rating count
                            $lowRateResult = $conn->query($lowRateQuery);

                            if ($lowRateResult->num_rows > 0) {
                                $active = true;
                                while ($lowRow = $lowRateResult->fetch_assoc()) {
                                    $lowImageSrc = (!empty($lowRow['img'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($lowRow['img'])
                                        : "/project-study/uploads/default-hotel.jpg"; // Default image
                                    ?>
                                    <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                        <div class="recommendation-card text-center mx-auto" style="max-width: 600px;">
                                            <img src="<?php echo $lowImageSrc; ?>" class="img-fluid rounded" alt="Budget Hotel Image" style="width: 100%; height: 300px; object-fit: cover;">
                                            <h6 class="mt-3"><?php echo htmlspecialchars($lowRow['title']); ?></h6>
                                            <p><?php echo htmlspecialchars($lowRow['location']); ?></p>
                                            <p><i class="fas fa-star" style="color: #ffc107;"></i> Average Rating: <?php echo number_format($lowRow['avg_rating'], 1); ?> / 5</p>
                                            <p><?php echo $lowRow['rating_count']; ?> user(s) rated this hotel</p>
                                            <a href="/project-study/home/view_more_hotels.php?id=<?php echo $lowRow['id']; ?>" 
                                               class="btn btn-modern btn-modern-primary btn-sm mt-2">
                                                <i class="fa-solid fa-eye"></i> View More
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $active = false;
                                }
                            } else {
                                echo "<p class='text-center'>No budget hotels available.</p>";
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#lowRateCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#lowRateCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- Where to Stay Section (Bottom) -->
        <div class="container-fluid mt-4">
            <div class="where-to-stay text-center py-5" style="background: linear-gradient(to right, #007bff, #00d4ff); border-radius: 10px; color: white;">
                <h2 class="fw-bold">Where to Stay in Candon City</h2>
                <p>Discover the best accommodations and enjoy your stay in the heart of Candon City.</p>
            </div>
        </div>


    <!-- Hotels & Recommendations Section -->
    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <!-- Hotel Listings (Centered, Four per Row) -->
                <div class="col-12">
                    <section class="section">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <?php
                            $hotelQuery = "SELECT hotels.id AS hotel_id, hotels.title, hotels.location, hotels.rooms, hotels.img, 
                                                  hotels.latitude, hotels.longitude, IFNULL(AVG(hotel_ratings.rating), 0) AS avg_rating, 
                                                  COUNT(hotel_ratings.rating) AS rating_count 
                                           FROM hotels 
                                           LEFT JOIN hotel_ratings ON hotels.id = hotel_ratings.hotel_id 
                                           GROUP BY hotels.id"; // Include rating count in hotel listings
                            $hotelResult = $conn->query($hotelQuery);

                            if ($hotelResult->num_rows > 0) {
                                while ($row = $hotelResult->fetch_assoc()) {
                                    $latitude = $row['latitude'] ?? null;
                                    $longitude = $row['longitude'] ?? null;
                                    $imageSrc = (!empty($row['img'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['img'])
                                        : "/project-study/uploads/default-hotel.jpg"; // Default image
                                    ?>
                                    <div class="col">
                                        <div class="card shadow-sm h-100">
                                            <img src="<?php echo $imageSrc; ?>" class="card-img-top rounded-top" alt="Hotel Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-truncate"><?php echo htmlspecialchars($row['title']); ?></h5>
                                                <p class="text-muted mb-2"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($row['location']); ?></p>
                                                <p class="mb-3"><i class="fa-solid fa-bed"></i> Rooms Available: <?php echo $row['rooms']; ?></p>
                                                <p class="mb-3">
                                                    <i class="fas fa-star" style="color: #ffc107;"></i> 
                                                    Overall Rating: <?php echo number_format($row['avg_rating'], 1); ?> / 5
                                                </p>
                                                <p class="mb-3"><?php echo $row['rating_count']; ?> user(s) rated this hotel</p>
                                                <div class="mt-auto">
                                                    <a href="/project-study/home/view_more_hotels.php?id=<?php echo $row['hotel_id']; ?>" 
                                                       class="btn btn-modern btn-modern-secondary btn-sm w-100 mb-2">
                                                        <i class="fa-solid fa-eye"></i> View More
                                                    </a>
                                                    <a href="/project-study/hotel_ratings.php?hotel_id=<?php echo $row['hotel_id']; ?>" 
                                                       class="btn btn-modern btn-modern-warning btn-sm w-100 mb-2">
                                                        <i class="fa-solid fa-star"></i> Rate
                                                    </a>
                                                    <a href="<?php echo (!empty($row['latitude']) && !empty($row['longitude'])) 
                                                        ? "https://www.google.com/maps/dir/?api=1&destination={$row['latitude']},{$row['longitude']}" 
                                                        : '#'; ?>" 
                                                        target="_blank" 
                                                        class="btn btn-modern btn-modern-primary btn-sm w-100" 
                                                        <?php if (empty($row['latitude']) || empty($row['longitude'])) echo 'disabled'; ?>>
                                                        <i class="fas fa-compass"></i> Get Directions
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p class='text-center'>No hotels found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php renderFooter(); ?>

    <script src="hotels.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function getDirections(destinationLat, destinationLng) {
        if (!destinationLat || !destinationLng) {
            alert("Destination coordinates are missing or invalid.");
            console.error("Invalid destination coordinates:", destinationLat, destinationLng);
            return;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    console.log("User's location:", userLat, userLng);
                    const directionsUrl = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${destinationLat},${destinationLng}`;
                    window.open(directionsUrl, "_blank");
                },
                (error) => {
                    alert("Unable to retrieve your location. Please enable location services.");
                    console.error("Geolocation error:", error);
                }
            );
        } else {
            alert("Geolocation is not supported by your browser.");
            console.error("Geolocation not supported.");
        }
    }
    </script>
</body>
</html>

<?php
$conn->close();
?>
