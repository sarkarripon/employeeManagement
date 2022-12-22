<?php
if (!class_exists('PHPMailer\PHPMailer\Exception')) {
    require $_SERVER['DOCUMENT_ROOT'] . '/sarkar/php/Exercise/oopems/PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/sarkar/php/Exercise/oopems/PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/sarkar/php/Exercise/oopems/PHPMailer/src/SMTP.php';
}
date_default_timezone_set('Asia/Dhaka');
$mail = new PHPMailer\PHPMailer\PHPMailer();;
$mail->isSMTP(); // Set PHPMailer to use SMTP.
$mail->SMTPAuth   = true; // //Set this to true if SMTP host requires authentication to send email
$mail->SMTPSecure = 'tls'; ////If SMTP requires TLS encryption then set it
$mail->Host       = 'smtp.gmail.com'; // //Set SMTP host name
$mail->Port       = 587; // //Set TCP port to connect to

// Provide username and password
$mail->Username = 'thisisripon1@gmail.com';
$mail->Password = 'gvskflpkwuqoslyq';

$mail->setFrom('thisisripon1@gmail.com', 'Sarkar Ripon');
