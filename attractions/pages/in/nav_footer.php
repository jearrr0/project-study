<?php
function renderNav() {
    ?>
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
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">CandonXplore</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                            <li><a class="dropdown-item" href="../pages/historical-tourist-sites.php"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../pages/natural_tourist_sites.php"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../pages/recreational-facilities.php"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                            <li><a class="dropdown-item" href="../pages/livelihoods.php"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                            <li><a class="dropdown-item" href="../pages/ancestral_houses.php"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                            <li><a class="dropdown-item" href="../pages/experienceprogram.php"><i class="bi bi-people"></i> Experience Program</a></li>
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
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
    <?php
}

function renderFooter() {
    ?>
<head>
    <!-- Add this line to include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- ...existing code... -->
</head>
<footer style="display: flex; justify-content: space-around; align-items: center; padding: 20px; background-color: #f8f9fa; color: black;">
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

    <?php
}
?>
