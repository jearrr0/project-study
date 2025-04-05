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

// Fetch restaurants from the database
$sql = "SELECT resto.id, resto.title, resto.type_of_resto, resto.location, resto.contacts, resto.services, 
               resto.best_seller_images, resto.resto_image, resto.description, resto.latitude, resto.longitude, 
               IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
        FROM resto 
        LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
        GROUP BY resto.id 
        ORDER BY RAND() LIMIT 3"; // Fetch 3 random restaurants with average ratings for recommendations
$result = $conn->query($sql);

include '../includes/nav_footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants - CandonXplore</title>
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
    .restaurant-contact {
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

    /* Location text */
    .location {
        font-size: 0.9rem;
        color: #007bff;
        font-weight: 600;
    }

    /* Recommended restaurants carousel styling */
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
<?php renderNav(); ?>

    <!-- Hero Section -->
    <div class="hero" style="background-image: url('/project-study/uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Restaurants</h1>
            <p>Find the best restaurants in Candon City.</p>
        </div>
    </div>

    <!-- Recommendations (Carousel) -->
    <div class="container-fluid mt-4">
        <div class="recommendation-section">
            <h4>Recommended Restaurants</h4>
            <div id="recommendedRestaurantsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    if ($result->num_rows > 0) {
                        $active = true;
                        while ($recRow = $result->fetch_assoc()) {
                            $recImageSrc = (!empty($recRow['resto_image'])) 
                                ? "data:image/jpeg;base64," . base64_encode($recRow['resto_image'])
                                : "/project-study/uploads/default-restaurant.jpg"; // Default image
                            ?>
                            <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                <div class="recommendation-card text-center">
                                    <img src="<?php echo $recImageSrc; ?>" class="img-fluid" alt="Recommended Restaurant Image">
                                    <h6><?php echo htmlspecialchars($recRow['title']); ?></h6>
                                    <p><?php echo htmlspecialchars($recRow['location']); ?></p>
                                    <p><i class="fas fa-star" style="color: #ffc107;"></i> Average Rating: <?php echo number_format($recRow['avg_rating'], 1); ?> / 5</p>
                                    <a href="restaurant-details.php?id=<?php echo $recRow['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-map-marker-alt"></i> View</a>
                                    <a href="/project-study/rate.php?resto_id=<?php echo $recRow['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-star"></i> Rate</a>
                                </div>
                            </div>
                            <?php
                            $active = false;
                        }
                    } else {
                        echo "<p>No recommendations available.</p>";
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#recommendedRestaurantsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#recommendedRestaurantsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Restaurants Section -->
    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9">
                    <section class="section">
                        <div class="row justify-content-center">
                            <?php
                            $restaurantQuery = "SELECT resto.id, resto.title, resto.type_of_resto, resto.location, resto.contacts, resto.services, 
                                                       resto.best_seller_images, resto.resto_image, resto.description, resto.latitude, resto.longitude, 
                                                       IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
                                                FROM resto 
                                                LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
                                                GROUP BY resto.id"; // Fetch all restaurants with average ratings
                            $restaurantResult = $conn->query($restaurantQuery);

                            if ($restaurantResult->num_rows > 0) {
                                while ($row = $restaurantResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['resto_image'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['resto_image'])
                                        : "/project-study/uploads/default-restaurant.jpg"; // Default image
                                    ?>
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="Restaurant Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-utensils"></i> <?php echo htmlspecialchars($row['title']); ?></h5>
                                                <p class="card-text"><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($row['description']); ?></p>
                                                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                                                <p><i class="fas fa-phone"></i> <strong>Contacts:</strong> <?php echo htmlspecialchars($row['contacts']); ?></p>
                                                <p><i class="fas fa-concierge-bell"></i> <strong>Services:</strong> <?php echo htmlspecialchars($row['services']); ?></p>
                                                <p><i class="fas fa-star" style="color: #ffc107;"></i> <strong>Average Rating:</strong> <?php echo number_format($row['avg_rating'], 1); ?> / 5</p>
                                                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>" target="_blank" class="btn btn-primary"><i class="fas fa-compass"></i> Get Directions</a>
                                                <a href="/project-study/home/view_more_resto.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary"><i class="fas fa-eye"></i> View More</a>
                                                <a href="/project-study/rate.php?resto_id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fas fa-star"></i> Rate</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>No restaurants found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php renderFooter(); ?>
    <!-- Scripts -->
    <script src="restaurants.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Add functionality for "View More" button
    document.querySelectorAll('.view-more-btn').forEach(button => {
        button.addEventListener('click', function () {
            const restoId = this.getAttribute('data-resto-id');
            // Fetch and display all details for the selected restaurant
            alert('Displaying more details for restaurant ID: ' + restoId);
            // You can replace this alert with a modal or a new page to show full details
        });
    });



    // Handle form submission for rating
    document.getElementById('rateRestaurantForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('submit-rating.php', {
            method: 'POST',
            body: formData
        })
  
    });
    </script>
</body>
</html>

<?php
$conn->close();
?>
