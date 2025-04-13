<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'candonxplore_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getCounts($conn) {
    $counts = [];
    $counts['establishmentadmin'] = $conn->query("SELECT COUNT(*) AS count FROM establishmentadmin")->fetch_assoc()['count'];
    $counts['users'] = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];

    // Check if the 'establishment_admins' table exists before querying
    $result = $conn->query("SHOW TABLES LIKE 'establishment_admins'");
    if ($result && $result->num_rows > 0) {
        $counts['logged_in_admins'] = $conn->query("SELECT COUNT(*) AS count FROM establishment_admins WHERE is_logged_in = 1")->fetch_assoc()['count'];
    } else {
        $counts['logged_in_admins'] = 0; // Default to 0 if the table doesn't exist
    }

    // Add counts for attractions
    $counts['ancestral_house'] = $conn->query("SELECT COUNT(*) AS count FROM ancestral_house")->fetch_assoc()['count'] ?? 0;
    $counts['experience'] = $conn->query("SELECT COUNT(*) AS count FROM experience")->fetch_assoc()['count'] ?? 0;
    $counts['histo'] = $conn->query("SELECT COUNT(*) AS count FROM histo")->fetch_assoc()['count'] ?? 0;
    $counts['natural_tourist_sites'] = $conn->query("SELECT COUNT(*) AS count FROM natural_tourist_sites")->fetch_assoc()['count'] ?? 0;
    $counts['recreational_facilities'] = $conn->query("SELECT COUNT(*) AS count FROM recreational_facilities")->fetch_assoc()['count'] ?? 0;

    // Add counts for hotels and restaurants
    $counts['hotels'] = $conn->query("SELECT COUNT(*) AS count FROM hotels")->fetch_assoc()['count'] ?? 0;
    $counts['resto'] = $conn->query("SELECT COUNT(*) AS count FROM resto")->fetch_assoc()['count'] ?? 0;

    return $counts;
}
?>
