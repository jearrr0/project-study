<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if database exists
$db_selected = mysqli_select_db($conn, $dbname);
if (!$db_selected) {
    die("Database selection failed: " . mysqli_error($conn));
}

include '../includes/nav_footer.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php renderNav(); ?>
    <div class="hero" style="background-image: url('../uploads/home/image-2-1024x724.jpg'); position: relative; height: 100vh; background-size: cover; background-position: center;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
        <div class="hero-content" style="position: relative; z-index: 1; text-align: center; color: #fff; padding: 20px; animation: fadeIn 2s ease-in-out;">
            <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);">Candon City: The Tobacco Capital of the Philippines</h1>
            <p style="font-size: 1.5rem; margin-top: 10px; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);">Where History, Culture, and Progress Meet!</p>
            <a href="#main" style="margin-top: 20px; display: inline-block; padding: 10px 20px; font-size: 1.2rem; color: #fff; background: #007bff; border-radius: 5px; text-decoration: none; transition: background 0.3s;">Explore Now</a>
        </div>
    </div>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .hero-content a:hover {
            background: #0056b3;
        }
    </style>
    <main>
       
        <section class="section">
            <h2 class="text-center my-4">Where to Visit</h2>
            <div class="slideshow-container">
                <div class="slides fade">
                    <img src="../uploads/liveli/a.png" alt="Experience">
                    <div class="info-panel">
                        <p>Experience the beauty and culture of Candon City.</p>
                        <a href="../attractions/pages/experienceprogram.php">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/candon pic/2/Screenshot 2025-03-28 094930.png" alt="Historical Tourist Sites">
                    <div class="info-panel">
                        <p>Discover the historical tourist sites of Candon City.</p>
                        <a href="../attractions\pages\historical-tourist-sites.php">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/bg.png" alt="Historical Landsites">
                    <div class="info-panel">
                        <p>Explore the Natural Tourist sites of Candon City.</p>
                        <a href="../attractions\pages\natural_tourist_sites.php">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/liveli/a.png" alt="Livelihoods">
                    <div class="info-panel">
                        <p>Learn about the livelihoods of the people in Candon City.</p>
                        <a href="../attractions\pages\livelihoods.php">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/candon pic/ansstral 1/3.PNG" alt="Ancestral Houses">
                    <div class="info-panel">
                        <p>Visit the ancestral houses in Candon City.</p>
                        <a href="../attractions\pages\ancestral_houses.php">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/candon pic/2/Screenshot 2025-03-28 100007.png" alt="New Attraction">
                    <div class="info-panel">
                        <p>Discover the recreational sites and activities in Candon City.</p>
                        <a href="../attractions\pages\recreational-facilities.php">View More</a>
                    </div>
                </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
                <span class="dot" onclick="currentSlide(4)"></span> 
                <span class="dot" onclick="currentSlide(5)"></span> 
                <span class="dot" onclick="currentSlide(6)"></span> 
            </div>
        </section>
        
        <section class="section">
            <h2 style="text-align: center; margin-top: 20px; font-size: 2rem; font-weight: bold;">Where to Stay in Candon City</h2>
            <p style="text-align: center; margin: 10px 0; font-size: 1.2rem; color: #555;">Discover the best accommodations in Candon City, from luxurious hotels to cozy inns, offering comfort and convenience for your stay.</p>
            <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel" style="position: relative;">
                <div class="carousel-inner">
                    <?php
                    $sql = "SELECT * FROM hotels";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            $imageSrc = !empty($row["img"]) ? "data:image/png;base64," . base64_encode($row["img"]) : "https://via.placeholder.com/300x200?text=No+Image";
                            echo '<div class="carousel-item ' . ($i === 1 ? 'active' : '') . '">';
                            echo '    <div class="card" style="border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">';
                            echo '        <img src="' . $imageSrc . '" class="d-block w-100" alt="Hotel ' . $i . '" style="border-radius: 10px;">';
                            echo '        <div class="card-body text-center">';
                            echo '            <h3 class="card-title">' . htmlspecialchars($row["title"]) . '</h3>';
                            echo '            <p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                            echo '            <a href="../hotels/hotels.php" class="btn btn-primary">More Details</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">No hotels found.</p>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <section class="section">
            <h2 style="text-align: center; margin-top: 20px; font-size: 2rem; font-weight: bold;">Where to Dine in Candon City</h2>
            <p style="text-align: center; margin: 10px 0; font-size: 1.2rem; color: #555;">Explore the finest dining options in Candon City, offering a variety of cuisines to satisfy your cravings.</p>
            <div id="restaurantCarousel" class="carousel slide" data-bs-ride="carousel" style="position: relative;">
                <div class="carousel-inner">
                    <?php
                    $sql = "SELECT * FROM resto";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            $imageSrc = !empty($row["img"]) ? "data:image/jpeg;base64," . base64_encode($row["img"]) : "https://via.placeholder.com/300x200?text=No+Image";
                            echo '<div class="carousel-item ' . ($i === 1 ? 'active' : '') . '">';
                            echo '    <div class="card" style="border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">';
                            echo '        <img src="' . $imageSrc . '" class="d-block w-100" alt="Restaurant ' . $i . '" style="border-radius: 10px;">';
                            echo '        <div class="card-body text-center">';
                            echo '            <h3 class="card-title">' . htmlspecialchars($row["title"]) . '</h3>';
                            echo '            <p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                            echo '            <a href="#" class="btn btn-primary">More Details</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">No restaurants found.</p>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#restaurantCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#restaurantCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <section class="section">
            <h2 style="text-align: center; margin-top: 20px; font-size: 2rem; font-weight: bold;">Events to Attend in Candon City</h2>
            <p style="text-align: center; margin: 10px 0; font-size: 1.2rem; color: #555;">Join the vibrant events and festivals that celebrate the culture and traditions of Candon City.</p>
            <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel" style="position: relative;">
                <div class="carousel-inner">
                    <?php
                    $sql = "SELECT * FROM events";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            $imageSrc = !empty($row["img"]) ? "data:image/jpeg;base64," . base64_encode($row["img"]) : "https://via.placeholder.com/300x200?text=No+Image";
                            echo '<div class="carousel-item ' . ($i === 1 ? 'active' : '') . '">';
                            echo '    <div class="card" style="border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">';
                            echo '        <img src="' . $imageSrc . '" class="d-block w-100" alt="Event ' . $i . '" style="border-radius: 10px;">';
                            echo '        <div class="card-body text-center">';
                            echo '            <h3 class="card-title">' . htmlspecialchars($row["title"]) . '</h3>';
                            echo '            <p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                            echo '            <a href="#" class="btn btn-primary">More Details</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">No events found.</p>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        
    </main>
    <?php renderFooter(); ?>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
