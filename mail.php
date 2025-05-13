<?php
//PHP MAILER

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
if (!isset($_SESSION['u2'])){
    header('location: fix.php');
} 
$u2 = $_SESSION['u2'];
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
$mail->SMTPDebug = 3;  
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
$mail->Username = "elevatorsystems25@gmail.com";
//Set gmail password
$mail->Password = "xmwssijzsvgriuhr";
//Email subject
$mail->Subject = "Service Update";
//Set sender email
$email55=$u2['email'];
$mail->setFrom($email55);
//Enable HTML
$mail->isHTML(true);
//select
$idc=$u2['idc'];
$res=mysqli_query($con,"SELECT * FROM company WHERE idc='$idc'");
$company = mysqli_fetch_array($res);
//Email body
$mail->Body = "<h1>Aποκατάσταση βλάβης</h1></br><p>Σας ενημερώνουμε ότι η βλάβη σας αποκαταστάθηκε από την </p>";
$mail->Body .=$company['name_company']."!";

//Add recipient
$email=$u2['email'];
$mail->addAddress($email);

//Finally send email
try {
  if ($mail->send()) {
      header('location: profile.php');
  } else {
      echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
  }
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: " . $e->getMessage();
}

//Closing smtp connection
$mail->smtpClose();
?>