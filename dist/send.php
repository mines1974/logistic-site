<?php
$destination = "mines1974@gmail.com"; //replace this email address with yours
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$content = "Name: " . $name . "\nEmail: " . $email . "\nMessage: " . $message;
mail($destination,"Contact", $content);
header("Location:thanks.html");
?>