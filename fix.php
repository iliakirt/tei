<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>.container { margin: 2em auto; } input { margin-bottom: .5em; }</style>
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php 
                    include 'config.php'; 

                    $issue = $_POST['issue'];
                    $desc = $_POST['desc'];
                    $d = date('Y-m-d');
                    $res = mysqli_query($con, "INSERT INTO completed VALUES ('$issue', '$desc', '$d')");
                    if ($res){ ?>
                        <div class="alert alert-success">Η επιδιόρθωση καταχωρήθηκε. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                    <?php } else { ?>
                        <div class="alert alert-danger">Προέκυψε σφάλμα. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                    <?php } ?>
                </div>
            </div>
        </div>
</body> 
</html>