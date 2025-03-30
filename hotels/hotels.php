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
$sql = "SELECT * FROM hotels ORDER BY RAND() LIMIT 3"; // Fetch 3 random hotels for recommendations
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
</style>

    
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

    <!-- Hero Section -->
    <div class="hero" style="background-image: url('/project-study/uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Hotels</h1>
            <p>Find the best hotels in Candon City.</p>
        </div>
    </div>

    <!-- Hotels & Recommendations Section -->
    <main>
        <div class="container mt-4">
            <div class="row">
                <!-- Hotel Listings (75% on desktop, 100% on mobile) -->
                <div class="col-12 col-md-9">
                    <section class="section">
                        <div class="row">
                            <?php
                            $hotelQuery = "SELECT * FROM hotels"; 
                            $hotelResult = $conn->query($hotelQuery);

                            if ($hotelResult->num_rows > 0) {
                                while ($row = $hotelResult->fetch_assoc()) {
                                    // Ensure image is properly encoded
                                    $imageSrc = (!empty($row['img'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['img'])
                                        : "/project-study/uploads/default-hotel.jpg"; // Default image
                                    ?>
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="Hotel Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="bi bi-building"></i> <?php echo htmlspecialchars($row['title']); ?></h5>
                                                <p class="card-text"><i class="bi bi-info-circle"></i> <?php echo htmlspecialchars($row['description']); ?></p>
                                                <p><i class="bi bi-geo-alt"></i> <strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                                                <p><i class="bi bi-telephone"></i> <strong>Contact:</strong> <?php echo htmlspecialchars($row['contact_number']); ?> | <i class="bi bi-envelope"></i> <?php echo htmlspecialchars($row['email']); ?></p>
                                                <p><i class="bi bi-door-open"></i> <strong>Rooms Available:</strong> <?php echo $row['rooms']; ?></p>
                                                <p><i class="bi bi-tags"></i> <strong>Type:</strong> <?php echo htmlspecialchars($row['type']); ?></p>
                                                <p><i class="bi bi-map"></i> <strong>Nearby Places:</strong> <?php echo htmlspecialchars($row['nearby_places']); ?></p>
                                                <p><i class="bi bi-tools"></i> <strong>Amenities/Facilities:</strong> <?php echo htmlspecialchars($row['amenities_facilities']); ?></p>
                                                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>" target="_blank" class="btn btn-primary"><i class="bi bi-compass"></i> Get Directions</a>
                                                <button class="btn btn-secondary view-more-btn" data-hotel-id="<?php echo $row['id']; ?>"><i class="bi bi-eye"></i> View More</button>
                                                <button class="btn btn-warning rate-btn" data-hotel-id="<?php echo $row['id']; ?>"><i class="bi bi-star"></i> Rate</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>No hotels found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>

                <!-- Recommendations (25% on desktop, 100% on mobile) -->
                <div class="col-12 col-md-3 mt-4 mt-md-0">
                    <div class="recommendation-section">
                        <h4>Recommended Hotels</h4>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($recRow = $result->fetch_assoc()) {
                                // Ensure image is properly encoded
                                $recImageSrc = (!empty($recRow['img'])) 
                                    ? "data:image/jpeg;base64," . base64_encode($recRow['img'])
                                    : "/project-study/uploads/default-hotel.jpg"; // Default image
                                ?>
                                <div class="recommendation-card">
                                    <img src="<?php echo $recImageSrc; ?>" class="img-fluid" alt="Recommended Hotel Image">
                                    <h6><?php echo htmlspecialchars($recRow['title']); ?></h6>
                                    <p><?php echo htmlspecialchars($recRow['location']); ?></p>
                                    <a href="https://www.google.com/maps?q=<?php echo $recRow['latitude']; ?>,<?php echo $recRow['longitude']; ?>" target="_blank" class="btn btn-sm btn-primary">View</a>
                                </div>
                                <hr>
                                <?php
                            }
                        } else {
                            echo "<p>No recommendations available.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>REPUBLIC OF THE PHILIPPINES</p>
        <p>All content is in the public domain unless otherwise stated.</p>
        <p><a href="#">Privacy Policy</a></p>
        <p>ABOUT GOVPH</p>
        <p>Learn more about the Philippine government, its structure, how government works, and the people behind it.</p>
        <p><a href="#">Official Gazette</a> | <a href="#">Open Data Portal</a> | <a href="#">Send us your feedback</a></p>
    </footer>

    <!-- Scripts -->
    <script src="hotels.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Add functionality for "View More" button
    document.querySelectorAll('.view-more-btn').forEach(button => {
        button.addEventListener('click', function () {
            const hotelId = this.getAttribute('data-hotel-id');
            // Fetch and display all details for the selected hotel
            alert('Displaying more details for hotel ID: ' + hotelId);
            // You can replace this alert with a modal or a new page to show full details
        });
    });

    // Add functionality for "Rate" button
    document.querySelectorAll('.rate-btn').forEach(button => {
        button.addEventListener('click', function () {
            const hotelId = this.getAttribute('data-hotel-id');
            // Handle rating logic here
            alert('Rate button clicked for hotel ID: ' + hotelId);
            // Replace this alert with a modal or form to submit ratings
        });
    });
    </script>
</body>
</html>

<?php
$conn->close();
?>
