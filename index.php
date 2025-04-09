<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CandonXplore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('/project-study/uploads/bg.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: #fff;
        }
        .landing-container {
            text-align: center;
            background: rgba(0, 0, 0, 0.85);
            padding: 60px;
            border-radius: 25px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
            animation: fadeIn 1.5s ease-in-out;
        }
        .landing-container h1 {
            font-size: 4rem;
            font-weight: bold;
            background: linear-gradient(to right, #00d4ff, #007bff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }
        .landing-container h1:hover {
            transform: scale(1.05);
        }
        .landing-container p {
            font-size: 1.6rem;
            margin-bottom: 40px;
            color: #ccc;
            transition: color 0.3s ease;
        }
        .landing-container p:hover {
            color: #fff;
        }
        .landing-container .btn {
            font-size: 1.4rem;
            padding: 15px 50px;
            border-radius: 30px;
            background: linear-gradient(to right, #00d4ff, #007bff);
            color: #fff;
            border: none;
            transition: all 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
        }
        .landing-container .btn:hover {
            background: linear-gradient(to right, #007bff, #00d4ff);
            transform: scale(1.1);
            box-shadow: 0 0 30px rgba(0, 123, 255, 0.8);
        }
        .landing-container .icon {
            font-size: 6rem;
            color: #00d4ff;
            margin-bottom: 30px;
            animation: pulse 2s infinite;
            transition: transform 0.3s ease;
        }
        .landing-container .icon:hover {
            transform: rotate(10deg) scale(1.1);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <i class="bi bi-geo-alt icon"></i>
        <h1>Welcome to CandonXplore</h1>
        <p>Discover the beauty and attractions of Candon City. Your adventure starts here!</p>
        <a href="/project-study/main/home.php" class="btn"><i class="bi bi-arrow-right-circle"></i> Enter Site</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
