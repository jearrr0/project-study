<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: auth.php?action=signin");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'candonxplore_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$uname = $_SESSION['username'];
$resto_id = $_GET['resto_id'] ?? 1; // Default resto_id for demonstration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO resto_ratings (uname, resto_id, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $uname, $resto_id, $rating);

    if ($stmt->execute()) {
        echo "<script>alert('Thank you for your feedback!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Our Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        h1 {
            font-size: 24px;
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
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
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
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    stars.forEach(s => s.classList.remove('selected'));
                    for (let i = 0; i <= index; i++) {
                        stars[i].classList.add('selected');
                    }
                    ratingInput.value = index + 1;
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($uname); ?>!</h1>
        <p>Rate our services:</p>
        <form method="POST">
            <div class="stars">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
