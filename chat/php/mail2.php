<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/
  
  include 'config.php';
session_start(); 
if (!isset($_SESSION['u5'])){
    header('location: insert-chat.php');
} 
$u5 = $_SESSION['u5'];



//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "esystems516@gmail.com";
//Set gmail password
	$mail->Password = "bxmrxxaqrhwcrygp";
//Email subject
	$mail->Subject = "NEO ΜΗΝΥΜΑ";
//Set sender email
	$mail->setFrom('esystems516@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('img/attachment.png');
//select
$idu=$u5['unique_id'];
$res=mysqli_query($con,"SELECT * FROM users WHERE unique_id='$idu'");
$user = mysqli_fetch_array($res);	
//Email body
	$mail->Body = "<h1>Νέο μήνυμα</h1></br><p>Συνδεθέιτε για να δείτε τα νέα σας μηνύματα!</p>";
//Add recipient
$email=$u5['email'];
$mail->addAddress($email);
	
//Finally send email
	if ( $mail->send() ) {
		echo "Email Sent..!";
	}else{
		echo "Message could not be sent. Mailer Error: ";
	}
//Closing smtp connection
	$mail->smtpClose();
