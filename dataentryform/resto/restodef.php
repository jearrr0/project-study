<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/project-study/dataentryform/config.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Restaurant</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background: url('/project-study/assets/background.jpg') no-repeat center center fixed; 
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
    <img src="/project-study/uploads/experience/candon-logo.png" alt="Logo" class="logo" style="max-width: 200px;">
    <h2>Add New Restaurant</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Type of Restaurant:</label>
        <input type="text" name="type_of_resto" required>

        <label>Location:</label>
        <input type="text" name="location" required>

        <label>Contacts:</label>
        <input type="text" name="contacts" required>

        <label>Services:</label>
        <textarea name="services" rows="3" required></textarea>

        <label>Best Seller Images:</label>
        <input type="file" name="best_seller_images" accept="image/*">

        <label>Restaurant Image:</label>
        <input type="file" name="resto_image" accept="image/*">

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Latitude:</label>
        <input type="text" name="latitude" required pattern="^-?\d+(\.\d+)?$" title="Enter valid latitude">

        <label>Longitude:</label>
        <input type="text" name="longitude" required pattern="^-?\d+(\.\d+)?$" title="Enter valid longitude">

        <button type="submit" name="submit">Save</button>
    </form>
</div>

<div class="overlay" id="overlay"></div>
<div class="popup" id="popup">
    <p>Restaurant added successfully!</p>
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
    $type_of_resto = $_POST['type_of_resto'];
    $location = $_POST['location'];
    $contacts = $_POST['contacts'];
    $services = $_POST['services'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $bestSellerImages = null;
    if (isset($_FILES['best_seller_images']) && $_FILES['best_seller_images']['error'] == 0) {
        $bestSellerImages = file_get_contents($_FILES['best_seller_images']['tmp_name']);
    }

    $restoImage = null;
    if (isset($_FILES['resto_image']) && $_FILES['resto_image']['error'] == 0) {
        $restoImage = file_get_contents($_FILES['resto_image']['tmp_name']);
    }

    $stmt = $conn->prepare("INSERT INTO resto (title, type_of_resto, location, contacts, services, best_seller_images, resto_image, description, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssbbssdd", $title, $type_of_resto, $location, $contacts, $services, $bestSellerImages, $restoImage, $description, $latitude, $longitude);

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
