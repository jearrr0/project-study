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

// Get the ID of the selected site
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the details of the selected historical site
$sql = "SELECT title, description, location, img, latitude, longitude 
        FROM histo 
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $site = $result->fetch_assoc();
} else {
    die("Historical site not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($site['title']); ?> - CandonXplore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../includes/nav_footer.php'; ?>
<?php renderNav(); ?>

<!-- Site Details Section -->
<section class="container py-5" style="margin: 120px auto 20px; padding: 100px;">
    <div class="row">
        <!-- Main Image Section -->
        <div class="col-md-6">
            <?php
            $imageSrc = (!empty($site['img'])) 
                ? "data:image/jpeg;base64," . base64_encode($site['img'])
                : "/project-study/uploads/default-historical-site.jpg"; // Default image
            ?>
            <img src="<?php echo $imageSrc; ?>" alt="Historical Site Image" class="img-fluid rounded shadow-lg mb-4" style="max-height: 400px; object-fit: cover;">
            
            <!-- Horizontal Gallery -->
            <div class="d-flex justify-content-between">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <img src="/project-study/uploads/histoexten-img-<?php echo $i; ?>.jpg" alt="Gallery Image <?php echo $i; ?>" class="img-thumbnail" style="width: 18%; height: 100px; object-fit: cover;">
                <?php } ?>
            </div>
        </div>

        <!-- Details Section -->
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="display-5 fw-bold text-primary"><?php echo htmlspecialchars($site['title']); ?></h1>
            <p class="text-muted fs-5"><?php echo nl2br(htmlspecialchars($site['description'])); ?></p>
            
            <!-- Buttons -->
            <div class="mt-4">
                <a href="/project-study/attractions/pages/historical-tourist-sites.php" class="btn btn-outline-primary btn-lg me-2">
                    <i class="bi bi-arrow-left"></i> Back to Historical Sites
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $site['latitude']; ?>,<?php echo $site['longitude']; ?>" target="_blank" class="btn btn-primary btn-lg">
                    <i class="bi bi-geo-alt"></i> Get Directions
                </a>
            </div>
        </div>
    </div>
</section>

<?php renderFooter(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
