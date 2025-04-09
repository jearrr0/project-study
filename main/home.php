<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Home</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body style="background: linear-gradient(to bottom, #f0f4f8, #d9e2ec);">
    <!-- Navigation Bar -->
    <nav class="navbar bg-body-tertiary fixed-top" style="padding: 0.5rem 1rem;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
                <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 50px; margin-right: 10px;">
                <span style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 1.2rem; color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">CandonXplore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/project-study/home/index.php">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="attractionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-map"></i> Attractions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                                <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                                <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php"><i class="bi bi-people"></i> Experience Program</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/hotels/hotels.php"><i class="bi bi-building"></i> Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/resto/restaurants.php"><i class="bi bi-shop"></i> Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/events/events.php"><i class="bi bi-calendar-event"></i> Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/project-study/profile/login.php"><i class="bi bi-person"></i> Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero" style="position: relative; height: 100vh; color: white; display: flex; align-items: center; justify-content: center; overflow: hidden; width: 100%;">
        <img src="../uploads/home/image-2-1024x724.jpg" alt="Hero Background" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; max-width: 100%; max-height: 100%;">
        <div class="hero-content" style="text-align: center; background-color: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px; width: 100%; max-width: 1200px; margin: auto;">
            <h1>Welcome to Candon City</h1>
            <p>Candon City, located in Ilocos Sur, is known as the "Tobacco Capital of the Philippines" and is famous for its rich history, vibrant culture, and scenic attractions.</p>
        </div>
    </section>

    <!-- Title Sections -->
    <section id="about" class="section" style="text-align: center; padding: 20px; background: linear-gradient(to bottom, #007bff, #0056b3); color: white; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('../uploads/about-bg.jpg') no-repeat center center/cover; opacity: 0.3; z-index: -1;"></div>
        <h2 style="font-size: 2.5rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">What to Do in Candon City</h2>
        <p style="font-size: 1.2rem; max-width: 800px; margin: 10px auto; line-height: 1.6;">Candon City offers a variety of activities for visitors. Explore historical sites, enjoy natural attractions, participate in cultural events, and savor local delicacies. There's something for everyone in this vibrant city.</p>

    </section>

    <!-- Cards Section -->
    <section id="cards" class="section" style="display: flex; justify-content: center; gap: 20px; padding: 20px; flex-wrap: wrap;">
        <!-- Attractions Card -->
        <div class="card" style="flex: 1 1 calc(100% - 40px); max-width: 300px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <img src="../uploads/candon pic/eco/7.PNG" class="card-img-top" alt="Attractions" style="width: 100%; height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-map"></i> Attractions</h5>
                <p class="card-text">Discover the beauty and history of Candon City's attractions.</p>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle w-100" type="button" id="attractionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Explore
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="attractionsDropdown">
                        <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php"><i class="bi bi-people"></i> Experience Program</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Hotels Card -->
        <div class="card" style="flex: 1 1 calc(100% - 40px); max-width: 300px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <img src="../uploads/candon pic/stay/1.PNG" class="card-img-top" alt="Hotels" style="width: 100%; height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-building"></i> Hotels</h5>
                <p class="card-text">Find the best accommodations for your stay in Candon City.</p>
                <a href="/project-study/hotels/hotels.php" class="btn btn-primary w-100">Explore Hotels</a>
            </div>
        </div>

        <!-- Restaurants Card -->
        <div class="card" style="flex: 1 1 calc(100% - 40px); max-width: 300px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <img src="../uploads/candon pic/where to eat/Screenshot 2025-03-28 101708.png" class="card-img-top" alt="Restaurants" style="width: 100%; height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-shop"></i> Restaurants</h5>
                <p class="card-text">Savor the flavors of Candon City's finest restaurants.</p>
                <a href="/project-study/resto/restaurants.php" class="btn btn-primary w-100">Explore Restaurants</a>
            </div>
        </div>

        <!-- Events Card -->
        <div class="card" style="flex: 1 1 calc(100% - 40px); max-width: 300px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <img src="../uploads/events.jpg" class="card-img-top" alt="Events" style="width: 100%; height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calendar-event"></i> Events</h5>
                <p class="card-text">Stay updated on the latest events happening in Candon City.</p>
                <a href="/project-study/events/events.php" class="btn btn-primary w-100">View Upcoming Events</a>
            </div>
        </div>
    </section>

    <section id="history" class="section" style="padding: 60px 20px; background-color: #f8f9fa; text-align: center; margin-bottom: 20px; transition: transform 0.3s, box-shadow 0.3s;">
        <h2 style="font-size: 2.5rem; font-weight: bold; color: #343a40; margin-bottom: 20px;">History of Candon City</h2>
        <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <p style="font-size: 1.2rem; line-height: 1.6; color: #6c757d;">
                    Candon City, known as the "Tobacco Capital of the Philippines," has a rich history dating back to the Spanish colonial era. 
                    It is famous for its vibrant culture, historical landmarks, and contributions to the country's tobacco industry. 
                    The city's name is derived from the "kandong" tree, which played a significant role in its early history.
                </p>
            </div>
            <div style="flex: 1; min-width: 300px;">
                <img src="../uploads/Screen-Shot-2022-11-28-at-10.02.15-PM.png" alt="History of Candon City" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
            </div>
        </div>
    </section>

    <section id="contact" class="section" style="padding: 60px 20px; background-color: #f8f9fa; text-align: center; margin-bottom: 20px; transition: transform 0.3s, box-shadow 0.3s;">
        <h2 style="font-size: 2.5rem; font-weight: bold; color: #343a40; margin-bottom: 20px;">San Juan de Sahagun Church</h2>
        <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap; width: 100%;">
            <div style="flex: 1; min-width: 300px;">
                <img src="../uploads/candon pic/church/1.PNG" alt="San Juan de Sahagun Church" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
            </div>
            <div style="flex: 1; min-width: 300px;">
                <p style="font-size: 1.2rem; line-height: 1.6; color: #6c757d; margin-bottom: 30px;">
                    Discover the beauty and history of the San Juan de Sahagun Church, a modern architectural marvel that blends tradition with contemporary design. 
                    Located in the heart of Candon City, this iconic landmark is a must-visit for history enthusiasts and architecture lovers alike.
                </p>

            </div>
        </div>
    </section>
<!-- Poem of Lam-ang Section -->
<section id="poem" class="section" style="padding: 60px 20px; background-color: #f0f4f8; text-align: center; margin-bottom: 20px; transition: transform 0.3s, box-shadow 0.3s;">
    <h2 style="font-size: 2.5rem; font-weight: bold; color: #343a40; margin-bottom: 20px;">The Poem of Lam-ang</h2>
    <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <p style="font-size: 1.2rem; line-height: 1.6; color: #6c757d;">
                The epic of Lam-ang is a famous Ilocano epic that tells the story of a legendary hero. 
                It narrates his extraordinary adventures, his love for Ines Kannoyan, and his bravery in facing challenges. 
                This timeless tale reflects the rich culture and traditions of the Ilocano people.
            </p>
        </div>
        <div style="flex: 1; min-width: 300px;">
            <img src="../uploads/lam-ang.jpg" alt="Poem of Lam-ang" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
        </div>
    </div>
</section>
<!-- Local Products Section -->
<section id="local-products" class="section" style="padding: 60px 20px; background-color: #f8f9fa; text-align: center; margin-bottom: 20px; transition: transform 0.3s, box-shadow 0.3s;">
    <h2 style="font-size: 2.5rem; font-weight: bold; color: #343a40; margin-bottom: 20px;">Local Products of Candon City</h2>
    <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px; text-align: center;">
            <img src="../uploads/liveli/a.png" alt="Tobacco" style="width: 300px; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
            <h3 style="margin-top: 10px; font-size: 1.5rem; color: #343a40;">Tobacco</h3>
            <p style="font-size: 1.2rem; line-height: 1.6; color: #6c757d;">Candon City is renowned as the "Tobacco Capital of the Philippines," producing high-quality tobacco products.</p>
        </div>
        <div style="flex: 1; min-width: 300px; text-align: center;">
            <img src="../uploads/kalamay1.jpg" alt="Kalamay" style="width: 300px; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
            <h3 style="margin-top: 10px; font-size: 1.5rem; color: #343a40;">Kalamay</h3>
            <p style="font-size: 1.2rem; line-height: 1.6; color: #6c757d;">A sweet delicacy made from glutinous rice, coconut milk, and sugar, Kalamay is a must-try treat in Candon City.</p>
        </div>
    </div>
</section>
<!-- Footer -->
<footer style="display: flex; justify-content: space-around; align-items: center; padding: 20px; background-color: #d3d3d3; color: black;">
<div style="text-align: center; flex: 1;">
    <img src="../uploads/Coat_of_arms_of_the_Philippines.svg.png" alt="Philippine Coat of Arms" style="width: 100px;">
    <p><strong>REPUBLIC OF THE PHILIPPINES</strong></p>
    <p>All content is in the public domain unless otherwise stated.</p>
    <p><a href="#" style="color: black;"><i class="bi bi-shield-lock"></i> Privacy Policy</a></p>
</div>
<div style="text-align: center; flex: 1;">
    <p><strong>ABOUT GOVPH</strong></p>
    <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
    <p>
        <a href="#" style="color: black;"><i class="bi bi-journal"></i> Official Gazette</a> | 
        <a href="#" style="color: black;"><i class="bi bi-bar-chart"></i> Open Data Portal</a> | 
        <a href="#" style="color: black;"><i class="bi bi-chat-dots"></i> Send us your feedback</a>
    </p>
</div>
<div style="text-align: center; flex: 1;">
    <p><strong>GOVERNMENT LINKS</strong></p>
    <p>
        <a href="#" style="color: black;"><i class="bi bi-building"></i> Office of the President</a> | 
        <a href="#" style="color: black;"><i class="bi bi-person-badge"></i> Office of the Vice President</a> | 
        <a href="#" style="color: black;"><i class="bi bi-bank"></i> Senate of the Philippines</a> | 
        <a href="#" style="color: black;"><i class="bi bi-house"></i> House of Representatives</a> | 
        <a href="#" style="color: black;"><i class="bi bi-gavel"></i> Supreme Court</a> | 
        <a href="#" style="color: black;"><i class="bi bi-columns-gap"></i> Court of Appeals</a> | 
        <a href="#" style="color: black;"><i class="bi bi-scales"></i> Sandiganbayan</a>
    </p>
</div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add hover effects for sections
        document.querySelectorAll('.section').forEach(section => {
            section.addEventListener('mouseover', () => {
                section.style.transform = 'scale(1.02)';
                section.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
            });
            section.addEventListener('mouseout', () => {
                section.style.transform = 'scale(1)';
                section.style.boxShadow = 'none';
            });
        });

        // Add hover effects for images
        document.querySelectorAll('.section img').forEach(img => {
            img.addEventListener('mouseover', () => {
                img.style.transform = 'scale(1.05)';
            });
            img.addEventListener('mouseout', () => {
                img.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
