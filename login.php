<?php 
include 'config.php';

$mail = $_POST['email']; 
$pass = $_POST['password']; 
$type = $_POST['type'];

if ($type == "super") {
    $stmt = $con->prepare("SELECT * FROM diaxeiristes WHERE email=? AND password=? AND type='super'");
} elseif ($type == "elevator") {
    $stmt = $con->prepare("SELECT * FROM company WHERE email=? AND password=? AND type='elevator'");
} elseif ($type == "admin") {
    $stmt = $con->prepare("SELECT * FROM company WHERE email=? AND password=? AND type='admin'");
}

$stmt->bind_param("ss", $mail, $pass);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    session_start();
    
    if ($type == "admin") {
        // get the user data and log in directly without unique_id for admin type
        $data = $res->fetch_assoc();
        $_SESSION['user'] = $data;
        header('location: profile.php');
    } else {
        // hash the password to check users table.
        $hashed_pass = md5($pass);

        // Get the unique_id 
        $stmt2 = $con->prepare("SELECT unique_id FROM users WHERE email=? AND password=?");
        $stmt2->bind_param("ss", $mail, $hashed_pass);
        $stmt2->execute();
        $res2 = $stmt2->get_result();

        if ($data2 = $res2->fetch_assoc()) {
            $unique_id = $data2['unique_id'];
            $data = $res->fetch_assoc();
            $_SESSION['user'] = $data;
            $_SESSION['unique_id'] = $unique_id;
            header('location: profile.php');
        } else {
            // Handle the case where unique_id is not found
            header('location: index.php');
            exit();
        }
    }
} else {
    header('location: index.php');
}
?>
