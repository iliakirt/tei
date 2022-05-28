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
                $name = $_POST['full'];
                $adr = $_POST['address'];
				$phone = $_POST['phone'];
                $mail = $_POST['email'];
                $pass = $_POST['pass'];
                $tp = $_POST['type'];

                $res = mysqli_query($con, "INSERT INTO company VALUES (null, '$name', '$adr', '$phone', '$mail', '$pass', '$tp')");
                if ($res) { 
                    echo '<script> alert("Καταχωρήθηκε"); </script>';
                    header('Location: profile.php');
                 } else { 
                    echo '<script> alert("Δεν Καταχωρήθηκε"); </script>';
                 } ?>
            </div>
        </div>
    </div>
</body>


</html>