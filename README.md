🏕️ CandonXplore - Tourism Hub for Candon City

CandonXplore is a comprehensive tourism hub showcasing hotels, restaurants, attractions, and events in Candon City, Ilocos Sur. It provides users with an interactive platform to explore, rate, and review various destinations, helping tourists make informed travel decisions.

🌟 Features

✅ Hotels & Accommodations

View detailed information about hotels, including images, location, and contact details.

Rate hotels using a 5-star rating system.

View the average rating of each hotel based on user reviews.

Get real-time directions to hotels using the shortest path algorithm via Google Maps API.

🍽️ Restaurants & Dining

Browse top-rated restaurants in Candon City.

View restaurant details, including menu, location, and ratings.

Get real-time directions to restaurants.

🎭 Tourist Attractions & Events

Discover historical sites, cultural landmarks, and recreational facilities.

Stay updated with upcoming events in Candon City.

Use real-time navigation to find attractions efficiently.

📊 Analytics & Insights (Admin Dashboard)

Top-rated hotels & restaurants.

Most searched attractions.

User engagement trends & ratings analysis.

Booking trends & seasonal insights.

🏠 Installation & Setup

🔹 1. Clone the Repository

git clone https://github.com/jearrr0/project-study.git
cd CandonXplore

🔹 2. Database Setup

Import the candonxplore_db.sql file into MySQL.

Ensure that the following tables exist:

users (Stores registered users)

hotels (Stores hotel information)

restaurants (Stores restaurant details)

attractions (Stores tourist spots)

events (Stores city events)

hotel_ratings (Stores hotel reviews & ratings)

🔹 3. Configure Database Connection

Modify dbconnect.php to match your MySQL credentials:

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "candonxplore_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

🔹 4. Start the Server

Run a local server using XAMPP or MAMP and place the project in the htdocs folder.Then, access the project via:

http://localhost/CandonXplore

🚀 Usage Guide

1️⃣ Browsing Hotels & Restaurants

Visit the Hotels and Restaurants sections to view available places.

Click on a hotel/restaurant to view details and ratings.

2️⃣ Rating a Hotel

Click the "Rate" button under a hotel listing.

Choose a rating from 1 to 5 stars.

The system updates the average rating dynamically.

3️⃣ Searching for Attractions

Use the search bar to find specific places in Candon City.

Filter results by category, location, or rating.

Click "Get Directions" to find the shortest path using Google Maps API.

4️⃣ Viewing Events

Check the Events section for upcoming city events.

See event descriptions, schedules, and locations.

Use the directions feature to navigate to events.

⚙️ Technologies Used

Frontend: HTML, CSS, Bootstrap, JavaScript

Backend: PHP (Vanilla PHP)

Database: MySQL

Charting & Analytics: Chart.js (for admin insights)

Maps & Directions: Google Maps API (for shortest path navigation)

🔒 Admin Panel (Optional)

If your system includes an admin dashboard, log in using:

Username: admin  
Password: admin123  

Admin users can manage hotels, restaurants, events, user reviews, and analytics.

📈 Future Enhancements (Planned Features)

✅ User Bookings & Reservations (Allow users to book hotels)

✅ AI-Powered Recommendations (Suggest hotels based on user behavior)

✅ Google Maps Integration (Show real-time directions to attractions)

✅ Multi-language Support (Support for English & Filipino)

💎 Support & Contact

For any issues or suggestions, contact:📩 Email: support@candonxplore.com🌐 Website: www.candonxplore.com

Developed with ❤️ by Team Atlas

