<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>.container { margin: 2em auto; border: 1px solid #ddd; 
        box-shadow: 0 5px 8px #666; padding: 1em;} input { margin-bottom: .5em; }
        .jumbotron { background-image: url(assets/heading.png); 
            background-size: cover; height: 400px;}
        h2 { color: #fff;}
        input[type="submit"], button {
            padding: 1em !important;
            color: #000 !important; 
            border:none !important;
            font-weight: 600 !important;
            background: palegreen !important;
        }
        .sub {color: #fff; text-transform: capitalize; }
        </style>
</head>
    <body>
        <div class="container">
            <div class="jumbotron text-center">
                <h2>Διαχείριση Πολυκατοικιών<br>Εταιρίες Διαχείρισης Ανελκυστήρων</h2>
                <p class="sub">Ολοκληρωμένο app διαχείρισης</p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h3><span class="glyphicon glyphicon-home"></span> Εννιαία Διαχείριση</h3>
                    <p>.
                        <ul>
                            <li>Βλάβες Ανελκυστήρων σε Πολυκατοικίες</li>
                            <li>Εταιρίες Συντήρησης Ανελκυστήρων</li>
                
                        </ul>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
                    <h3><span class="glyphicon glyphicon-user"></span> Γενική Είσοδος Χρηστών</h3>
                    <form action="login.php" method="post" style="width: 100%; margin: auto;">
                        <input type="email" name="email" class="form-control" placeholder="email">
                        <input type="password" name="password" class="form-control" placeholder="password">
                        Τύπος Χρήστη<select name="type" class="form-control">
                                        <option value="super">Διαχειριστής Πολυκατοικίας</option>
                                        <option value="elevator">Εταιρία Συντήρησης</option>
                                        <option value="admin">Admin</option>
                                    </select><br>
                        <button type="submit" name="login" class="btn btn-primary">
                            <span class="glyphicon glyphicon-log-in"></span> Είσοδος
                        </button>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h3><span class="glyphicon glyphicon-console"></span> Υπηρεσίες</h3>
                    <p>
                        <ul>
                            <li>Προσθαφαίρεση & Ενημέρωση Χρηστών</li>
                            <li>Καταχώρηση Βλαβών</li>
                            <li>Καταχώρηση Επισκευής Βλαβών</li>
                            <li>Reporting & Ιστορικό Βλαβών/Χρηστών/Επισκευών</li>
                            <li>Απευθείας Ενημέρωση μέσω συνομίλιας</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="alert alert-primary text-center">All rights reserved &copy;</div>
        </div>
    </body>
</html>