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

// Fetch events from the database
$eventQuery = "SELECT id, title, description, event_date, img, latitude, longitude, location FROM events ORDER BY event_date ASC"; // Fetch all events with updated columns
$eventResult = $conn->query($eventQuery);

include '../includes/nav_footer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Events - CandonXplore</title>
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

    /* Recommended events carousel styling */
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

    /* Where to Stay Section Styling */
    .where-to-stay {
        text-align: center;
        margin-top: 30px;
        padding: 20px;
        background: linear-gradient(135deg, #007bff, #00c6ff);
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .where-to-stay:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .where-to-stay h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .where-to-stay p {
        font-size: 1rem;
        margin: 0;
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
    <!-- Navigation Bar -->
    <?php renderNav(); ?>

    <!-- Hero Section -->
    <div class="hero" style="background-image: url('/project-study/uploads/home/image-2-1024x724.jpg');">
        <div class="hero-content">
            <h1>Celebrate Life, Culture, and Tradition</h1>
            <p>Join the Festivities in Candon City! 🎉🎭🎆</p>
        </div>
    </div>

    <!-- Where to Stay Section (Top) -->
    <div class="container-fluid mt-4">
        <div class="where-to-stay">
            <h2>Upcoming Events in Candon City</h2>
            <p>Discover the best events happening in the heart of Candon City.</p>
        </div>
    </div>

    <!-- Events Section -->
    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <!-- Single Column Event Display -->
                <div class="col-12 col-md-9">
                    <section class="section">
                        <div class="row">
                            <?php
                            if ($eventResult->num_rows > 0) {
                                while ($row = $eventResult->fetch_assoc()) {
                                    $imageSrc = (!empty($row['img'])) 
                                        ? "data:image/jpeg;base64," . base64_encode($row['img'])
                                        : "/project-study/uploads/default-event.jpg"; // Default image
                                    $location = !empty($row['location']) ? htmlspecialchars($row['location']) : "Location not specified"; // Fallback for missing location
                                    ?>
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="Event Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($row['title']); ?></h5>
                                                <p class="card-text"><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($row['description']); ?></p>
                                                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <?php echo $location; ?></p>
                                                <p><i class="fas fa-calendar"></i> <strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                                                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>" target="_blank" class="btn btn-primary"><i class="fas fa-compass"></i> Get Directions</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>No events found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php renderFooter(); ?>

    <!-- Scripts -->
    <script src="events.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
