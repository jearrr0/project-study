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

// Ensure the 'ancestral_house' table exists
$tableCreationQuery = "
    CREATE TABLE IF NOT EXISTS ancestral_house (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        location VARCHAR(255) NOT NULL,
        img LONGBLOB,
        latitude DOUBLE NOT NULL,
        longitude DOUBLE NOT NULL
    )
";
$conn->query($tableCreationQuery);

// Define the getImageData function globally
function getImageData($file) {
    return isset($_FILES[$file]) && $_FILES[$file]["error"] == 0 ? file_get_contents($_FILES[$file]["tmp_name"]) : null;
}

$editData = null; // Variable to hold data for editing

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        // Delete logic
        $id = $_POST['id'];
        $sql = "DELETE FROM ancestral_house WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "<script>alert('Record deleted successfully!');</script>";
    } elseif (isset($_POST['edit'])) {
        // Fetch data for editing
        $id = $_POST['id'];
        $result = $conn->query("SELECT * FROM ancestral_house WHERE id = $id");
        $editData = $result->fetch_assoc();
    } elseif (isset($_POST['update'])) {
        // Update logic
        $id = $_POST['id'];
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $location = $_POST['location'] ?? '';
        $latitude = $_POST['latitude'] ?? 0;
        $longitude = $_POST['longitude'] ?? 0;
        $img = getImageData("img");

        $sql = "UPDATE ancestral_house SET title = ?, description = ?, location = ?, img = ?, latitude = ?, longitude = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssbddi", $title, $description, $location, $img, $latitude, $longitude, $id);
        $stmt->execute();
        echo "<script>alert('Record updated successfully!');</script>";
    } else {
        // Add logic
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $location = $_POST['location'] ?? '';
        $latitude = $_POST['latitude'] ?? 0;
        $longitude = $_POST['longitude'] ?? 0;
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
}
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
            align-items: flex-start; /* Changed from center to flex-start */
            min-height: 100vh; /* Ensure the body takes full height */
            margin: 0;
            padding: 20px; /* Added padding for better spacing */
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 100%; /* Adjusted to fit the screen width */
            max-width: 600px; /* Added max-width for better responsiveness */
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
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        th {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="superadminpanel.php" class="back-button">Back to Panel</a>
        <h2><?php echo $editData ? 'Edit Ancestral House' : 'Add Ancestral House'; ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
            <input type="text" name="title" placeholder="Ancestral House Name" value="<?php echo $editData['title'] ?? ''; ?>" required>
            <textarea name="description" placeholder="Description" required><?php echo $editData['description'] ?? ''; ?></textarea>
            <input type="text" name="location" placeholder="Location" value="<?php echo $editData['location'] ?? ''; ?>" required>
            <input type="file" name="img" accept="image/*">
            <input type="text" name="latitude" placeholder="Latitude" value="<?php echo $editData['latitude'] ?? ''; ?>" required>
            <input type="text" name="longitude" placeholder="Longitude" value="<?php echo $editData['longitude'] ?? ''; ?>" required>
            <button type="submit" name="<?php echo $editData ? 'update' : 'add'; ?>">
                <?php echo $editData ? 'Update Ancestral House' : 'Add Ancestral House'; ?>
            </button>
        </form>

        <!-- Display Records -->
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT id, title FROM ancestral_house");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['title']}</td>
                            <td>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' name='edit'>Edit</button>
                                </form>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' name='delete'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close(); // Close the connection here, after all database operations
?>
