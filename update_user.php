<?php 
include 'config.php';
$type = $_GET['type'];

if($type=="super"){

    $uid = $_GET['uid'];
    $uname = $_GET['uname'];
    $uphone = $_GET['uphone'];
    $uemail = $_GET['uemail'];
    $uaddr = $_GET['uaddress'];

    $res = mysqli_query($con, "UPDATE diaxeiristes SET fullname='$uname', 
        email='$uemail',phone='$uphone', address='$uaddr' WHERE id=$uid");
      
      $r = mysqli_query($con, "SELECT * FROM diaxeiristes WHERE id=$uid");
        var_dump($r);
if ($r->num_rows > 0){
    $data = mysqli_fetch_array($r); 
    session_start();
    $_SESSION['user'] = $data;
        header('location: profile.php');
}
}else {
    $idc = $_GET['idc'];
    $name_company = $_GET['name_company'];  
    $email = $_GET['email'];   
    $phone = $_GET['phone'];
    $address = $_GET['address'];

    $res = mysqli_query($con, "UPDATE company SET name_company='$name_company', 
    email='$email',phone='$phone', address='$address' WHERE idc=$idc");
     
     $r = mysqli_query($con, "SELECT * FROM company WHERE idc=$idc");
      var_dump($r);
if ($r->num_rows > 0){
  $data = mysqli_fetch_array($r); 
  session_start();
  $_SESSION['user'] = $data;
      header('location: profile.php');
}
}


?>