<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $website = isset($_POST['website']) ? htmlspecialchars(trim($_POST['website'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (!empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $receiver = "kavindathimash0@gmail.com";
            $subject = "From: $name <$email>"; 
            $body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage: $message\n\nRegards,\n$name";

            $headers = "From: $name <$email>\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            if (mail($receiver, $subject, $body, $headers)) {
                echo "Your message has been sent successfully!";
            } else {
                echo "Sorry, failed to send your message!";
            }
        } else {
            echo "Enter a valid email address!";
        }
    } else {
        echo "Email and message fields are required!";
    }
} else {
    echo "Form not submitted.";
}
?>
