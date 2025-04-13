<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/project-study/dataentryform/config.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Livelihood</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background: url('/project-study/uploads/bg.png') no-repeat center center fixed; 
            background-size: cover; 
            color: #333; 
        }
        .form-container {
            max-width: 600px; 
            margin: 50px auto; 
            background: rgba(255, 255, 255, 0.9); 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
            text-align: center;
        }
        .form-container img.logo {
            max-width: 150px; 
            margin-bottom: 20px; 
        }
        input, textarea {
            width: 100%; 
            margin-bottom: 15px; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            font-size: 16px;
        }
        label { 
            font-weight: bold; 
            display: block; 
            margin-bottom: 5px; 
            text-align: left;
        }
        button { 
            padding: 10px 20px; 
            border: none; 
            background: #007bff; 
            color: white; 
            cursor: pointer; 
            border-radius: 5px; 
            font-size: 16px;
        }
        button:hover { 
            background: #0056b3; 
        }
        img#preview { 
            max-width: 100%; 
            margin-top: 10px; 
            display: none; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }
        .popup {
            display: none; 
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
            text-align: center; 
            z-index: 1000;
        }
        .popup p {
            margin: 0 0 15px;
            font-size: 18px;
        }
        .popup button {
            padding: 10px 20px; 
            border: none; 
            background: #007bff; 
            color: white; 
            cursor: pointer; 
            border-radius: 5px; 
            font-size: 16px;
        }
        .popup button:hover {
            background: #0056b3;
        }
        .overlay {
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: rgba(0, 0, 0, 0.5); 
            z-index: 999;
        }
    </style>
</head>
<body>

<div class="form-container">
    <img src="/project-study/uploads/logo.png" alt="Logo" class="logo" style="max-width: 200px;">
    <h2>Add New Livelihood</h2>
    <form method="POST" enctype="multipart/form-data">
        <label><i class="fas fa-briefcase"></i> Site Name:</label>
        <input type="text" name="title" required>

        <label><i class="fas fa-align-left"></i> Site Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label><i class="fas fa-map-marker-alt"></i> Site Location:</label>
        <input type="text" name="location" required>

        <label><i class="fas fa-map-pin"></i> Latitude:</label>
        <input type="text" name="latitude" required pattern="^-?\d+(\.\d+)?$" title="Enter valid latitude">

        <label><i class="fas fa-map-pin"></i> Longitude:</label>
        <input type="text" name="longitude" required pattern="^-?\d+(\.\d+)?$" title="Enter valid longitude">

        <label><i class="fas fa-image"></i> Site Image:</label>
        <input type="file" name="img" accept="image/*" onchange="previewImage(event)">
        <img id="preview">

        <button type="submit" name="submit">Save</button>
    </form>
</div>

<div class="overlay" id="overlay"></div>
<div class="popup" id="popup">
    <p>Livelihood added successfully!</p>
    <button onclick="closePopup()">OK</button>
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}

function showPopup() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}
</script>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $imgData = null;
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $imgData = file_get_contents($_FILES['img']['tmp_name']);
    }

    $stmt = $conn->prepare("INSERT INTO livelihood (title, description, location, img, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssbdd", $title, $description, $location, $imgData, $latitude, $longitude);

    // Set blob parameter
    $null = NULL;
    $stmt->send_long_data(3, $imgData);
    
    if ($stmt->execute()) {
        echo "<script>showPopup();</script>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
