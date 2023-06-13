<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer-5.2.28/src/Exception.php';
require 'php/PHPMailer-5.2.28/src/PHPMailer.php';
require 'php/PHPMailer-5.2.28/src/SMTP.php';




$mail = new PHPMailer(true);
$mail_subject = 'Elegant Interior Lead';
$mail_to_email = 'nabanita@elegantinterior.info'; // your email nabanita@elegantinterior.info
$mail_to_name = 'Webmaster';

 //$mail->SMTPDebug = 3;  Enable verbose debug output



try {
    

	$mail_from_email = isset( $_POST['email'] ) ? $_POST['email'] : '';
	$mail_from_name = isset( $_POST['first-name'] ) ? $_POST['first-name'] : '';
	$mail_last_name = isset( $_POST['last-name'] ) ? $_POST['last-name'] : '';
	$mail_number = isset( $_POST['phone_number'] ) ? $_POST['phone_number'] : '';
    $mail_number = isset( $_POST['phone_number'] ) ? $_POST['phone_number'] : '';
    
    $property_type = array(1 => "Commercial", 2 => "Residential");
    $property_type_var = $property_type[(int) $_POST['property_type']];
    // $property_type_var will have your selected property_type
    
     $property_size = array(1 => "500-600sqft", 2 => "600-1000sqft", 3 => "1000-1500sqft", 4 => "1500-2000sqft", 5 => "2000+sqft");
    $property_size_var = $property_size[(int) $_POST['property_size']];
    // $property_size_var will have your selected property_size
    
    $budget = array(1 => "1Lakh - 3Lakhs", 2 => "3Lakhs - 5Lakhs", 3 => "5Lakhs - 10Lakhs", 4 => "10Lakhs - 20Lakhs", 5 => "20Lakhs - 30Lakhs", 6 => "30Lakhs+" );
    $budget_var = $budget[(int) $_POST['budget']];
    // $budget_var_var will have your selected budget
    
      $requirement_type = array(1 => "Full Interior Design", 2 => "Bedroom", 3 => "Living Room", 4 => "Office", 5 => "Kids Room", 6 => "Garden", 7 => "Custom" );
    $requirement_type_var = $requirement_type[(int) $_POST['requirement_type']];
    // $requirement_type_var will have your selected requirement_type
    

	// Server settings
	//	$mail->isSMTP();   Send using SMTP --disable this for godaddy server, enable for localhost
    
	$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'thevisiondelta@gmail.com'; // SMTP username
	$mail->Password = 'Vision@999'; // SMTP password
	$mail->SMTPSecure = tls; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged --- Working with tls
	$mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above --- Working with 587
	

	$mail->setFrom($mail_to_email, $mail_to_name); // Your email
	$mail->addAddress($mail_to_email, $mail_from_name); // Add a recipient
    $mail->addCC('ssensarma@gmail.com');
    $mail->addCC('maxelegantinterior@gmail.com');
    $mail->addBCC('rajeshbangal93@gmail.com');
    $mail->addBCC('thevisiondelta@gmail.com');
//    $mail->addCC('ssensarma@gmail.com', 'maxelegantinterior@gmail.com');
//    $mail->addBCC('thevisiondelta@gmail.com', 'rajeshbangal93@gmail.com');

//	for($ct=0; $ct<count($_FILES['file_attach']['tmp_name']); $ct++)    {
//        
//		$mail->AddAttachment($_FILES['file_attach']['tmp_name'][$ct], $_FILES['file_attach']['name'][$ct]);
//	}
    
        if(!empty($_FILES) && !empty($_FILES['fileToUpload'])) {
        $mail->AddAttachment($_FILES['fileToUpload']['tmp_name'],
        $_FILES['fileToUpload']['name']);
        }
    


	// Content
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = $mail_subject;
	$mail->Body = '
        <strong>First Name:</strong> ' . $mail_from_name . '<br>
		<strong>Last Name:</strong> ' . $mail_last_name . '<br>
		<strong>Email:</strong> ' . $mail_from_email . '<br>
		<strong>Contact No:</strong> ' . $mail_number. '<br>
        <strong>Property Type</strong> ' . $property_type_var.  '<br>
        <strong>Property Size</strong> ' . $property_size_var. '<br>
        <strong>Total Budget</strong> ' . $budget_var. '<br>
        <strong>Requirement Type</strong> ' . $requirement_type_var;
    

	$mail->Send();

//	echo 'Message has been sent';
    header("Location:thankyou.php");
    exit();

} catch (Exception $e) {

	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

}