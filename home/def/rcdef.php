<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Handle Image Uploads
    function uploadImage($fileInput) {
        if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == 0) {
            return file_get_contents($_FILES[$fileInput]['tmp_name']);
        } else {
            return null; // If no file is uploaded
        }
    }

    $img = uploadImage("img");
    $img1 = uploadImage("img1");
    $img2 = uploadImage("img2");
    $img3 = uploadImage("img3");

    // Prepare SQL Query
    $sql = "INSERT INTO recreational_facilities (title, description, img, img1, img2, img3, latitude, longitude) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdd", $title, $description, $img, $img1, $img2, $img3, $latitude, $longitude);

    // Execute Query
    if ($stmt->execute()) {
        echo "<script>alert('Recreational Facility successfully added!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
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
    <title>Add Recreational Facility | CandonXplore</title>
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
        <h2>Add a Recreational Facility</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Facility Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="file" name="img" accept="image/*" required>
            <input type="file" name="img1" accept="image/*">
            <input type="file" name="img2" accept="image/*">
            <input type="file" name="img3" accept="image/*">
            <input type="text" name="latitude" placeholder="Latitude" required>
            <input type="text" name="longitude" placeholder="Longitude" required>
            <button type="submit">Add Facility</button>
        </form>
    </div>
</body>
</html>
