<html>
<head>
        <title>Πτυχιακή</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       
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
            
        }
        .sub {color: #fff; text-transform: capitalize; }
        </style>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
        
        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
    $('#niaou').DataTable();
} );
        </script>

</head>
    <body>
        <div class="container">
            <div class="row">
            
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <a class="btn btn-default" href="profile.php">Πηγαίνεται πίσω</a>
                
                <?php 
                    include 'config.php'; 

                    $id=$_POST['id'];
                    $idc=$_POST['idc'];
                    $ide=$_POST['ide'];

                    $res = mysqli_query($con, "SELECT * FROM errors WHERE ide=$ide AND idc=$idc AND id=$id");
                    $d = mysqli_query($con, "SELECT * FROM diaxeiristes WHERE id=$id");
                    $rowd = mysqli_fetch_array($d);
                    if ($res){ ?>
                        <div class="alert alert-success">
                            <h3>Διαχειριστής: <b><?php print $rowd['fullname'];?></b>&nbsp; Διεύθυνση: <b><?php print $rowd['address'];?></b> <h3>
  
                    <?php 
                    while ($data = $res->fetch_assoc()){
                        echo "<h3>Κωδικός: <b>{$data['ide']}</b> Βλάβη: <b>{$data['error']}</b> Ημερομηνία: <b>{$data['day_error']}</h3></b>";
                        echo "<h3>Σχόλια: {$data['message']} </h3>";
                        echo "<img src='{$data['image']}' width='100%' height='80%'";
                    }
                    ?></div>
                    <?php } else { ?>
                        <div class="alert alert-danger">Προέκυψε σφάλμα. Πηγαίνετε <a href="profile.php">πίσω</a></div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div id="adddata" class="container">
                                <h3><span class="glyphicon glyphicon-wrench"></span><b> Επισκευή Βλάβης</b></h3> 
                                <?php 
                                $res1 = mysqli_query($con, "SELECT * FROM errors WHERE ide=$ide AND idc=$idc AND id=$id");
                                while($r = mysqli_fetch_array($res1)){
                                if($r['day_service'] == NULL){ ?> 
                                <form action="fix2.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $r['ide'] ?>" name="ide">
                                    <input type="hidden" value="<?= $r['id'] ?>" name="id">
                                    <input type="hidden" value="<?= $r['idc'] ?>" name="idc">
                                    <label for="damage1"> Μηχανικός:</label>
                                    <input type="text" id="damage1" name="eng">
                                    <label for="damage2"> Υλικό:</label>
                                    <input type="text" id="damage2" name="mat">
                                    <label for="damage3"> Ημ.Επισκευής:</label >
                                    <input type="date" id="damage3" name="date">
                                    <br>
                                    <input type="submit" value="Επισκευή" name="submit" class="btn btn-success">
                                </form>
                                <?php }else{ ?>
                                    <h3>Μηχανικός:<b><?php print $r['engineer']?> </b> &nbsp;Υλικό:<b><?php print $r['material']?> </b>&nbsp; Ημ.Επισκευής:<b><?php print $r['day_service']?> </b></h3>
                                    
                                    <?php }} ?>
                            </div>
                    </div>
            </div>
        
        
        
        </div>
</body> 
</html>