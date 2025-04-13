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

// Fetch recommended restaurants
$sql = "SELECT resto.*, IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
        FROM resto 
        LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
        GROUP BY resto.id 
        ORDER BY RAND() LIMIT 3";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Add your styles here */
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
            <h1>Restaurants</h1>
            <p>Find the best restaurants in Candon City.</p>
        </div>
    </div>
<!-- Highlight Section -->
<div class="highlight-section text-center py-5" style="background: linear-gradient(45deg, #007bff, #00d4ff); color: white; border-radius: 10px; margin: 20px;">
    <h2>Affordable Dining in Candon City</h2>
    <p>Discover top-rated restaurants offering delicious meals at budget-friendly prices. Savor the taste of Candon City without overspending.</p>
</div>

    <!-- Recommendations Section -->
    <div class="container-fluid mt-4">
        <div class="recommendation-section">
            <h4 class="text-center">Recommended Restaurants</h4>
            <div class="row">
                <!-- Highest Rated -->
                <div class="col-md-4">
                    <h5 class="text-center">Highest Rated</h5>
                    <div id="highestRatedCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $highestRatedQuery = "SELECT resto.*, IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
                                                  FROM resto 
                                                  LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
                                                  GROUP BY resto.id 
                                                  ORDER BY avg_rating DESC 
                                                  LIMIT 10";
                            $highestRatedResult = $conn->query($highestRatedQuery);
                            $activeClass = "active";

                            if ($highestRatedResult->num_rows > 0) {
                                while ($row = $highestRatedResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['resto_image'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['resto_image'])
                                        : "/project-study/uploads/default-restaurant.jpg";
                                    ?>
                                    <div class="carousel-item <?php echo $activeClass; ?>">
                                        <div class="recommendation-card text-center mb-3">
                                            <img src="<?php echo $imageSrc; ?>" class="img-fluid rounded" alt="Restaurant Image" style="max-height: 150px; object-fit: cover;">
                                            <h6 class="mt-2"><?php echo htmlspecialchars($row['title']); ?></h6>
                                            <p><i class="fas fa-star" style="color: #ffc107;"></i> Rating: <?php echo number_format($row['avg_rating'], 1); ?> / 5</p>
                                        </div>
                                    </div>
                                    <?php
                                    $activeClass = ""; // Remove active class after the first item
                                }
                            } else {
                                echo "<p class='text-center'>No highest rated restaurants found.</p>";
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#highestRatedCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#highestRatedCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Highest User Rated -->
                <div class="col-md-4">
                    <h5 class="text-center">Highest User Rated</h5>
                    <div id="highestUserRatedCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $highestUserRatedQuery = "SELECT resto.*, COUNT(resto_ratings.rating) AS user_ratings_count, IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
                                                      FROM resto 
                                                      LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
                                                      GROUP BY resto.id 
                                                      ORDER BY user_ratings_count DESC 
                                                      LIMIT 10";
                            $highestUserRatedResult = $conn->query($highestUserRatedQuery);
                            $activeClass = "active";

                            if ($highestUserRatedResult->num_rows > 0) {
                                while ($row = $highestUserRatedResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['resto_image'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['resto_image'])
                                        : "/project-study/uploads/default-restaurant.jpg";
                                    ?>
                                    <div class="carousel-item <?php echo $activeClass; ?>">
                                        <div class="recommendation-card text-center mb-3">
                                            <img src="<?php echo $imageSrc; ?>" class="img-fluid rounded" alt="Restaurant Image" style="max-height: 150px; object-fit: cover;">
                                            <h6 class="mt-2"><?php echo htmlspecialchars($row['title']); ?></h6>
                                            <p><i class="fas fa-users"></i> User Ratings: <?php echo $row['user_ratings_count']; ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    $activeClass = ""; // Remove active class after the first item
                                }
                            } else {
                                echo "<p class='text-center'>No highest user rated restaurants found.</p>";
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#highestUserRatedCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#highestUserRatedCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Must Try (Low Rated) -->
                <div class="col-md-4">
                    <h5 class="text-center">Must Try</h5>
                    <div id="mustTryCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $mustTryQuery = "SELECT resto.*, IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
                                             FROM resto 
                                             LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
                                             GROUP BY resto.id 
                                             ORDER BY avg_rating ASC 
                                             LIMIT 10";
                            $mustTryResult = $conn->query($mustTryQuery);
                            $activeClass = "active";

                            if ($mustTryResult->num_rows > 0) {
                                while ($row = $mustTryResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['resto_image'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['resto_image'])
                                        : "/project-study/uploads/default-restaurant.jpg";
                                    ?>
                                    <div class="carousel-item <?php echo $activeClass; ?>">
                                        <div class="recommendation-card text-center mb-3">
                                            <img src="<?php echo $imageSrc; ?>" class="img-fluid rounded" alt="Restaurant Image" style="max-height: 150px; object-fit: cover;">
                                            <h6 class="mt-2"><?php echo htmlspecialchars($row['title']); ?></h6>
                                            <p><i class="fas fa-star" style="color: #ffc107;"></i> Rating: <?php echo number_format($row['avg_rating'], 1); ?> / 5</p>
                                        </div>
                                    </div>
                                    <?php
                                    $activeClass = ""; // Remove active class after the first item
                                }
                            } else {
                                echo "<p class='text-center'>No must-try restaurants found.</p>";
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#mustTryCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mustTryCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">

        </div>
    </div>

    <!-- About Section -->
    <div class="about-section text-center py-5" style="background: linear-gradient(45deg, #00d4ff, #007bff); color: white; border-radius: 10px; margin: 20px;">
        <h2>About Our Restaurants</h2>
        <p>Explore a variety of dining options in Candon City, from local delicacies to international cuisines. Our restaurants are committed to providing exceptional service and unforgettable dining experiences.</p>
    </div>
    <!-- Restaurants Section -->
    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    <section class="section">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <?php
                            $restaurantQuery = "SELECT resto.*, IFNULL(AVG(resto_ratings.rating), 0) AS avg_rating 
                                                FROM resto 
                                                LEFT JOIN resto_ratings ON resto.id = resto_ratings.resto_id 
                                                GROUP BY resto.id";
                            $restaurantResult = $conn->query($restaurantQuery);

                            if ($restaurantResult->num_rows > 0) {
                                while ($row = $restaurantResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['resto_image'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['resto_image'])
                                        : "/project-study/uploads/default-restaurant.jpg";
                                    ?>
                                    <div class="col">
                                        <div class="card shadow-sm h-100">
                                            <img src="<?php echo $imageSrc; ?>" class="card-img-top rounded-top" alt="Restaurant Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-truncate"><?php echo htmlspecialchars($row['title']); ?></h5>
                                                <p class="text-muted mb-2"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($row['location']); ?></p>
                                                <p class="mb-3"><i class="fa-solid fa-info-circle"></i> <?php echo htmlspecialchars($row['description']); ?></p>
                                                <p class="mb-3">
                                                    <i class="fas fa-star" style="color: #ffc107;"></i> 
                                                    Overall Rating: <?php echo number_format($row['avg_rating'], 1); ?> / 5
                                                </p>
                                                <div class="mt-auto">
                                                    <a href="/project-study/home/view_more_resto.php?id=<?php echo $row['id']; ?>" 
                                                       class="btn btn-modern btn-modern-secondary btn-sm w-100 mb-2">
                                                        <i class="fa-solid fa-eye"></i> View More
                                                    </a>
                                                    <a href="/project-study/rate.php?resto_id=<?php echo $row['id']; ?>" 
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
                                echo "<p class='text-center'>No restaurants found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php renderFooter(); ?>

    <script src="restaurants.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
