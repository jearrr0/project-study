<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if table is set
if (isset($_POST['table'])) {
    $table = $_POST['table'];
    $columns = [];
    $values = [];

    // Loop through POST data to prepare columns and values
    foreach ($_POST as $key => $value) {
        if ($key !== 'table') { // Exclude the table name from columns
            $columns[] = $key;
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }
    }

    // Handle file uploads
    foreach ($_FILES as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $targetFile);

            $columns[] = $key;
            $values[] = "'" . $conn->real_escape_string($targetFile) . "'";
        }
    }

    // Construct the SQL query
    $sql = "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the form with a success message
        header("Location: submit.php?success=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
