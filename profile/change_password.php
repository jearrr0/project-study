<?php
session_start();
$conn = new mysqli("localhost", "root", "", "candonxplore_db");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";
$user = $_SESSION['user']['uname'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current = trim($_POST['current']);
    $new = trim($_POST['new']);
    $confirm = trim($_POST['confirm']);

    // Fetch current password from database
    $query = $conn->prepare("SELECT pword FROM users WHERE uname=?");
    $query->bind_param("s", $user);
    $query->execute();
    $result = $query->get_result();
    $userData = $result->fetch_assoc();

    if ($userData && password_verify($current, $userData['pword'])) {
        if ($new === $confirm) {
            $new_hashed = password_hash($new, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET pword=? WHERE uname=?");
            $update->bind_param("ss", $new_hashed, $user);

            if ($update->execute()) {
                $success = "Password changed successfully!";
            } else {
                $error = "Error updating password.";
            }
        } else {
            $error = "New passwords do not match.";
        }
    } else {
        $error = "Incorrect current password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - CandonXplore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .profile-card {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../home/index.php">CandonXplore</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link text-white" href="../home/index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link btn btn-danger text-white px-3 ms-2" href="profile.php?logout=true">Logout</a></li>
        </ul>
    </div>
</nav>

<!-- Change Password Form -->
<div class="container">
    <div class="profile-card text-center">
        <h3 class="fw-bold">Change Password</h3>
        <hr>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <form method="POST">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user) ?>" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Current Password</label>
        <input type="password" name="current" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="new" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm New Password</label>
        <input type="password" name="confirm" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-warning w-100">Update Password</button>
</form>

        <a href="profile.php" class="btn btn-secondary mt-3">Back to Profile</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>