<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "candonxplore_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $contact = $_POST['contact_number'];
    $email = $_POST['email'];
    $rooms = $_POST['rooms'];
    $type = $_POST['type'];
    $nearby = $_POST['nearby_places'];
    $amenities = $_POST['amenities_facilities'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Image upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image type
    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<script>alert('Invalid image format! Only JPG, JPEG, PNG & GIF files are allowed.');</script>";
    } elseif (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        $img = $target_file;

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO hotels (title, description, location, contact_number, email, rooms, type, nearby_places, amenities_facilities, img, latitude, longitude) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $title, $description, $location, $contact, $email, $rooms, $type, $nearby, $amenities, $img, $latitude, $longitude);

        if ($stmt->execute()) {
            echo "<script>alert('Hotel successfully added!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error uploading image.');</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Data Entry | CandonXplore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4b6cb7, #182848);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }
        .logo {
            width: 100px;
            margin-bottom: 15px;
        }
        h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }
        input, textarea {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            outline: none;
            transition: 0.3s;
        }
        input:focus, textarea:focus {
            transform: scale(1.02);
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
        }
        button {
            width: 95%;
            padding: 10px;
            margin-top: 10px;
            background: #ff9800;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #e68900;
            transform: scale(1.05);
        }
        .back-button {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 20px;
            background: #ff9800;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .back-button:hover {
            background: #e68900;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="superadminpanel.php" class="back-button">Back to Panel</a>
        <img src="logo.png" alt="CandonXplore Logo" class="logo">
        <h2>Add a New Hotel</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Hotel Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="location" placeholder="Location" required>
            <input type="text" name="contact_number" placeholder="Contact Number">
            <input type="email" name="email" placeholder="Email">
            <input type="number" name="rooms" placeholder="Number of Rooms" required>
            <input type="text" name="type" placeholder="Type (Hotel, Resort, etc.)">
            <textarea name="nearby_places" placeholder="Nearby Places"></textarea>
            <textarea name="amenities_facilities" placeholder="Amenities & Facilities"></textarea>
            <input type="file" name="img" accept="image/*" required>
            <input type="text" name="latitude" placeholder="Latitude" required>
            <input type="text" name="longitude" placeholder="Longitude" required>
            <button type="submit">Add Hotel</button>
        </form>
    </div>
</body>
</html>
