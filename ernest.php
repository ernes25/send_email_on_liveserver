<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check if fields are filled out properly
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p class="error">Please fill out all fields and provide a valid email address.</p>';
        exit;
    }

    // Set the recipient email address (Change to your email)
    $recipient = "admin@hkknatures.org";
    
    // Set the email subject
    $subject = "New contact from $name";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Set the email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        echo '<p class="success">Thank you! Your message has been sent.</p>';
    } else {
        echo '<p class="error">Oops! Something went wrong, and we couldn’t send your message.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; }
        label { display: block; margin-bottom: 8px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Contact Us</h2>

<form action="" method="POST">
    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Your Email</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Your Message</label>
    <textarea id="message" name="message" rows="5" required></textarea>

    <button type="submit">Send Message</button>
</form>

</body>
</html>
