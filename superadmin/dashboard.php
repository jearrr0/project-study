<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /project-study/login.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/project-study/dataentryform/config.php';

$counts = getCounts($conn);
$attractionCounts = [
    'ancestral_house' => $counts['ancestral_house'],
    'experience' => $counts['experience'],
    'histo' => $counts['histo'],
    'natural_tourist_sites' => $counts['natural_tourist_sites'],
    'recreational_facilities' => $counts['recreational_facilities']
];
$hotelCount = $counts['hotels'];
$restoCount = $counts['resto'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve_hotel'])) {
        $hotelId = $_POST['hotel_id'];
        $stmt = $conn->prepare("UPDATE hotels SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $hotelId);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>Hotel ID $hotelId approved successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } elseif (isset($_POST['reject_hotel'])) {
        $hotelId = $_POST['hotel_id'];
        $stmt = $conn->prepare("DELETE FROM hotels WHERE id = ?");
        $stmt->bind_param("i", $hotelId);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>Hotel ID $hotelId rejected and removed successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7fc;
            color: #333;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 32px;
            color: #222;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .stat-box {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            flex: 1 1 calc(25% - 20px); /* Ensure equal size */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 150px; /* Set consistent height */
        }
        .stat-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }
        .stat-box h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }
        .stat-box p {
            margin: 8px 0 0;
            font-size: 16px;
            font-weight: 500;
        }
        #clock {
            text-align: center;
            font-size: 20px;
            margin-bottom: 30px;
            color: #555;
            font-weight: 500;
        }
        .charts-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .chart-box {
            flex: 1 1 calc(50% - 20px); /* Ensure equal size */
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            min-height: 300px; /* Set consistent height */
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-speedometer2"></i> Super Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house-door"></i> Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tree"></i> Attractions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                            <li><a class="dropdown-item" href="/project-study/dataentryform/attractionsdef/add_ancestral_house.php">Ancestral House</a></li>
                            <li><a class="dropdown-item" href="/project-study/dataentryform/attractionsdef/experiencedef.php">Experience</a></li>
                            <li><a class="dropdown-item" href="/project-study/dataentryform/attractionsdef/histodef.php">Historical Sites</a></li>
                            <li><a class="dropdown-item" href="/project-study/dataentryform/attractionsdef/livelidef.php">Livelihood</a></li>
                            <li><a class="dropdown-item" href="/project-study/dataentryform/attractionsdef/naturaldef.php">Natural Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="/project-study/dataentryform/attractionsdef/recreationaldef.php">Recreational Facilities</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/dataentryform/hotelsdef/hotelsdef.php"><i class="bi bi-building"></i> Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-shop"></i> Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/dataentryform/eventsdef/eventsdef.php"><i class="bi bi-calendar-event"></i> Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <h1>Super Admin Dashboard</h1>
        <div id="clock"></div>
        <div class="stats">
            <div class="stat-box">
                <h2><i class="bi bi-person-badge"></i> <?php echo $counts['establishmentadmin']; ?></h2>
                <p>Establishment Admins</p>
            </div>
            <div class="stat-box">
                <h2><i class="bi bi-people"></i> <?php echo $counts['users']; ?></h2>
                <p>Users</p>
            </div>
            <div class="stat-box">
                <h2><i class="bi bi-person-check"></i> <?php echo $counts['logged_in_admins']; ?></h2>
                <p>Logged-in Admins</p>
            </div>
            <div class="stat-box">
                <h2><i class="bi bi-building"></i> <?php echo $hotelCount; ?></h2>
                <p>Hotels Recorded</p>
            </div>
            <div class="stat-box">
                <h2><i class="bi bi-shop"></i> <?php echo $restoCount; ?></h2>
                <p>Restaurants Recorded</p>
            </div>
        </div>
        <div class="charts-container">
            <div class="chart-box" style="flex: 1; order: 1;">
                <canvas id="statsChart"></canvas>
            </div>
            <div class="chart-box" style="flex: 1; order: 2;">
                <canvas id="attractionsChart"></canvas>
            </div>
        </div>
        <button id="togglePendingHotels" class="btn btn-primary" style="margin-bottom: 20px;">Pending Hotels Request</button>
        <div id="pendingHotelsQueue" style="display: none;">
            <h2>Pending Hotel Requests</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT id, title, location, contact_number FROM hotels WHERE status = 'pending'");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['contact_number']}</td>
                                <td>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='hotel_id' value='{$row['id']}'>
                                        <button type='submit' name='approve_hotel' class='btn btn-success btn-sm'>Approve</button>
                                    </form>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='hotel_id' value='{$row['id']}'>
                                        <button type='submit' name='reject_hotel' class='btn btn-danger btn-sm'>Reject</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Real-time clock
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Toggle Pending Hotels Queue
        document.getElementById('togglePendingHotels').addEventListener('click', function () {
            const queue = document.getElementById('pendingHotelsQueue');
            queue.style.display = queue.style.display === 'none' ? 'block' : 'none';
        });

        // Chart.js graph
        const ctx = document.getElementById('statsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Establishment Admins', 'Users', 'Logged-in Admins'],
                datasets: [{
                    label: 'Counts',
                    data: [<?php echo $counts['establishmentadmin']; ?>, <?php echo $counts['users']; ?>, <?php echo $counts['logged_in_admins']; ?>],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Chart.js graph for Title Attractions
        const attractionsCtx = document.getElementById('attractionsChart').getContext('2d');
        new Chart(attractionsCtx, {
            type: 'pie',
            data: {
            labels: ['Ancestral House', 'Experience', 'Historical Sites', 'Natural Tourist Sites', 'Recreational Facilities'],
            datasets: [{
                label: 'Attractions',
                data: [
                <?php echo $attractionCounts['ancestral_house']; ?>, 
                <?php echo $attractionCounts['experience']; ?>, 
                <?php echo $attractionCounts['histo']; ?>, 
                <?php echo $attractionCounts['natural_tourist_sites']; ?>, 
                <?php echo $attractionCounts['recreational_facilities']; ?>
                ],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
            }]
            },
            options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            maintainAspectRatio: false // Allow resizing
            }
        });

        // Adjust the chart container height
        document.getElementById('attractionsChart').parentElement.style.height = '250px';
    </script>
</body>
</html>
