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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Image Upload Handling
    function getImageData($file) {
        return isset($_FILES[$file]) && $_FILES[$file]["error"] == 0 ? file_get_contents($_FILES[$file]["tmp_name"]) : null;
    }

    $img = getImageData("img");

    // SQL query to insert into 'ancestral_house' table
    $sql = "INSERT INTO ancestral_house (title, description, location, img, latitude, longitude) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->send_long_data(3, $img); // Send binary data for the 'img' column
    $stmt->bind_param("sssbdd", $title, $description, $location, $img, $latitude, $longitude);

    if ($stmt->execute()) {
        echo "<script>alert('Ancestral house successfully added!');</script>";
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
    <title>Add Ancestral House | CandonXplore</title>
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
        <h2>Add Ancestral House</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Ancestral House Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="location" placeholder="Location" required>
            <input type="file" name="img" accept="image/*" required>
            <input type="text" name="latitude" placeholder="Latitude" required>
            <input type="text" name="longitude" placeholder="Longitude" required>
            <button type="submit">Add Ancestral House</button>
        </form>
    </div>
</body>
</html>
