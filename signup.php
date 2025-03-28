<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'candonxplore_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $uname = $_POST['uname'];
    $pword = password_hash($_POST['pword'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $contact = $_POST['contact'] ?? null;
    $address = $_POST['address'] ?? null;

    // Check if username already exists
    $checkStmt = $conn->prepare("SELECT uname FROM users WHERE uname = ?");
    $checkStmt->bind_param("s", $uname);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Username already exists. Please choose another.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (uname, pword, name, contact, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $uname, $pword, $name, $contact, $address);

        if ($stmt->execute()) {
            echo "Sign-up successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>

<!-- Signup Form -->
<form method="POST">
    <input type="text" name="uname" placeholder="Username" required>
    <input type="password" name="pword" placeholder="Password" required>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="contact" placeholder="Contact Number">
    <textarea name="address" placeholder="Address"></textarea>
    <button type="submit">Sign Up</button>
</form>

<!-- Sign In Button (Redirects to signin.php) -->
<p>Already have an account? <a href="signin.php"><button type="button">Sign In</button></a></p>
