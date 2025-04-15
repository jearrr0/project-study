<?php
function renderNav() {
    ?>
<!-- Navigation Bar -->
<nav class="navbar bg-body-tertiary fixed-top" style="padding: 1.5rem 1rem;">
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <!-- Logo -->
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
            <img src="../uploads/home/candon-logo.png" alt="CandonXplore Logo" style="height: 50px; margin-right: 10px;">
            <span style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 1.5rem; background: linear-gradient(90deg, #007bff, #00c6ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                CandonXplore
            </span>
        </a>
        <!-- Centered navigation -->
        <div class="d-none d-lg-flex justify-content-center flex-grow-1">
            <ul class="navbar-nav" style="flex-direction: row; gap: 1.5rem; font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 500;">
                <li class="nav-item">
                    <a class="nav-link" href="/project-study/main/home.php" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"><i class="bi bi-house-door"></i> Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="placesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
                        <i class="bi bi-map"></i> Places
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="placesDropdown" style="position: absolute;">
                        <li><a class="dropdown-item" href="../attractions/pages/historical-tourist-sites.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/ancestral_houses.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-people"></i> Experience Program</a></li>
                        <li><a class="dropdown-item" href="../attractions/pages/restaurants.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-shop"></i> Restaurants</a></li>
                        <li><a class="dropdown-item" href="/project-study/hotels/hotels.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-building"></i> Hotels</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-bag"></i> Shopping and Pasalubong</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
                        <i class="bi bi-tools"></i> Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown" style="position: absolute;">
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-bus-front"></i> Transport Services</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-cash-coin"></i> Banking and Finance</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-hospital"></i> Hospitals</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-heart-pulse"></i> Health and Personal Care</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-shop-window"></i> Convenience Store</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-fuel-pump"></i> Gas Stations and Auto Services</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-book"></i> Books/Schools/Art Supplies</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-hammer"></i> Hardware</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-tv"></i> Appliance Store</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-cart"></i> Grocery Stores and Supermarkets</a></li>
                        <li><a class="dropdown-item" href="#" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-capsule"></i> Pharmacy and Drug Stores</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="experienceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
                        <i class="bi bi-emoji-smile"></i> Experience
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="experienceDropdown" style="position: absolute;">
                        <li><a class="dropdown-item" href="/project-study/experience/experience.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-emoji-smile"></i> Experience</a></li>
                        <li><a class="dropdown-item" href="/project-study/events/events.php" style="font-family: 'Poppins', sans-serif; font-size: 1rem;"><i class="bi bi-calendar-event"></i> Events</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/project-study/includes/bulletin.php" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"><i class="bi bi-newspaper"></i> Bulletin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/project-study/includes/contact.php" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"><i class="bi bi-envelope"></i> Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/project-study/profile/profile.php" style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"><i class="bi bi-person"></i> Profile</a>
                </li>
            </ul>
        </div>
        <!-- Hamburger menu for smaller screens -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">CandonXplore</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body text-center">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/main/home.php"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="placesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-map"></i> Places
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="placesDropdown">
                            <li><a class="dropdown-item" href="/project-study/attractions/pages/historical-tourist-sites.php"><i class="bi bi-bank"></i> Historical Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/natural_tourist_sites.php"><i class="bi bi-tree"></i> Natural Tourist Sites</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/recreational-facilities.php"><i class="bi bi-basket"></i> Recreational Facilities</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/livelihoods.php"><i class="bi bi-briefcase"></i> Livelihoods</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/ancestral_house.php"><i class="bi bi-house"></i> Ancestral Houses</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/experienceprogram.php"><i class="bi bi-people"></i> Experience Program</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/restaurants.php"><i class="bi bi-shop"></i> Restaurants</a></li>
                            <li><a class="dropdown-item" href="../attractions/pages/hotels.php"><i class="bi bi-building"></i> Hotels</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bag"></i> Shopping and Pasalubong</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tools"></i> Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bus-front"></i> Transport Services</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cash-coin"></i> Banking and Finance</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-hospital"></i> Hospitals</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-heart-pulse"></i> Health and Personal Care</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-shop-window"></i> Convenience Store</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-fuel-pump"></i> Gas Stations and Auto Services</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-book"></i> Books/Schools/Art Supplies</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-hammer"></i> Hardware</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-tv"></i> Appliance Store</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cart"></i> Grocery Stores and Supermarkets</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-capsule"></i> Pharmacy and Drug Stores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="experienceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-emoji-smile"></i> Experience
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="experienceDropdown">
                            <li><a class="dropdown-item" href="/project-study/experience/experience.php"><i class="bi bi-emoji-smile"></i> Experience</a></li>
                            <li><a class="dropdown-item" href="/project-study/events/events.php"><i class="bi bi-calendar-event"></i> Events</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/includes/bulletin.php"><i class="bi bi-newspaper"></i> Bulletin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/includes/contact.php"><i class="bi bi-envelope"></i> Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-study/profile/profile.php"><i class="bi bi-person"></i> Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
    <?php
}

function renderHero() {
    ?>
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" style="position: relative; overflow: hidden;">
        <div class="carousel-inner">
            <?php
            $slides = [
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Welcome to Candon", "subtitle" => "Your gateway to rich culture and heritage."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Historical Tourist Sites", "subtitle" => "Walk through Candon’s proud past."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Natural Tourist Sites", "subtitle" => "Discover Candon’s natural beauty."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Recreational Facilities", "subtitle" => "Fun and relaxation for everyone."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Livelihoods", "subtitle" => "Experience Candon’s creative economy."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Ancestral Houses", "subtitle" => "See timeless architecture preserved."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Experience Program", "subtitle" => "Be part of Candon’s immersive experiences."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Restaurants", "subtitle" => "Taste Candon’s best flavors."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Hotels", "subtitle" => "Stay in comfort while exploring."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Local Experience", "subtitle" => "Live like a local in Candon City."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Bulletin", "subtitle" => "Latest news and updates."],
                ["src" => "/project-study/uploads/candon%20pic/where%20to%20eat/Screenshot%202025-03-28%20101708.png", "title" => "Contact Us", "subtitle" => "We’d love to hear from you."]
            ];
            foreach ($slides as $index => $slide) {
                $activeClass = $index === 0 ? "active" : "";
                echo "
                <div class='carousel-item $activeClass'>
                    <div style='position: relative; height: 600px; background: url({$slide['src']}) center/cover no-repeat;'>
                        <div class='carousel-caption d-flex flex-column align-items-center justify-content-center' style='background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;'>
                            <h1 class='fw-bold display-4 text-white'>{$slide['title']}</h1>
                            <p class='lead text-white'>{$slide['subtitle']}</p>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="filter: invert(1);">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="filter: invert(1);">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-indicators" style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);">
            <?php foreach ($slides as $index => $slide) { ?>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>" style="width: 10px; height: 10px; border-radius: 50%; background-color: white; border: none; margin: 0 5px;"></button>
            <?php } ?>
        </div>
    </div>
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

function renderChatbot() {
    ?>
    <!-- Floating Chatbot -->
    <div id="chatbot-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050; cursor: grab;">
        <button id="chatbot-toggle" style="background-color: #007bff; color: white; border: none; border-radius: 50%; width: 60px; height: 60px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1051;">
            <i class="bi bi-chat-dots" style="font-size: 1.5rem;"></i>
        </button>
        <div id="chatbot-window" style="display: none; position: absolute; bottom: 80px; right: 0; width: 300px; height: 400px; background: white; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden; z-index: 1050;">
            <div style="background: #007bff; color: white; padding: 10px; text-align: center; font-family: 'Poppins', sans-serif; font-weight: bold;">
                Chat with Eric
            </div>
            <div id="chatbot-messages" style="padding: 10px; height: 300px; overflow-y: auto; font-family: 'Poppins', sans-serif; font-size: 0.9rem;">
                <p style="margin: 0; padding: 5px; background: #f1f1f1; border-radius: 5px;">Hi! I'm Eric. How can I assist you today?</p>
            </div>
            <div style="display: flex; padding: 10px; border-top: 1px solid #ddd;">
                <input type="text" id="chatbot-input" placeholder="Type a message..." style="flex: 1; padding: 5px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Poppins', sans-serif;">
                <button id="chatbot-send" style="background-color: #007bff; color: white; border: none; border-radius: 5px; padding: 5px 10px; margin-left: 5px;">Send</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotWindow = document.getElementById('chatbot-window');
            const chatbotContainer = document.getElementById('chatbot-container');
            const chatbotSend = document.getElementById('chatbot-send');
            const chatbotInput = document.getElementById('chatbot-input');
            const chatbotMessages = document.getElementById('chatbot-messages');
            let isDragging = false, offsetX = 0, offsetY = 0;

            // Toggle chatbot window visibility
            chatbotToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                chatbotWindow.style.display = chatbotWindow.style.display === 'none' || chatbotWindow.style.display === '' ? 'block' : 'none';
            });

            // Drag-and-drop functionality
            chatbotContainer.addEventListener('mousedown', function (e) {
                isDragging = true;
                offsetX = e.clientX - chatbotContainer.getBoundingClientRect().left;
                offsetY = e.clientY - chatbotContainer.getBoundingClientRect().top;
                chatbotContainer.style.cursor = 'grabbing';
            });

            document.addEventListener('mousemove', function (e) {
                if (isDragging) {
                    chatbotContainer.style.left = `${e.clientX - offsetX}px`;
                    chatbotContainer.style.top = `${e.clientY - offsetY}px`;
                    chatbotContainer.style.right = 'auto'; // Reset right to allow free movement
                    chatbotContainer.style.bottom = 'auto'; // Reset bottom to allow free movement
                }
            });

            document.addEventListener('mouseup', function () {
                isDragging = false;
                chatbotContainer.style.cursor = 'grab';
            });

            // Prevent chatbot toggle from triggering drag
            chatbotToggle.addEventListener('mousedown', function (e) {
                e.stopPropagation();
            });

            // Handle sending messages
            chatbotSend.addEventListener('click', function () {
                const message = chatbotInput.value.trim();
                if (message !== '') {
                    // Append user message
                    const userMessage = document.createElement('p');
                    userMessage.style.margin = '0';
                    userMessage.style.padding = '5px';
                    userMessage.style.background = '#007bff';
                    userMessage.style.color = 'white';
                    userMessage.style.borderRadius = '5px';
                    userMessage.style.textAlign = 'right';
                    userMessage.textContent = message;
                    chatbotMessages.appendChild(userMessage);
                    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

                    // Clear input field
                    chatbotInput.value = '';

                    // Simulate chatbot response
                    setTimeout(() => {
                        const botMessage = document.createElement('p');
                        botMessage.style.margin = '0';
                        botMessage.style.padding = '5px';
                        botMessage.style.background = '#f1f1f1';
                        botMessage.style.borderRadius = '5px';
                        botMessage.textContent = "I'm here to help!";
                        chatbotMessages.appendChild(botMessage);
                        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                    }, 1000);
                }
            });

            // Allow pressing Enter to send messages
            chatbotInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    chatbotSend.click();
                }
            });
        });
    </script>
    <?php
}

renderChatbot();
?>
