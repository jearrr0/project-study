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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Experience - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="experience.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 70px; margin-right: 50px;">
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
                            <a class="nav-link active" aria-current="page" href="../../home/index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Attractions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                                <li><a class="dropdown-item" href="historical-tourist-sites.php">Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="historical-landsites.php">Historical Landsites</a></li>
                                <li><a class="dropdown-item" href="recreational-facilities.php">Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="livelihoods.php">Livelihoods</a></li>
                                <li><a class="dropdown-item" href="ancestral-houses.php">Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="experience.php">Experience</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../hotels">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../resto">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../events">Events</a>
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
    <div class="hero" style="background-image: url('../../uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Experience</h1>
            <p>Experience the beauty and culture of Candon City.</p>
        </div>
    </div>
    <main>
        <section class="section">
            <h2>Experience</h2>
            <div class="content">
            <?php
// Database connection
$host = "localhost";
$username = "root"; // Change if needed
$password = "";
$database = "candonxplore_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all experiences from database
$sql = "SELECT * FROM experience";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="row mb-5">
            <!-- Carousel Section -->
            <div class="col-md-6">
                <div id="carousel-<?php echo $row['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $images = ['img', 'img1', 'img2', 'img3'];
                        $first = true;
                        foreach ($images as $imgField):
                            if (!empty($row[$imgField])): 
                                // Debugging: Check if image data exists
                                // Uncomment the line below to debug
                                // echo '<pre>' . print_r($row[$imgField], true) . '</pre>';
                        ?>
                            <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[$imgField]); ?>" class="d-block w-100" alt="Slide">
                            </div>
                        <?php 
                            $first = false;
                            endif;
                        endforeach; 
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $row['id']; ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $row['id']; ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <div>
                    <a href="<?php echo !empty($row['view_more_link']) ? htmlspecialchars($row['view_more_link']) : '#'; ?>" class="btn btn-primary me-2">View More</a>
                    <a href="<?php echo !empty($row['api_directions']) ? htmlspecialchars($row['api_directions']) : '#'; ?>" class="btn btn-success">Get Directions</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

            </div>
        </section>
    </main>
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
    <script src="experience.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>