<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /project-study/profile/login.php"); // Redirect to login.php if not logged in
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'candonxplore_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Improved error message
}

$uname = $_SESSION['user']['uname'] ?? null;
$hotel_id = $_GET['hotel_id'] ?? null; // Get hotel_id from URL

if (!$uname || !$hotel_id) {
    die("Invalid user or hotel ID."); // Ensure both uname and hotel_id are provided
}

// Fetch hotel name for display
$hotel_name = "Our Hotel"; // Default name
$stmt = $conn->prepare("SELECT title FROM hotels WHERE id = ?"); // Updated table and column name
if ($stmt) {
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $stmt->bind_result($fetched_name);
    if ($stmt->fetch()) {
        $hotel_name = $fetched_name;
    }
    $stmt->close();
}

// Fetch user's existing rating for the hotel
$user_rating = 0; // Default to no rating
$stmt = $conn->prepare("SELECT rating FROM hotel_ratings WHERE uname = ? AND hotel_id = ?");
if ($stmt) {
    $stmt->bind_param("si", $uname, $hotel_id);
    $stmt->execute();
    $stmt->bind_result($existing_rating);
    if ($stmt->fetch()) {
        $user_rating = $existing_rating;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'] ?? 0; // Default to 0 if not set

    if ($rating < 1 || $rating > 5) {
        echo "<script>alert('Invalid rating. Please select a value between 1 and 5.');</script>";
    } else {
        if ($user_rating > 0) {
            // Update existing rating
            $stmt = $conn->prepare("UPDATE hotel_ratings SET rating = ? WHERE uname = ? AND hotel_id = ?");
            if ($stmt) {
                $stmt->bind_param("isi", $rating, $uname, $hotel_id);
                if ($stmt->execute()) {
                    echo "<script>alert('Your rating has been updated!');</script>";
                    $user_rating = $rating; // Update the displayed rating
                    echo "<script>window.location.href = '/project-study/profile/profile.php';</script>"; // Redirect to profile.php
                } else {
                    echo "<script>alert('Error updating your rating. Please try again later.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Database error: Unable to prepare statement.');</script>";
            }
        } else {
            // Insert new rating
            $stmt = $conn->prepare("INSERT INTO hotel_ratings (uname, hotel_id, rating) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sii", $uname, $hotel_id, $rating);
                if ($stmt->execute()) {
                    echo "<script>alert('Thank you for your feedback!');</script>";
                    $user_rating = $rating; // Update the displayed rating
                    echo "<script>window.location.href = '/project-study/profile/profile.php';</script>"; // Redirect to profile.php
                } else {
                    echo "<script>alert('Error submitting your rating. Please try again later.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Database error: Unable to prepare statement.');</script>";
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate <?php echo htmlspecialchars($hotel_name); ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            color: #333;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .stars {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        .star {
            font-size: 40px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s, transform 0.3s;
        }
        .star:hover, .star.selected {
            color: #f39c12;
            transform: scale(1.2);
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');
            const userRating = <?php echo $user_rating; ?>; // Pre-fill user's existing rating

            // Highlight stars based on user's existing rating
            if (userRating > 0) {
                for (let i = 0; i < userRating; i++) {
                    stars[i].classList.add('selected');
                }
                ratingInput.value = userRating;
            }

            // Handle star selection
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    stars.forEach(s => s.classList.remove('selected'));
                    for (let i = 0; i <= index; i++) {
                        stars[i].classList.add('selected');
                    }
                    ratingInput.value = index + 1;
                });
            });

            // Ensure a rating is selected before submitting
            document.querySelector('form').addEventListener('submit', (e) => {
                if (ratingInput.value === "0") {
                    e.preventDefault();
                    alert('Please select a rating before submitting.');
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($uname); ?>!</h1>
        <p>Rate <?php echo htmlspecialchars($hotel_name); ?>:</p>
        <?php if ($user_rating > 0): ?>
            <p>Your current rating: <?php echo $user_rating; ?> stars</p>
        <?php endif; ?>
        <form method="POST">
            <div class="stars">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
            <button type="submit"><?php echo $user_rating > 0 ? 'Update Rating' : 'Submit'; ?></button>
        </form>
    </div>
</body>
</html>
