<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "candonxplore_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $rooms = $_POST['rooms'];
    $type = $_POST['type'];
    $nearby_places = $_POST['nearby_places'];
    $amenities_facilities = $_POST['amenities_facilities'];
    
    // Handle image upload
    $img = null;
    if (!empty($_FILES['img']['tmp_name'])) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
    }

    // Prepare and execute query
    $stmt = $conn->prepare("INSERT INTO hotels (title, description, location, contact_number, email, rooms, type, nearby_places, amenities_facilities, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisiss", $title, $description, $location, $contact_number, $email, $rooms, $type, $nearby_places, $amenities_facilities, $img);
    
    if ($stmt->execute()) {
        echo "<p class='success'>Data inserted successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Hotel</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Location:</label>
        <textarea name="location" required></textarea>

        <label>Contact Number:</label>
        <input type="text" name="contact_number">

        <label>Email:</label>
        <input type="email" name="email">

        <label>Rooms:</label>
        <input type="number" name="rooms" required>

        <label>Type:</label>
        <input type="text" name="type">

        <label>Nearby Places (comma-separated):</label>
        <input type="text" name="nearby_places">

        <label>Amenities & Facilities (comma-separated):</label>
        <input type="text" name="amenities_facilities">

        <label>Image:</label>
        <input type="file" name="img" accept="image/*">

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
