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

// Fetch historical tourist sites from the database
$sql = "SELECT id, title, description, location, img, latitude, longitude 
        FROM histo";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Historical Tourist Sites - CandonXplore</title>
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

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px; /* Reduced gap for a tighter layout */
            margin-top: 30px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item .btn-view-more {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 123, 255, 0.8);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .gallery-item .btn-view-more:hover {
            background: rgba(0, 123, 255, 1);
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
        <h1 class="display-4 fw-bold">Historical Tourist Sites</h1>
        <p class="lead text-muted">Discover the rich history of Candon City through its iconic landmarks and historical sites. Explore the stories that shaped the city's vibrant culture.</p>
    </div>
</section>

<!-- Gallery Section -->
<section class="container">
    <div class="gallery">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageSrc = (!empty($row['img'])) 
                    ? "data:image/jpeg;base64," . base64_encode($row['img'])
                    : "/project-study/uploads/default-historical-site.jpg"; // Default image
                ?>
                <div class="gallery-item">
                    <img src="<?php echo $imageSrc; ?>" alt="Historical Site Image">
                    <a href="/project-study/attractions/view/histview.php?id=<?php echo $row['id']; ?>" class="btn-view-more">View More</a>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No historical sites found.</p>";
        }
        ?>
    </div>
</section>

<?php renderFooter(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
