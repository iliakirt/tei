<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin: 2em auto;
        }

        input {
            margin-bottom: .5em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                include 'config.php';

                if ($_POST['type_admin']=='admin'){
                $name = $_POST['full'];
                $adr = $_POST['address'];
				$phone = $_POST['phone'];
                $mail = $_POST['email'];
                $pass = $_POST['pass'];
                $tp = $_POST['type'];

                $res = mysqli_query($con, "INSERT INTO company VALUES (null, '$name', '$adr', '$phone', '$mail', '$pass', '$tp')");

                //chatapp
                $r = mysqli_query($con, "SELECT * FROM company WHERE email='$mail' AND password='$pass'");
                $id = mysqli_fetch_array($r);
                $idapp = $id['idc'];

                $ran_id = rand(time(), 100000000);
                $status = "Active now";
                $encrypt_pass = md5($pass);
                $insert_query = mysqli_query($con, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, id)
                VALUES ({$ran_id}, '{$name}','elevator', '{$mail}', '{$encrypt_pass}', 'null', '{$status}', '{$idapp}')");
                if($insert_query){
                    $select_sql2 = mysqli_query($con, "SELECT * FROM users WHERE email = '{$mail}'");
                    if(mysqli_num_rows($select_sql2) > 0){
                        $result = mysqli_fetch_assoc($select_sql2);
                        $_SESSION['unique_id'] = $result['unique_id'];
                        echo "success";
                    }else{
                        echo "This email address not Exist!";
                    }
                }else{
                    echo "Something went wrong. Please try again!";
                }//chatapp

                if ($res) { 
                    echo '<script> alert("Καταχωρήθηκε"); </script>';
                    header('Location: profile.php');
                 } else { 
                    echo '<script> alert("Δεν Καταχωρήθηκε"); </script>';
                 }
                 }elseif ($_POST['type_admin']=='elevator'){
                $idc = $_POST['idc'];    
                $name = $_POST['full'];
                $adr = $_POST['address'];
				$phone = $_POST['phone'];
                $mail = $_POST['email'];
                $pass = $_POST['pass'];

                $r = mysqli_query($con, "INSERT INTO diaxeiristes VALUES (null, '$name', '$adr', '$phone', '$mail', '$pass','$idc', 'super')");
                
                $sql_chatidc=mysqli_query($con, "SELECT * FROM company WHERE idc='$idc'");
                $email_chat = mysqli_fetch_array($sql_chatidc);
                
                //chatapp
                $rs = mysqli_query($con, "SELECT * FROM diaxeiristes WHERE email='$mail' AND password='$pass'");
                $id = mysqli_fetch_array($rs);
                $idapp = $id['id'];

                $ran_id = rand(time(), 100000000);
                $status = "Active now";
                $encrypt_pass = md5($pass);
                $insert_query = mysqli_query($con, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, id)
                VALUES ({$ran_id}, '{$name}','super', '{$mail}', '{$encrypt_pass}', '{$email_chat['email']}', '{$status}', '{$idapp}')");
                if($insert_query){
                    $select_sql2 = mysqli_query($con, "SELECT * FROM users WHERE email = '{$mail}'");
                    if(mysqli_num_rows($select_sql2) > 0){
                        $result = mysqli_fetch_assoc($select_sql2);
                        $_SESSION['unique_id'] = $result['unique_id'];
                        echo "success";
                    }else{
                        echo "This email address not Exist!";
                    }
                }else{
                    echo "Something went wrong. Please try again!";
                }//chatapp

                if ($r) { 
                    echo '<script> alert("Καταχωρήθηκε"); </script>';
                    header('Location: profile.php');
                 } else { 
                    echo '<script> alert("Δεν Καταχωρήθηκε"); </script>';
                 }

                 } 
                 ?>
            </div>
        </div>
    </div>
</body>


</html>