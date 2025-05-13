<?php
include 'config.php';
//FIX
$eng=$_POST['eng'];
$mat=$_POST['mat'];
$date=$_POST['date'];
$ide=$_POST['ide'];


$id = $_POST['id'];

echo $id;


$result=mysqli_query($con, "SELECT * FROM diaxeiristes WHERE id='$id';");
var_dump($result);
if ($result->num_rows > 0){
    $data = mysqli_fetch_array($result); 
    session_start();
    $_SESSION['u2'] = $data;
    
    $res = mysqli_query($con, "UPDATE errors SET material='$mat', engineer='$eng', day_service='$date' WHERE ide=$ide");     
if($res){   
    header('location: mail.php');
}

}

$res = mysqli_query($con, "UPDATE errors SET material='$mat', engineer='$eng', day_service='$date' WHERE ide=$ide");     
if($res){   
    header('location: mail.php');
}

?>