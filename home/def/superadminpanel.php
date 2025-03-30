<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Panel | CandonXplore</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
        }
        .sidebar {
            width: 250px;
            background: #182848;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            color: #ff9800;
        }
        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #ff9800;
            color: #182848;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        .main-content h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }
        .card h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 16px;
        }
        .chart-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
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
