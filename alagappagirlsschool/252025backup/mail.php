<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form fields
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $number = htmlspecialchars(trim($_POST['number']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($number) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Email content
    $to = "seraphimtechnology@gmail.com"; // Replace with your email
    $subject = "New Admission Application from $firstname";
    $email_content = "You have received a new application:\n\n";
    $email_content .= "Child's Name: $firstname\n";
    $email_content .= "Child's DOB: $lastname\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Location: $number\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Thank you for applying. We will get back to you soon.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your application.";
    }
} else {
    echo "Invalid request.";
}
?>
