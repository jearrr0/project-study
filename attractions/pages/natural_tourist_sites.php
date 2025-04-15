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

// Fetch recreational facilities from the database
$sql = "SELECT id, title, description, location, img, latitude, longitude 
        FROM natural_tourist_sites";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recreational Facilities - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->

    <style>
 body {
            margin: 2;
            padding: 2;
            box-sizing: border-box;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .container {
            max-width: 1600px; /* Restrict container width */
            margin: 0 auto; /* Center the container */
            padding: 5px; /* Add padding for spacing */
        }

        .card-img-top {
            height: 180px; /* Adjust image height */
            object-fit: cover; /* Ensure image fits within the card */
        }

        .row {
            margin: 0; /* Remove extra spacing */
        }
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

        .btn-modern i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<?php include 'nav_footer.php'; ?>
<?php renderNav(); ?>
<?php renderHero(); ?>
<?php renderChatbot(); ?>

<!-- Title Section -->
<section class="text-center py-5 bg-light">
    <div class="container">
        <h1 class="display-4 fw-bold">Recreational Facilities</h1>
        <p class="lead text-muted">Explore the best recreational facilities in Candon City. Find your next adventure or a place to relax.</p>
    </div>
</section>

<!-- Facilities Section -->
<main>
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imageSrc = (!empty($row['img'])) 
                        ? "data:image/jpeg;base64," . base64_encode($row['img'])
                        : "/project-study/uploads/default-facility.jpg"; // Default image
                    ?>
                    <div class="col">
                        <div class="card shadow-lg border-0 h-100">
                            <img src="<?php echo $imageSrc; ?>" class="card-img-top rounded-top" alt="Facility Image" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate text-primary fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <p class="text-muted mb-2"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($row['location']); ?></p>
                                <p class="mb-3 text-secondary"><?php echo htmlspecialchars($row['description']); ?></p>
                                <div class="mt-auto">
                                    <a href="<?php echo (!empty($row['latitude']) && !empty($row['longitude'])) 
                                        ? "https://www.google.com/maps/dir/?api=1&destination={$row['latitude']},{$row['longitude']}" 
                                        : '#'; ?>" 
                                        target="_blank" 
                                        class="btn btn-modern btn-modern-primary btn-sm w-100 mb-2" 
                                        <?php if (empty($row['latitude']) || empty($row['longitude'])) echo 'disabled'; ?>>
                                        <i class="fas fa-compass"></i> Get Directions
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm w-100">View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>No recreational facilities found.</p>";
            }
            ?>
        </div>
    </div>
</main>

<!-- Description Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold">Why Visit Our Recreational Facilities?</h2>
        <p class="text-center text-muted mt-3">Our facilities offer a perfect blend of relaxation and adventure. Whether you're looking for a serene escape or an exciting activity, we have something for everyone. Come and experience the beauty and fun of Candon City!</p>
    </div>
</section>

<?php renderFooter(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
