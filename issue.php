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
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        ?>
                        <div class="alert alert-danger">Το αρχείο δεν είναι εικόνα. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                        <?php
                        $uploadOk = 0;
                    }
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    //echo "Sorry, file already exists."; ?>
                    <div class="alert alert-danger">Το αρχείο υπάρχει ήδη. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                    <?php
                    $uploadOk = 0;
                }              

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    ?>
                    <div class="alert alert-danger">Συγγνώμη, μόνο JPG, JPEG, PNG & GIF αρχεία επιτρέπονται. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                    <?php
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        //echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                        $image = ($target_dir . basename($_FILES["fileToUpload"]["name"])) ? $target_dir . basename($_FILES["fileToUpload"]["name"]) : '';
                        $id = $_POST['id'];
                        $idc = $_POST['idc'];
                        $error = $_POST['error'];
                        $msg = $_POST['message'];
                        $q = "INSERT INTO errors VALUES (null, '$error', NOW(), '$msg', '$image', '', '', '', '$idc', '$id')";
                        $res = mysqli_query($con, $q);
                        if ($res){ ?>
                            <div class="alert alert-success">Η Βλάβη καταχωρήθηκε. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                        <?php } else { ?>
                            <div class="alert alert-danger">Προέκυψε σφάλμα. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                        <?php } 

                    } else {
                        echo "Sorry, there was an error uploading your file.";?>
                        <div class="alert alert-danger">Προέκυψε σφάλμα. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                        <?php
                    }
                }?>        
            </div>
        </div>
    </div>
</body> 
</html>
