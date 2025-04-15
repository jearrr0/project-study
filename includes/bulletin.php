<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bulletin posts from the database
$sql = "SELECT id, title, content, date_posted FROM bulletin ORDER BY date_posted DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bulletin - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/nav_footer.php'; ?>
<?php renderNav(); ?>

<section class="text-center py-5 bg-light">
    <div class="container">
        <h1 class="display-4 fw-bold">Bulletin</h1>
        <p class="lead text-muted">Stay updated with the latest announcements and news from Candon City.</p>
    </div>
</section>

<main class="container mt-4">
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="text-muted"><small>Posted on <?php echo date("F j, Y", strtotime($row['date_posted'])); ?></small></p>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No announcements available at the moment.</p>";
        }
        ?>
    </div>
</main>

<?php renderFooter(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
