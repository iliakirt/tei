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
            background: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                include 'config.php';
                if (isset($_POST['save'])){
                    $name = $_POST['name_company'];
                    $adr = $_POST['address'];
					$phone = $_POST['phone'];
                    $mail = $_POST['email'];
                    $idc = $_POST['idc'];
                    $res = mysqli_query($con, "UPDATE company SET name_company = '$name', address = '$adr', phone = '$phone', email = '$mail', type = 'elevator' WHERE idc = '$idc'");
                    if ($res) { 
                        echo '<script> alert("Ενημερώθηκε"); </script>';
                        header('Location: profile.php');
                     } else { 
                        echo '<script> alert("Σφάλμα"); </script>';
                        header('Location: profile.php');
                         }     
                 } 
                if (isset($_POST['delete'])){
                    $idc = $_POST['idc'];
                    $res = mysqli_query($con, "DELETE FROM company WHERE idc='$idc'");
                    if ($res) {
                        echo '<script> alert("Διαγράφηκε"); </script>';
                        header('Location: profile.php');
                     } else { 
                        echo '<script> alert("Σφάλμα"); </script>';
                        header('Location: profile.php');
                     } 
                 } ?>
            </div>
        </div>
    </div>
</body>
</html>