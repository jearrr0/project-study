<?php
// Database connection
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Handle image uploads
    $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
    $img1 = isset($_FILES['img1']) ? addslashes(file_get_contents($_FILES['img1']['tmp_name'])) : NULL;
    $img2 = isset($_FILES['img2']) ? addslashes(file_get_contents($_FILES['img2']['tmp_name'])) : NULL;
    $img3 = isset($_FILES['img3']) ? addslashes(file_get_contents($_FILES['img3']['tmp_name'])) : NULL;

    // Prepare the query based on the selected table
    $query = "";

    switch ($table) {
        case 'ancestral_houses':
            $stmt = $conn->prepare("INSERT INTO ancestral_houses (title, description, img, img1, img2, img3, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $title, $description, $img, $img1, $img2, $img3, $latitude, $longitude);
            break;
        case 'historical_tourist_sites':
            $stmt = $conn->prepare("INSERT INTO historical_tourist_sites (title, description, img, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $title, $description, $img, $latitude, $longitude);
            break;
        case 'livelihood':
            $stmt = $conn->prepare("INSERT INTO livelihood (title, description, img, img1, img2, img3, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $title, $description, $img, $img1, $img2, $img3, $latitude, $longitude);
            break;
        case 'recreational_facilities':
            $stmt = $conn->prepare("INSERT INTO recreational_facilities (title, description, img, img1, img2, img3, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $title, $description, $img, $img1, $img2, $img3, $latitude, $longitude);
            break;
        case 'natural_tourist_sites':
            $stmt = $conn->prepare("INSERT INTO natural_tourist_sites (title, description, img, img1, img2, img3, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $title, $description, $img, $img1, $img2, $img3, $latitude, $longitude);
            break;
        case 'hotels':
            $contact_number = $_POST['contact_number'];
            $email = $_POST['email'];
            $rooms = $_POST['rooms'];
            $type = $_POST['type'];
            $nearby_places = $_POST['nearby_places'];
            $amenities_facilities = $_POST['amenities_facilities'];
            $stmt = $conn->prepare("INSERT INTO hotels (title, description, location, contact_number, email, rooms, type, nearby_places, amenities_facilities, img, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssss", $title, $description, $location, $contact_number, $email, $rooms, $type, $nearby_places, $amenities_facilities, $img, $latitude, $longitude);
            break;
        case 'events':
            $event_date = $_POST['event_date'];
            $location = $_POST['location'];
            $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, img, latitude, longitude, location) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $title, $description, $event_date, $img, $latitude, $longitude, $location);
            break;
        case 'resto':
            $type_of_resto = $_POST['type_of_resto'];
            $location = $_POST['location'];
            $contacts = $_POST['contacts'];
            $services = $_POST['services'];
            $best_seller_images = isset($_FILES['best_seller_images']) ? addslashes(file_get_contents($_FILES['best_seller_images']['tmp_name'])) : NULL;
            $resto_image = isset($_FILES['resto_image']) ? addslashes(file_get_contents($_FILES['resto_image']['tmp_name'])) : NULL;
            $stmt = $conn->prepare("INSERT INTO resto (title, type_of_resto, location, contacts, services, best_seller_images, resto_image, description, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssss", $title, $type_of_resto, $location, $contacts, $services, $best_seller_images, $resto_image, $description, $latitude, $longitude);
            break;
    }

    if ($stmt->execute()) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

    if ($conn->query($query) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tourist Spot Data Entry Form</h2>

    <form method="post" enctype="multipart/form-data">
        <label for="table">Select Table:</label>
        <select name="table" id="table" required>
            <option value="ancestral_houses">Ancestral Houses</option>
            <option value="historical_tourist_sites">Historical Tourist Sites</option>
            <option value="livelihood">Livelihood</option>
            <option value="recreational_facilities">Recreational Facilities</option>
            <option value="natural_tourist_sites">Natural Tourist Sites</option>
            <option value="hotels">Hotels</option>
            <option value="events">Events</option>
            <option value="resto">Restaurants</option>
        </select><br><br>

        <div id="common-fields">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" required><br><br>

            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" required><br><br>

            <label for="img">Image 1:</label>
            <input type="file" id="img" name="img" accept="image/*" required><br><br>

            <label for="img1">Image 2 (Optional):</label>
            <input type="file" id="img1" name="img1" accept="image/*"><br><br>

            <label for="img2">Image 3 (Optional):</label>
            <input type="file" id="img2" name="img2" accept="image/*"><br><br>

            <label for="img3">Image 4 (Optional):</label>
            <input type="file" id="img3" name="img3" accept="image/*"><br><br>
        </div>

        <!-- Fields specific to Hotels -->
        <div id="hotel-fields" style="display:none;">
            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number"><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br><br>

            <label for="rooms">Number of Rooms:</label>
            <input type="number" id="rooms" name="rooms"><br><br>

            <label for="type">Hotel Type:</label>
            <input type="text" id="type" name="type"><br><br>

            <label for="nearby_places">Nearby Places:</label>
            <input type="text" id="nearby_places" name="nearby_places"><br><br>

            <label for="amenities_facilities">Amenities and Facilities:</label>
            <input type="text" id="amenities_facilities" name="amenities_facilities"><br><br>
        </div>

        <!-- Fields specific to Events -->
        <div id="event-fields" style="display:none;">
            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date"><br><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location"><br><br>
        </div>

        <input type="submit" value="Submit">
    </form>

    <script>
        document.getElementById('table').addEventListener('change', function() {
            const table = this.value;
            const hotelFields = document.getElementById('hotel-fields');
            const eventFields = document.getElementById('event-fields');
            const commonFields = document.getElementById('common-fields');

            if (table === 'hotels') {
                hotelFields.style.display = 'block';
                eventFields.style.display = 'none';
            } else if (table === 'events') {
                eventFields.style.display = 'block';
                hotelFields.style.display = 'none';
            } else {
                hotelFields.style.display = 'none';
                eventFields.style.display = 'none';
            }

            // For other tables, you may need to adjust based on their specific fields
            // For now, these fields are shared among all other options
        });
    </script>
</body>
</html>
