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

    $sql = "INSERT INTO hotels (title, description, location, contact_number, email, rooms, type, nearby_places, amenities_facilities, latitude, longitude) 
            VALUES ('$title', '$description', '$location', '$contact', '$email', '$rooms', '$type', '$nearby', '$amenities', '$latitude', '$longitude')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Hotel successfully added!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
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
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="CandonXplore Logo" class="logo">
        <h2>Add a New Hotel</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Hotel Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="location" placeholder="Location" required>
            <input type="text" name="contact_number" placeholder="Contact Number">
            <input type="email" name="email" placeholder="Email">
            <input type="number" name="rooms" placeholder="Number of Rooms" required>
            <input type="text" name="type" placeholder="Type (Hotel, Resort, etc.)">
            <textarea name="nearby_places" placeholder="Nearby Places"></textarea>
            <textarea name="amenities_facilities" placeholder="Amenities & Facilities"></textarea>
            <input type="text" name="latitude" placeholder="Latitude" required>
            <input type="text" name="longitude" placeholder="Longitude" required>
            <button type="submit">Add Hotel</button>
        </form>
    </div>
</body>
</html>
