<?php 
include 'config.php';
$type = $_POST['utype'];

if($type=="super"){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $addr = $_POST['address'];

    $res = mysqli_query($con, "UPDATE diaxeiristes SET fullname = '$name', 
        email = '$email', phone = '$phone', address = '$addr' WHERE id=$id");
    $res= mysqli_query($con, "UPDATE users SET fname = '$name', email = '$email' WHERE id = '$id' AND lname = 'super'");    
      
      $r = mysqli_query($con, "SELECT * FROM diaxeiristes WHERE id=$id");
        var_dump($r);
if ($r->num_rows > 0){
    $data = mysqli_fetch_array($r); 
    session_start();
    $_SESSION['user'] = $data;
        header('location: profile.php');
}
}else {
    $idc = $_POST['idc'];
    $name_company = $_POST['name_company'];  
    $email = $_POST['email'];   
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $res = mysqli_query($con, "UPDATE company SET name_company='$name_company', 
    email='$email',phone='$phone', address='$address' WHERE idc=$idc");
    $res= mysqli_query($con, "UPDATE users SET fname = '$name_company', email = '$email' WHERE id = '$idc' AND lname = 'elevator'");
     
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