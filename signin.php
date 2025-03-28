<?php
// Start the session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'candonxplore_db');
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT pword FROM users WHERE uname = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);

    if ($stmt->fetch() && password_verify($pword, $hashedPassword)) {
        // Set session variable for logged-in user
        $_SESSION['username'] = $uname;

        // Redirect to home page
        header("Location: home/index.php");
        exit(); // Stop script execution after redirection
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="POST">
    <input type="text" name="uname" placeholder="Username" required>
    <input type="password" name="pword" placeholder="Password" required>
    <button type="submit">Sign In</button>
</form>

<a href="forgot_password.php">Forgot Password?</a>
