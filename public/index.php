<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/validate.php';

$name = '';
$email = '';
$message = '';
$errors = [];
 
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name    = is_string($_POST['name'] ?? null) ? trim($_POST['name']) : '';
    $email   = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
    $message = is_string($_POST['message'] ?? null) ? trim($_POST['message']) : '';
 
    if (!validate_required($name) || !validate_length($name, 2, 60)) {
        $errors['name'] = 'Name is required (2-60 characters).';
    }
    if (!validate_email($email)) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if (!validate_required($message) || !validate_length($message, 10, 1000)) {
        $errors['message'] = 'Message is required (10-1000 characters).';
    }
     if (!$errors) {
        header('Location: index.php?success=1', true, 303);
        exit;
    }
}
 
$success = isset($_GET['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <!-- TODO: render the form, inline errors, and repopulated values -->
  <form method="post" action="index.php">
    <label>Name <input type="text" name="name"></label><br>
    <label>Email <input type="email" name="email"></label><br>
    <label>Message <textarea name="message"></textarea></label><br>
    <button type="submit">Send</button>
  </form>
</body>
</html>
