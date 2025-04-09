<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch filtered data only if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $category = $_GET['category'];

    $validCategories = [
        'ancestral_house', 'events', 'experience', 'histo', 'hotels',
        'livelihood', 'natural_tourist_sites', 'recreational_facilities', 'resto'
    ];

    // Define the columns to display for each category
    $categoryColumns = [
        'ancestral_house' => ['title', 'description', 'location', 'img', 'latitude', 'longitude'],
        'events' => ['title', 'description', 'event_date', 'location', 'img', 'latitude', 'longitude'],
        'experience' => ['title', 'description', 'location', 'img', 'latitude', 'longitude'],
        'histo' => ['title', 'description', 'location', 'img', 'latitude', 'longitude'],
        'hotels' => ['title', 'description', 'location', 'contact_number', 'email', 'rooms', 'type', 'nearby_places', 'amenities_facilities', 'img', 'latitude', 'longitude'],
        'livelihood' => ['title', 'description', 'location', 'img', 'latitude', 'longitude'],
        'natural_tourist_sites' => ['title', 'description', 'location', 'img', 'latitude', 'longitude'],
        'recreational_facilities' => ['title', 'description', 'location', 'img', 'latitude', 'longitude'],
        'resto' => ['title', 'type_of_resto', 'location', 'contacts', 'services', 'best_seller_images', 'resto_image', 'description', 'latitude', 'longitude']
    ];

    // Validate the category and get its columns
    if (!in_array($category, $validCategories)) {
        die("Invalid category selected.");
    }
    $columns = $categoryColumns[$category];

    // Build the SQL query to filter by title but select all columns
    $sql = "SELECT * FROM $category WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$filter%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Data</title>
    <style>
        /* Style for the filter panel */
        #filterPanel {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -20%);
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #filterOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
    <script>
        // JavaScript to toggle the filter panel
        function toggleFilterPanel() {
            const panel = document.getElementById('filterPanel');
            const overlay = document.getElementById('filterOverlay');
            const isVisible = panel.style.display === 'block';
            panel.style.display = isVisible ? 'none' : 'block';
            overlay.style.display = isVisible ? 'none' : 'block';
        }
    </script>
</head>
<body>
    <button onclick="toggleFilterPanel()">Filter</button>

    <!-- Overlay for the filter panel -->
    <div id="filterOverlay" onclick="toggleFilterPanel()"></div>

    <!-- Filter panel -->
    <div id="filterPanel">
        <h3>Filter Options</h3>
        <form method="GET" action="filtered-data.php">
            <label for="category">Select Category:</label>
            <select name="category" id="category">
                <option value="ancestral_house">Ancestral House</option>
                <option value="events">Events</option>
                <option value="experience">Experience</option>
                <option value="histo">Histo</option>
                <option value="hotels">Hotels</option>
                <option value="livelihood">Livelihood</option>
                <option value="natural_tourist_sites">Natural Tourist Sites</option>
                <option value="recreational_facilities">Recreational Facilities</option>
                <option value="resto">Resto</option>
            </select>

            <h4>Additional Filters</h4>
            <label><input type="checkbox" name="filterOptions[]" value="title"> Title</label><br>
            <label><input type="checkbox" name="filterOptions[]" value="description"> Description</label><br>
            <label><input type="checkbox" name="filterOptions[]" value="location"> Location</label><br>
            <label><input type="checkbox" name="filterOptions[]" value="img"> Image</label><br>

            <button type="submit">Apply Filters</button>
            <button type="button" onclick="toggleFilterPanel()">Close</button>
        </form>
    </div>

    <hr>

<?php
// Display filtered data only if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    echo "<h1>Filtered Data for " . ucfirst(str_replace('_', ' ', $category)) . "</h1>";
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        foreach ($row as $column => $value) {
            echo "<p><strong>" . ucfirst(str_replace('_', ' ', $column)) . ":</strong> " . htmlspecialchars($value) . "</p>";
        }
        echo "</div><hr>";
    }

    // Collaborative filtering logic (simple example)
    echo "<h2>Recommended for You</h2>";
    $userId = 1; // Example user ID
    $recommendationSql = "
        SELECT item_id, COUNT(*) as score 
        FROM user_item_interactions 
        WHERE user_id != ? 
        GROUP BY item_id 
        ORDER BY score DESC 
        LIMIT 5";
    $recommendStmt = $conn->prepare($recommendationSql);
    $recommendStmt->bind_param("i", $userId);
    $recommendStmt->execute();
    $recommendResult = $recommendStmt->get_result();

    // Display recommendations
    while ($recommendation = $recommendResult->fetch_assoc()) {
        echo "<p>Recommended Item ID: " . $recommendation['item_id'] . "</p>";
    }
}

$conn->close();
?>
</body>
</html>
