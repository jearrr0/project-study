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
    <div class="hero" style="background-image: url('../uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Candon City: The Tobacco Capital of the Philippines</h1>
            <p>Where History, Culture, and Progress Meet!</p>
        </div>
    </div>
    <main>
        <section class="section">
            <h2>where to visit</h2>
            <div class="slideshow-container">
                <div class="slides fade">
                    <img src="../uploads/home/1 (1).jpg" alt="Experience">
                    <div class="info-panel">
                        <p>Experience the beauty and culture of Candon City.</p>
                        <a href="experience.html">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/home/1 (2).jpg" alt="Historical Tourist Sites">
                    <div class="info-panel">
                        <p>Discover the historical tourist sites of Candon City.</p>
                        <a href="historical-tourist-sites.html">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/home/1 (3).jpg" alt="Historical Landsites">
                    <div class="info-panel">
                        <p>Explore the historical landsites of Candon City.</p>
                        <a href="historical-landsites.html">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/home/1 (4).jpg" alt="Livelihoods">
                    <div class="info-panel">
                        <p>Learn about the livelihoods of the people in Candon City.</p>
                        <a href="livelihoods.html">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/home/1 (5).jpg" alt="Ancestral Houses">
                    <div class="info-panel">
                        <p>Visit the ancestral houses in Candon City.</p>
                        <a href="ancestral-houses.html">View More</a>
                    </div>
                </div>
                <div class="slides fade">
                    <img src="../uploads/home/1 (6).jpg" alt="New Attraction">
                    <div class="info-panel">
                        <p>Discover new attractions in Candon City.</p>
                        <a href="new-attraction.html">View More</a>
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
         <h2>Where to Stay</h2>
             <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-inner">
            <?php
            // Use the existing database connection defined at the top of the file

            $sql = "SELECT * FROM hotels";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    
                    // Convert BLOB image to Base64
                    if (!empty($row["img"])) {
                        $imageData = base64_encode($row["img"]);
                        $imageSrc = "data:image/jpeg;base64," . $imageData;
                    } else {
                        $imageSrc = "https://via.placeholder.com/300x200?text=No+Image";
                    }
                    
                    echo '<div class="carousel-item ' . ($i === 1 ? 'active' : '') . '">';
                    echo '    <div class="card">';
                    echo '        <img src="' . $imageSrc . '" alt="Hotel ' . $i . '">';
                    echo '        <div class="card-content">';
                    echo '            <h3>' . htmlspecialchars($row["title"]) . '</h3>';
                    echo '            <p>' . htmlspecialchars($row["description"]) . '</p>';
                    echo '            <a href="../hotels/hotels.php">More Details</a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hotels found.</p>';
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
            <h2>Where to Eat</h2>
            <div id="restaurantCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $sql = "SELECT * FROM resto";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            
                            // Convert BLOB image to Base64
                            if (!empty($row["img"])) {
                                $imageData = base64_encode($row["img"]);
                                $imageSrc = "data:image/jpeg;base64," . $imageData;
                            } else {
                                $imageSrc = "https://via.placeholder.com/300x200?text=No+Image";
                            }
                            
                            echo '<div class="carousel-item ' . ($i === 1 ? 'active' : '') . '">';
                            echo '    <div class="card">';
                            echo '        <img src="' . $imageSrc . '" alt="Restaurant ' . $i . '">';
                            echo '        <div class="card-content">';
                            echo '            <h3>' . htmlspecialchars($row["title"]) . '</h3>';
                            echo '            <p>' . htmlspecialchars($row["description"]) . '</p>';
                            echo '            <a href="#">More Details</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No restaurants found.</p>';
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
                <h2>Where to Attend Events</h2>
                <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $sql = "SELECT * FROM events";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                
                                // Convert BLOB image to Base64
                                if (!empty($row["img"])) {
                                    $imageData = base64_encode($row["img"]);
                                    $imageSrc = "data:image/jpeg;base64," . $imageData;
                                } else {
                                    $imageSrc = "https://via.placeholder.com/300x200?text=No+Image";
                                }
                                
                                echo '<div class="carousel-item ' . ($i === 1 ? 'active' : '') . '">';
                                echo '    <div class="card">';
                                echo '        <img src="' . $imageSrc . '" alt="Event ' . $i . '">';
                                echo '        <div class="card-content">';
                                echo '            <h3>' . htmlspecialchars($row["title"]) . '</h3>';
                                echo '            <p>' . htmlspecialchars($row["description"]) . '</p>';
                                echo '            <a href="#">More Details</a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No events found.</p>';
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
        <section class="contact">
            <h2>Contact Us</h2>
            <div class="social-links">
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.twitter.com" target="_blank">Twitter</a>
                <a href="https://www.linkedin.com" target="_blank">LinkedIn</a>
                <a href="https://www.pinterest.com" target="_blank">Pinterest</a>
            </div>
            
        </section>
    </main>
    <?php renderFooter(); ?>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
