<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer-5.2.28/src/Exception.php';
require 'php/PHPMailer-5.2.28/src/PHPMailer.php';
require 'php/PHPMailer-5.2.28/src/SMTP.php';

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: /index.php');
    exit;
}



$mail = new PHPMailer(true);
$mail_subject = 'MR Group Of Colleges Lead';
$mail_to_email = 'mrgroupadmission@gmail.com';
$mail_to_name = 'Admission';

try {
    
	$mail_from_name = isset( $_POST['name'] ) ? $_POST['name'] : '';
    $mail_from_email = isset( $_POST['email'] ) ? $_POST['email'] : '';
    $mail_from_phone = isset( $_POST['phone'] ) ? $_POST['phone'] : '';
    $mail_from_course = isset( $_POST['course'] ) ? $_POST['course'] : '';
    $mail_from_message = isset( $_POST['message'] ) ? $_POST['message'] : '';

    
	$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'mrgrpofcollege@gmail.com'; // SMTP username
	$mail->Password = 'Raktim365249'; // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged --- Working with tls
	$mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above --- Working with 587
	

	$mail->setFrom($mail_to_email, $mail_to_name); // Your email
	$mail->addAddress($mail_to_email, $mail_from_name); // Add a recipient

    $mail->addCC('rajeshbangal93@gmail.com');
    $mail->addCC('raktimbanerjee9@gmail.com');


	// Content
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = $mail_subject;
	$mail->Body = '
        <strong>Full Name:</strong> ' . $mail_from_name . '<br>
		<strong>Message:</strong> ' . $mail_from_message . '<br>
		<strong>Course:</strong> ' . $mail_from_course . '<br>
		<strong>Contact No:</strong> ' . $mail_from_phone. '<br>
        <strong>Email</strong> ' . $mail_from_email.  '<br>';
    
        $mail->Send();
        header("Location:thankyou.php");
        exit();
}

catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}