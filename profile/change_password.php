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

<nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 70px; margin-right: 50px;">
                <span style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 1.5rem; color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">CandonXplore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">CandonXplore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/project-study/home/index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Attractions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                                <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php">Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php">Natural Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php">Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php">Livelihoods</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php">Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php">Experience Program</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/project-study/hotels/hotels.php">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/resto/restaurants.php">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/events/events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/profile/login.php">Profile</a>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
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

<?php include '../includes/nav_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>