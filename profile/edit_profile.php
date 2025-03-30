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

// Fetch user details
$query = $conn->prepare("SELECT * FROM users WHERE uname=?");
$query->bind_param("s", $user);
$query->execute();
$userData = $query->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = trim($_POST['uname']);
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);

    // Check if username already exists
    $checkUser = $conn->prepare("SELECT * FROM users WHERE uname=? AND uname != ?");
    $checkUser->bind_param("ss", $uname, $user);
    $checkUser->execute();
    $checkResult = $checkUser->get_result();

    if ($checkResult->num_rows > 0) {
        $error = "Username already taken.";
    } else {
        $update = $conn->prepare("UPDATE users SET uname=?, name=?, contact=?, address=? WHERE uname=?");
        $update->bind_param("sssss", $uname, $name, $contact, $address, $user);

        if ($update->execute()) {
            $_SESSION['user']['uname'] = $uname;
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['contact'] = $contact;
            $_SESSION['user']['address'] = $address;
            $success = "Profile updated successfully!";
        } else {
            $error = "Update failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - CandonXplore</title>
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

<!-- Edit Profile Form -->
<div class="container">
    <div class="profile-card text-center">
        <h3 class="fw-bold">Edit Profile</h3>
        <hr>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="uname" class="form-control" value="<?= htmlspecialchars($userData['uname']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($userData['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact</label>
                <input type="text" name="contact" class="form-control" value="<?= htmlspecialchars($userData['contact']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($userData['address']) ?>" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Update Profile</button>
        </form>
        <a href="profile.php" class="btn btn-secondary mt-3">Back to Profile</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
