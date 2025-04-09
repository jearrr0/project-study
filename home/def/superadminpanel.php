<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Panel | CandonXplore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            height: 100vh;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
        }
        .sidebar {
            height: 100vh;
            background: #182848;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar h2 {
            color: #ff9800;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #ff9800;
            color: #182848;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }
        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            background: #ff9800;
            color: #182848;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .toggle-sidebar {
                display: block;
            }
        }
    </style>
</head>
<body>
    <button class="toggle-sidebar" onclick="toggleSidebar()">☰ Menu</button>
    <div class="sidebar">
        <h2>Superadmin Panel</h2>
        <a href="ancestralform.php">Ancestral House</a>
        <a href="attractiondef.php">Attractions</a>
        <a href="eventsdef.php">Events</a>
        <a href="expdef.php">Experiences</a>
        <a href="historicaltouristsitesform.php">Historical Tourist Sites</a>
        <a href="hotelsdef.php">Hotels</a>
        <a href="hsdef.php">Historical Sites</a>
        <a href="htsdef.php">Historical Tourist Sites (Alt)</a>
        <a href="livelihoodsdef.php">Livelihoods</a>
        <a href="rcdef.php">Recreational Facilities</a>
        <a href="restodef.php">Restaurants</a>
    </div>
    <div class="main-content">
        <h1>Welcome to the Superadmin Panel</h1>
        <div class="card">
            <h2>Dashboard</h2>
            <p>Total Accounts Created: <?php echo getTotalAccounts(); ?></p>
        </div>
        
        <div class="card">
            <h2>Data Visualization</h2>
            <div class="chart-container">
                <canvas id="accountsChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        const ctx = document.getElementById('accountsChart').getContext('2d');
        const accountsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Accounts Created',
                    data: <?php echo json_encode(getMonthlyAccountsData()); ?>,
                    backgroundColor: 'rgba(255, 152, 0, 0.7)',
                    borderColor: 'rgba(255, 152, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php
function getTotalAccounts() {
    $conn = new mysqli("localhost", "root", "", "candonxplore_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query("SELECT COUNT(*) AS total FROM users");
    $row = $result->fetch_assoc();
    $conn->close();
    return $row['total'];
}

function getMonthlyAccountsData() {
    $conn = new mysqli("localhost", "root", "", "candonxplore_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $data = array_fill(1, 12, 0); // Initialize data for all 12 months
    $result = $conn->query("SELECT MONTH(created_at) AS month, COUNT(*) AS count FROM users GROUP BY MONTH(created_at)");
    while ($row = $result->fetch_assoc()) {
        $data[(int)$row['month']] = (int)$row['count'];
    }
    $conn->close();
    return $data;
}
?>
