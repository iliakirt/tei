<?php 
include 'config.php';

session_start(); 
if (!isset($_SESSION['user'])){
    header('location: index.php');
}
$user = $_SESSION['user'];
?>
<html>
    <head>
        <title>Πτυχιακή</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Fontawesome 5-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
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
            .notification {
                background-color: #555;
                color: white;
                text-decoration: none;
                padding: 15px 26px;
                position: relative;
                display: inline-block;
                border-radius: 2px;
            }

            .notification:hover {
                background: red;
            }

            .notification .badge {
                position: absolute;
                top: -10px;
                right: -10px;
                padding: 5px 10px;
                border-radius: 50%;
                background: red;
                color: white;
            }
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
       <script>
    function updateBadge() {
        $.ajax({
            url: 'updatenotifications.php',
            method: 'GET',
            success: function(data) {
                var unseenCount = JSON.parse(data).unseen_count;
                $('#unseen_count').text(unseenCount);
            }
        });
    }

    $(document).ready(function() {
        updateBadge();
        setInterval(updateBadge, 3000); // Update every 3 seconds
    });
</script>

</head>
    <body>
        <div class="container">
            <div class="jumbotron text-center">
                <h2><br>Εταιρίες Διαχείρισης Ανελκυστήρων</h2>
                <p class="sub">Ολοκληρωμένο app διαχείρισης</p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h4>Έχετε συνδεθεί ως: <span><b><?php if ($user['type']=='super') {
                        $idc = $user['idc'];
                        $q = mysqli_query($con, "SELECT * FROM company WHERE idc='$idc'");                       
                        $company = mysqli_fetch_array($q);                        
                        print $user['fullname']."&nbsp;/&nbsp;".$company['name_company'];

                    }else{
                            print $user['name_company'];
                        }
                        //chatapp
                        $email_c = $user['email'];
                        $sql_c = mysqli_query($con, "SELECT * FROM users WHERE email='$email_c'");
                        $chat = mysqli_fetch_array($sql_c);
                        //chatapp
                        ?></b></span> | 
                    <a href="logout.php" class="btn btn-default">Κάντε αποσύνδεση <span class="glyphicon glyphicon-log-out"></span></a></h4>

                    <!--chatapp-->
                    <form action="chat/php/login.php" method="POST">
                    <?php if (isset($chat['email'])): ?>
                   <input type="hidden" name="email" value="<?= $chat['email'] ?>">
                   <?php endif; ?>
                <?php if (isset($chat['password'])): ?>
                 <input type="hidden" name="password" value="<?= $chat['password'] ?>">
                 <?php endif; ?>
                 <!--
                 <span class="notification">
                <span class="badge" id="unseen_count">1</span>
              <button class="btn btn-danger">Inbox</button>
               </span>
                -->
               <?php if($user['type'] != 'admin') {?>
						
						<span  class="notification">
                            <span class="badge">1</span>
                                   <button class="btn btn-danger">
                                   Inbox</button></form>
                        </span>
            <?php } ?> 
            </form>
             
          <!--chatapp-->


                    <!-- plain users --> 
                    <?php if ($user['type'] == 'super'){ ?> 
                        <div class="row">
                            <div class="col-md-12">
                                <h3><span class="glyphicon glyphicon-user"></span> Προφίλ Χρήστη</h3>
                                <table class="table">
                                    <tr>
                                        <td>Ονοματεπώνυμο</td>
                                        <td>Email</td>
										<td>Τηλέφωνο</td>
                                        <td>Διεύθυνση</td>
                                        <td>Ενέργεια</td>
                                    </tr>
                                    <tr>
                                        <form action="update_user.php" method="post">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="utype" value="super">
                                            <td><input style="border: none;" type="text" name="name" value="<?= $user['fullname']?>"></td>
                                            <td><input style="border: none;" type="text" name="email" value="<?= $user['email']?>"></td>
											<td><input style="border: none;" type="text" name="phone" value="<?= $user['phone']?>"></td>
                                            <td><input style="border: none;" type="text" name="address" value="<?= $user['address']?>"></td>
                                            <td><button class="btn btn-success" type="submit">Αποθήκευση</button></td>
                                        </form>
                                    </tr>
                                </table>
                            </div>
                            <div id="adddata" class="container">
                                <h3><span class="glyphicon glyphicon-wrench"></span><b> Σύνθεση Βλάβης</b></h3> 
                                <form action="issue.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="idc" value="<?= $user['idc'] ?>">
                                    <input type="radio" id="damage1" name="error" value="Αναμμένη ενδεικτική λυχνία">
                                    <label for="damage1"> Αναμμένη ενδεικτική λυχνία</label><br><br>
                                    <input type="radio" id="damage2" name="error"value="Καμμένες Ασφάλειες">
                                    <label for="damage2"> Καμμένες Ασφάλειες</label><br><br>
                                    <input type="radio" id="damage3" name="error"value="Η πόρτα δεν κλείνει">
                                    <label for="damage3"> Η πόρτα δεν κλείνει</label><br><br>
                                    <input type="radio" id="damage4" name="error"value="Φθαρμένοι λαμπτήρες">
                                    <label for="damage4"> Φθαρμένοι λαμπτήρες</label><br><br>
                                    <input type="radio" id="damage5" name="error"value="Δυσλειτουργία κουμπιών">
                                    <label for="damage5"> Δυσλειτουργία κουμπιών</label><br><br>
                                    <input type="radio" id="damage6" name="error"value="Άλλο" checked>
                                    <label for="damage6"> Άλλο</label><br><br>
                                    <textarea name="message" style="width:293px; height:100px;">Σχόλια...</textarea>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                    <input type="submit" value="Αποστολή Βλάβης" name="submit" class="btn btn-warning">
                                </form>
                  <!--chatapp--><form action="chat/php/login.php" method="POST">
                                     <input type="hidden" name="email" value="<?= $chat['email'] ?>">
                                     <input type="hidden" name="password" value="<?= $chat['password'] ?>">
                                     <button class="btn btn-danger">
                                   Στείλτε Μήνυμα</button></form><!--chatapp-->                             
                            </div>  
                        </div>

                        <h3><span class="glyphicon glyphicon-list"></span> Ιστορικό </h3>
                        <table id="niaou" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Αρ.ΒΛΑΒΗΣ</th>
                                <th scope="col">Περιεχόμενο</th>
                                <th scope="col">Η/ΝΙΑ ΒΛΑΒΗΣ</th>
                                <th scope="col">ΥΛΙΚΟ</th>
                                <th scope="col">ΜΗΧΑΝΙΚΟΣ</th>
                                <th scope="col">Η/ΝΙΑ SERVICE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $res = mysqli_query($con, 'SELECT * FROM errors WHERE id='.$user['id'].' ORDER BY ide DESC;');
                                while($row = mysqli_fetch_array($res)){ 
                                    echo "<tr>";
                                    echo   "<td>".$row['ide']."</td>";
                                    echo   "<td>".$row['error']."</td>";
                                    echo  "<td>".$row['day_error']."</td>";
                                    echo  "<td>".$row['material']."</td>";
                                    echo  "<td>".$row['engineer']."</td>";
                                    echo   "<td>".$row['day_service']."</td>";
                                    echo "</tr>";
                                 }
                            ?>
                            </tbody>
                        </table>
                    <?php } ?>

                    <!-- elevator users --> 
                    <?php if ($user['type'] == 'elevator'){ ?> 

                        <!-- Modal -->
                     <div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                             <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLongTitle">Προσθήκη Διαχειριστή</h3>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                              </div>
                         <div class="modal-body">
                                <form action="insert.php" method="post" style=" margin: auto;">
                                    <input type="hidden" name="type_admin" value="elevator">
                                    <input type="hidden" name="idc" value="<?= $user['idc'] ?>">
                                    <input type="text" name="full" class="form-control" placeholder="Ονοματεπώνυμο" required>
                                    <input type="text" name="address" class="form-control" placeholder="Διεύθυνση" required>
									<input type="text" name="phone" class="form-control" placeholder="Τηλέφωνο" required>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    <input type="password" name="pass" class="form-control" placeholder="Choose password" required> 
                                    <input type="hidden" name="type" value="super">
                                    <div>
                                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-user"></span> Νέος Διαχειριστής</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Κλείσιμο</button>
                                     </div>
                                </form>
                       </div>
                     </div>
                </div>
         </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Προφίλ Χρήστη</h3>
                                <table class="table">
                                    <tr>
                                        <td>Εταιρία</td>
                                        <td>Εmail</td>
										<td>Τηλέφωνο</td>
                                        <td>Διεύθυνση</td>
                                        <td>Ενέργεια</td>
                                    </tr>
                                    <tr>
                                        <form action="update_user.php" method="post">
                                            <input type="hidden" name="idc" value="<?= $user['idc'] ?>">
                                            <input type="hidden" name="utype" value="elevator">
                                            <td><input style="border: none;" type="text" name="name_company" value="<?= $user['name_company']?>"></td>
                                            <td><input style="border: none;" type="text" name="email" value="<?= $user['email']?>"></td>
											<td><input style="border: none;" type="text" name="phone" value="<?= $user['phone']?>"></td>
                                            <td><input style="border: none;" type="text" name="address" value="<?= $user['address']?>"></td>
                                            <td><button class="btn btn-info" type="submit">Αποθήκευση</button></td>
                                        </form>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Ιστορικό Βλαβών</h3>
                                <table id="niaou" class="table table-striped">
                                    <thead>
                                    <tr>    
                                    <th>ID</th>
                                    <th>Διεύθυνση</th>
                                    <th>Διαχειριστής</th>
                                    <th>Περιεχόμενο</th>
                                    <th>Σχόλια</th>
                                    <th>Η/ΝΙΑ ΒΛΑΒΗΣ</th>
                                    <th>Η/ΝΙΑ ΕΠΙΣΚΕΥΗ</th>
                                    <th>ΕΠΙΣΚΕΥΗ/ΠΛΗΡΟΦΟΡΙΕΣ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $res = mysqli_query($con, 'SELECT * FROM  errors WHERE idc='.$user['idc'].'');
                                        while($row = mysqli_fetch_array($res)){
                                            $re = mysqli_query($con, 'SELECT * FROM diaxeiristes WHERE idc='.$user['idc'].' AND id='.$row['id'].'');
                                        $rowe = mysqli_fetch_array($re); 
                                            
                                            echo '<tr>';
                                            echo '<td>'.$row['ide'].'</td>';
                                            echo '<td>'.$rowe['address'].'</td>';
                                            echo '<td>'.$rowe['fullname'].'</td>';
                                            echo '<td>'.$row['error'].'</td>';
                                            echo '<td>'.$row['message'].'</td>';
                                            echo '<td>'.$row['day_error'].'</td>';
                                            echo '<td>'.$row['day_service'].'</td>';
                                            echo '<form action="fix.php" method="post">';
                                            echo '<input type="hidden" style="border: none;" value="'.$row['id'].'" name="id">';
                                            echo '<input type="hidden" style="border: none;" value="'.$row['ide'].'" name="ide">';
                                            echo '<input type="hidden" style="border: none;" value="'.$user['idc'].'" name="idc">';
                                            if($row['day_service'] == null){
                                            echo '<td><button type="submit" class="btn btn-warning">
                                            Επισκευή </button></td>';
                                            }else{
                                                echo '<td><button type="submit" class="btn btn-info">
                                            Πληροφορίες </button></td>';
                                            }
                                            echo '</form>';
                                            echo '</tr>';
                                   
                                         }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-12 col-lg-12">                                          
                                              <!--chatapp-->
                                              <form action="chat/php/login.php" method="POST">
                                                <input type="hidden" name="email" value="<?= $chat['email'] ?>">
                                                <input type="hidden" name="password" value="<?= $chat['password'] ?>">
                                              <button class="btn btn-danger">
                                                       Στείλτε Μήνυμα</button> </form>  <!--chatapp--> 
                                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adddata">
                                                       Προσθήκη Διαχειριστή</button>     
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <h3>Εταιρίες/Χρήστες</h3>
                                <table class="display">
                                    <thead>
                                    <tr>
                                        <th col="scope">Διαχειριστής</th>
                                        <th col="scope">Διεύθυνση</th>
										<th col="scope">Τηλέφωνο</th>
                                        <th col="scope">Email</th>
                                        <th col="scope">Password</th>
                                        <th col="scope">Αποθήκευση/Διαγραφή</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $q1 = mysqli_query($con, 'SELECT * FROM diaxeiristes WHERE idc='.$user['idc'].'');
                                    while($row1 = mysqli_fetch_array($q1)){  
                                        $id=$row1['id'];
                                        $name=$row1['fullname'];
                                        $add=$row1['address'];
                                        $phone=$row1['phone'];
                                        $email=$row1['email'];
                                        $pass=$row1['password'];
                                        echo '<tr>';
                                        echo '<form action="core.php" method="post">';
                                        echo '<input type="hidden" style="border: none;" value="'.$id.'" name="id">';
                                        echo '<input type="hidden" style="border: none;" value="elevator" name="admin">';
                                        echo '<td><input type="text" style="border: none;" value="'.$name.'" name="fullname"></td>';
                                        echo '<td><input type="text" style="border: none;" value="'.$add.'" name="address"></td>';
                                        echo '<td><input type="text" style="border: none;" value="'.$phone.'" name="phone"></td>';
                                        echo '<td><input type="email" style="border: none;" value="'.$email.'" name="email"></td>';
                                        echo '<td><input type="text" style="border: none;" value="'.$pass.'" name="password"></td>';
                                        echo '<td><button name="save" type="submit" class="btn btn-success">&#10004;</button>';
                                        echo '<button name="delete"type="submit" class="btn btn-danger">&times;</button></td>';
                                        echo '</form>';
                                        echo '</tr>';
                                      } ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        

                        
                        
                        
                                    
                    <?php } ?>

                    <!-- admin user --> 
                    <?php if ($user['type'] == 'admin'){ ?> 

                        <!-- Modal -->
                     <div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                             <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLongTitle">Προσθήκη Εταιρίας</h3>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                              </div>
                         <div class="modal-body">
                                <form action="insert.php" method="post" style=" margin: auto;">
                                    <input type="hidden" name="type_admin" value="admin">
                                    <input type="text" name="full" class="form-control" placeholder="Εταιρία" required>
                                    <input type="text" name="address" class="form-control" placeholder="Διεύθυνση" required>
									 <input type="text" name="phone" class="form-control" placeholder="Τηλέφωνο" required>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    <input type="password" name="pass" class="form-control" placeholder="Choose password" required> 
                                   <select name="type" class="form-control input-sm">                                                                              
                                        <option value="elevator">Διαχειριστής Ανελκυστήρων</option>
                                        <option value="admin">Admin</option>
                                    </select><br>
                                    <div>
                                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-user"></span> Νέος Χρήστης</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Κλείσιμο</button>
                                     </div>
                                </form>
                       </div>
                     </div>
                </div>
         </div>



         <div class="row">
                 <div class="col-md-12 col-lg-12">
                        <h3>Εισαγωγή Χρηστών Εταιριών</h3>
                                
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adddata">
                  Προσθήκη νέας εταιρίας συντήρησης </button>
                </div>
         </div>                        
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h3>Εταιρίες/Χρήστες</h3>
                                <table class="display">
                                    <thead>
                                    <tr>
                                        <th col="scope">Εταιρίες</th>
                                        <th col="scope">Διεύθυνση</th>
										<th col="scope">Τηλέφωνο</th>
                                        <th col="scope">Email</th>
                                        <th col="scope">Password</th>
                                        <th col="scope">Αποθήκευση/Διαγραφή</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $q = mysqli_query($con, 'SELECT * FROM company WHERE type="elevator"');
                                    while($r = mysqli_fetch_array($q)){  
                                        $idc=$r['idc'];
                                        $n_m=$r['name_company'];
                                        $add=$r['address'];
                                        $phone=$r['phone'];
                                        $email=$r['email'];
                                        $pass=$r['password'];
                                        echo '<tr>';
                                        echo '<form action="core.php" method="post">';
                                        echo '<input type="hidden" style="border: none;" value="admin" name="admin">';
                                        echo '<input type="hidden" style="border: none;" value="'.$idc.'" name="idc">';
                                        echo '<td><input type="text" style="border: none;" value="'.$n_m.'" name="name_company"></td>';
                                        echo '<td><input type="text" style="border: none;" value="'.$add.'" name="address"></td>';
                                        echo '<td><input type="text" style="border: none;" value="'.$phone.'" name="phone"></td>';
                                        echo '<td><input type="email" style="border: none;" value="'.$email.'" name="email"></td>';
                                        echo '<td><input type="text" style="border: none;" value="'.$pass.'" name="password"></td>';
                                        echo '<td><button name="save" type="submit" class="btn btn-success">&#10004;</button>';
                                        echo '<button name="delete"type="submit" class="btn btn-danger">&times;</button></td>';
                                        echo '</form>';
                                        echo '</tr>';
                                      } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
            <div class="alert alert-primary text-center">All rights reserved &copy;</div>
        </div>
        
        
        
        
 
    </body>
</html>
