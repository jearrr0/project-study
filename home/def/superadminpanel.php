<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Panel | CandonXplore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4b6cb7, #182848);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .button {
            display: block;
            width: 90%;
            padding: 10px;
            margin: 10px auto;
            background: #ff9800;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            transition: 0.3s;
        }
        .button:hover {
            background: #e68900;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Superadmin Panel</h2>
        <a href="ancestralform.php" class="button">Ancestral House</a>
        <a href="attractiondef.php" class="button">Attractions</a>
        <a href="eventsdef.php" class="button">Events</a>
        <a href="expdef.php" class="button">Experiences</a>
        <a href="historicaltouristsitesform.php" class="button">Historical Tourist Sites</a>
        <a href="hotelsdef.php" class="button">Hotels</a>
        <a href="hsdef.php" class="button">Historical Sites</a>
        <a href="htsdef.php" class="button">Historical Tourist Sites (Alt)</a>
        <a href="livelihoodsdef.php" class="button">Livelihoods</a>
        <a href="rcdef.php" class="button">Recreational Facilities</a>
        <a href="restodef.php" class="button">Restaurants</a>
    </div>
</body>
</html>
