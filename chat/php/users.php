<?php
    session_start();
    include_once "config.php";
    
    $outgoing_id = $_SESSION['unique_id'];

    $sqlc = "SELECT * FROM users WHERE unique_id = {$outgoing_id}";
    $queryc = mysqli_query($con, $sqlc);
    $rowc = mysqli_fetch_array($queryc);
    $emailc=$rowc['email'];
    $img=$rowc['img'];

    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (img = '$emailc' OR email = '$img') ORDER BY user_id DESC";

    $query = mysqli_query($con, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;



 
?>