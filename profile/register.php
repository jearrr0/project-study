<?php
session_start();
$conn = new mysqli("localhost", "root", "", "candonxplore_db");

if (isset($_SESSION['user'])) {
    header("Location: profile.php"); // Redirect if already logged in
    exit();
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullname = trim($_POST['fullname']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);

    // Check if username already exists
    $query = $conn->prepare("SELECT * FROM users WHERE uname=?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Account already exists! Please log in.');
                window.location.href='login.php';
              </script>";
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO users (uname, pword, name, contact, address) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("sssss", $username, $hashed_password, $fullname, $contact, $address);

        if ($insert->execute()) {
            echo "<script>
                    alert('Account created successfully! You can now log in.');
                    window.location.href='login.php';
                  </script>";
            exit();
        } else {
            $error = "Error creating account.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - CandonXplore</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
            padding-top: 20px; /* Add padding to prevent overlap with header */
            padding-bottom: 20px; /* Add padding to prevent overlap with footer */
        }
        .register-card {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px; /* Increase top margin to avoid overlap with header */
            margin-bottom: 50px;
        }
    </style>
</head>
<body style="background: url('../uploads/bg.png') no-repeat center center fixed; background-size: cover; margin: 0; padding: 0; font-family: 'Arial', sans-serif;">
<<!-- Navigation Bar -->
<nav class="navbar bg-body-tertiary fixed-top" style="padding: 0.5rem 1rem;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 50px; margin-right: 10px;">
            <span style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 1.2rem; color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">CandonXplore</span>
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
                        <a class="nav-link active" aria-current="page" href="/project-study/home/index.php">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-map"></i> Attractions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                            <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php"><i class="bi bi-people"></i> Experience Program</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/hotels/hotels.php"><i class="bi bi-building"></i> Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/resto/restaurants.php"><i class="bi bi-shop"></i> Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/events/events.php"><i class="bi bi-calendar-event"></i> Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/profile/login.php"><i class="bi bi-person"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger text-black px-3 ms-2" href="profile.php?logout=true" style="border: 2px solid #dc3545; border-radius: 20px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="register-card text-center">
        <h3 class="fw-bold">Create an Account</h3>
        <hr>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-person"></i> Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-person-badge"></i> Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-telephone"></i> Contact Number</label>
                <input type="text" name="contact" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-geo-alt"></i> Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-lock"></i> Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100"><i class="bi bi-person-plus"></i> Sign Up</button>
        </form>

        <a href="login.php" class="btn btn-link mt-3"><i class="bi bi-box-arrow-in-right"></i> Already have an account? Login</a>
    </div>
</div>

<footer style="display: flex; justify-content: space-around; align-items: center; padding: 20px; background-color: #f8f9fa; color: black;">
    <div style="text-align: center; flex: 1;">
        <img src="../uploads/Coat_of_arms_of_the_Philippines.svg.png" alt="Philippine Coat of Arms" style="width: 100px;">
        <p><strong>REPUBLIC OF THE PHILIPPINES</strong></p>
        <p>All content is in the public domain unless otherwise stated.</p>
        <p><a href="#" style="color: black;"><i class="bi bi-shield-lock"></i> Privacy Policy</a></p>
    </div>
    <div style="text-align: center; flex: 1;">
        <p><strong>ABOUT GOVPH</strong></p>
        <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
        <p>
            <a href="#" style="color: black;"><i class="bi bi-journal"></i> Official Gazette</a> | 
            <a href="#" style="color: black;"><i class="bi bi-bar-chart"></i> Open Data Portal</a> | 
            <a href="#" style="color: black;"><i class="bi bi-chat-dots"></i> Send us your feedback</a>
        </p>
    </div>
    <div style="text-align: center; flex: 1;">
        <p><strong>GOVERNMENT LINKS</strong></p>
        <p>
            <a href="#" style="color: black;"><i class="bi bi-building"></i> Office of the President</a> | 
            <a href="#" style="color: black;"><i class="bi bi-person-badge"></i> Office of the Vice President</a> | 
            <a href="#" style="color: black;"><i class="bi bi-bank"></i> Senate of the Philippines</a> | 
            <a href="#" style="color: black;"><i class="bi bi-house"></i> House of Representatives</a> | 
            <a href="#" style="color: black;"><i class="bi bi-gavel"></i> Supreme Court</a> | 
            <a href="#" style="color: black;"><i class="bi bi-columns-gap"></i> Court of Appeals</a> | 
            <a href="#" style="color: black;"><i class="bi bi-scales"></i> Sandiganbayan</a>
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
