<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us</h1>
    <form action="process_contact.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        <br><br>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>
        <br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
