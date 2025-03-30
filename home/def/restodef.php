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
    $type_of_resto = $_POST['type_of_resto'];
    $location = $_POST['location'];
    $contacts = $_POST['contacts'];
    $services = $_POST['services'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Image Upload Handling
    $best_seller_images = isset($_FILES["best_seller_images"]) && $_FILES["best_seller_images"]["error"] == 0 ? file_get_contents($_FILES["best_seller_images"]["tmp_name"]) : null;
    $resto_image = isset($_FILES["resto_image"]) && $_FILES["resto_image"]["error"] == 0 ? file_get_contents($_FILES["resto_image"]["tmp_name"]) : null;

    $sql = "INSERT INTO resto (title, type_of_resto, location, contacts, services, best_seller_images, resto_image, description, latitude, longitude) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssb bssdd", $title, $type_of_resto, $location, $contacts, $services, $best_seller_images, $resto_image, $description, $latitude, $longitude);

    if ($stmt->execute()) {
        echo "<script>alert('Restaurant successfully added!');</script>";
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
    <title>Restaurant Data Entry | CandonXplore</title>
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
        <h2>Add a New Restaurant</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Restaurant Name" required>
            <input type="text" name="type_of_resto" placeholder="Type of Restaurant" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="text" name="contacts" placeholder="Contact Number">
            <textarea name="services" placeholder="Services Offered"></textarea>
            <textarea name="description" placeholder="Description"></textarea>
            <label for="best_seller_images">Best Seller Images (3-4 images to upload):</label>
            <input type="file" name="best_seller_images" accept="image/*" multiple>
            <label for="resto_image">Restaurant Image:</label>
            <input type="file" name="resto_image" accept="image/*">
            <input type="text" name="latitude" placeholder="Latitude" required>
            <input type="text" name="longitude" placeholder="Longitude" required>
            <button type="submit">Add Restaurant</button>
        </form>
    </div>
</body>
</html>
