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
$sql = "SELECT hotels.*, IFNULL(AVG(hotel_ratings.rating), 0) AS avg_rating 
        FROM hotels 
        LEFT JOIN hotel_ratings ON hotels.id = hotel_ratings.hotel_id 
        GROUP BY hotels.id 
        ORDER BY RAND() LIMIT 3"; // Fetch 3 random hotels with average ratings for recommendations
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

    <!-- Recommendations (Carousel) -->
    <div class="container-fluid mt-4">
        <div class="recommendation-section">
            <h4 class="text-center">Recommended Hotels</h4>
            <div id="recommendedHotelsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    if ($result->num_rows > 0) {
                        $active = true;
                        while ($recRow = $result->fetch_assoc()) {
                            $recImageSrc = (!empty($recRow['img'])) 
                                ? "data:image/jpeg;base64," . base64_encode($recRow['img'])
                                : "/project-study/uploads/default-hotel.jpg"; // Default image
                            ?>
                            <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                <div class="recommendation-card text-center mx-auto" style="max-width: 600px;">
                                    <img src="<?php echo $recImageSrc; ?>" class="img-fluid rounded" alt="Recommended Hotel Image" style="max-height: 300px; object-fit: cover;">
                                    <h6 class="mt-3"><?php echo htmlspecialchars($recRow['title']); ?></h6>
                                    <p><?php echo htmlspecialchars($recRow['location']); ?></p>
                                    <p><i class="fas fa-star" style="color: #ffc107;"></i> Average Rating: <?php echo number_format($recRow['avg_rating'], 1); ?> / 5</p>
                                    <a href="hotel-details.php?id=<?php echo $recRow['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-map-marker-alt"></i> View</a>
                                    <a href="/project-study/rate.php?resto_id=<?php echo $recRow['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-star"></i> Rate</a>
                                </div>
                            </div>
                            <?php
                            $active = false;
                        }
                    } else {
                        echo "<p class='text-center'>No recommendations available.</p>";
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#recommendedHotelsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#recommendedHotelsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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
                            $hotelQuery = "SELECT id, title, location, rooms, img 
                                           FROM hotels"; // Fetch only required fields
                            $hotelResult = $conn->query($hotelQuery);

                            if ($hotelResult->num_rows > 0) {
                                while ($row = $hotelResult->fetch_assoc()) {
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
                                                <div class="mt-auto">
                                                    <a href="/project-study/home/view_more_hotels.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary btn-sm w-100 mb-2">
                                                        <i class="fa-solid fa-eye"></i> View More
                                                    </a>
                                                    <a href="/project-study/hotel_ratings.php?hotel_id=<?php echo $row['id']; ?>" class="btn btn-outline-warning btn-sm w-100 mb-2">
                                                        <i class="fa-solid fa-star"></i> Rate
                                                    </a>
                                                    <a href="<?php 
                                                        if (!empty($row['latitude']) && !empty($row['longitude'])) {
                                                            echo "https://www.google.com/maps/dir/?api=1&destination={$row['latitude']},{$row['longitude']}";
                                                        } else {
                                                            echo "#"; // Fallback if coordinates are missing
                                                        }
                                                    ?>" 
                                                    target="_blank" 
                                                    class="btn btn-outline-primary btn-sm w-100" 
                                                    <?php if (empty($row['latitude']) || empty($row['longitude'])) echo 'disabled'; ?>>
                                                        <i class="fa-solid fa-compass"></i> Get Directions
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
</body>
</html>

<?php
$conn->close();
?>
