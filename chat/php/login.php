<?php 
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            //$user_pass = md5($password);
            $enc_pass = $row['password'];
            if($password === $enc_pass){
                $status = "Active now";
                $sql2 = mysqli_query($con, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    //echo "success";
                    header("location: ../users.php");
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "Email or Password is Incorrect!";
                echo $password."  ".$enc_pass;
            }
        }else{
            echo "$email - This email not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>