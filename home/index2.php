<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .carousel-inner img {
            height: 500px;
            object-fit: cover;
        }
        .highlights {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        .highlight-item {
            text-align: center;
            padding: 20px;
            transition: transform 0.3s;
        }
        .highlight-item:hover {
            transform: scale(1.1);
        }
        .highlight-item i {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 15px;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
        }
        header .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }
        .hero {
            text-align: center;
            padding: 100px 20px;
            background-color: #f1f1f1;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
            color: #555;
        }
        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
            position: relative;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }
        .carousel-item img {
            border-radius: 20px;
            transition: transform 0.5s ease-in-out;
            filter: brightness(0.8);
        }
        .carousel-item.active img {
            transform: scale(1.1);
            filter: brightness(1);
        }
        .carousel-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
            border-radius: 20px;
            z-index: 1;
        }
        .carousel-item .card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }
        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">My Website</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to Our Website</h1>
        <p>Discover amazing features and content tailored just for you.</p>
    </div>

    <!-- Carousel -->
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Add indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card">
                    <img src="../uploads/home/1 (1).jpg" class="card-img-top" alt="Card 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 1</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card">
                    <img src="../uploads/home/1 (2).jpg" class="card-img-top" alt="Card 2">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card">
                    <img src="../uploads/home/1 (3).jpg" class="card-img-top" alt="Card 3">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 3</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Highlights Section -->
    <div class="highlights">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="highlight-item">
                        <i class="fas fa-bolt"></i>
                        <h4>Fast Performance</h4>
                        <p>Enjoy lightning-fast loading times and smooth navigation.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-item">
                        <i class="fas fa-shield-alt"></i>
                        <h4>Secure Platform</h4>
                        <p>Your data is safe with our top-notch security measures.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-item">
                        <i class="fas fa-thumbs-up"></i>
                        <h4>User Friendly</h4>
                        <p>Our platform is designed with user experience in mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2023 My Website. All Rights Reserved.</p>
            <div>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>