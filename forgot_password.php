<?php
// ...existing code...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $newPassword = $_POST['new_password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $conn = new mysqli('localhost', 'root', '', 'project_study');
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $stmt = $conn->prepare("UPDATE users SET pword = ? WHERE uname = ?");
    $stmt->bind_param("ss", $hashedPassword, $uname);

    if ($stmt->execute()) {
        echo "Password reset successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<form method="POST">
    <input type="text" name="uname" placeholder="Username" required>
    <input type="password" name="new_password" placeholder="New Password" required>
    <button type="submit">Reset Password</button>
</form>
