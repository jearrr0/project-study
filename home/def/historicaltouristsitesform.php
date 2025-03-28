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

    // Function to process image uploads
    function processImage($fileInput) {
        return !empty($_FILES[$fileInput]['tmp_name']) ? addslashes(file_get_contents($_FILES[$fileInput]['tmp_name'])) : null;
    }

    // Handle all four image uploads
    $img  = processImage('img');   // First image
    $img1 = processImage('img1');  // Second image
    $img2 = processImage('img2');  // Third image
    $img3 = processImage('img3');  // Fourth image

    // Prepare and execute query
    $stmt = $conn->prepare("INSERT INTO historical_tourist_sites (title, description, img, img1, img2, img3) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $img, $img1, $img2, $img3);

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
    <title>Add Historical Site</title>
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
    <h2>Add Historical Site</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Image (Main Image):</label>
        <input type="file" name="img" accept="image/*">

        <label>Image 1:</label>
        <input type="file" name="img1" accept="image/*">

        <label>Image 2:</label>
        <input type="file" name="img2" accept="image/*">

        <label>Image 3:</label>
        <input type="file" name="img3" accept="image/*">

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
