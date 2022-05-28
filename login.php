<?php 
include 'config.php';

$mail = $_POST['email']; 
$pass = $_POST['password']; 
$type = $_POST['type'];

if($type=="super"){
$res = mysqli_query($con, "SELECT * FROM diaxeiristes WHERE email='$mail' AND password='$pass'");
}elseif($type=="elevator"){
$res = mysqli_query($con, "SELECT * FROM company WHERE email='$mail' AND password='$pass' AND type='elevator'");
}elseif($type=="admin"){
$res = mysqli_query($con, "SELECT * FROM company WHERE email='$mail' AND password='$pass' AND type='admin'");
}

var_dump($res);
if ($res->num_rows > 0){
    $data = mysqli_fetch_array($res); 
    session_start();
    $_SESSION['user'] = $data;
    header('location: profile.php');
} else {
    
    header('location: index.php');
    
}
?>