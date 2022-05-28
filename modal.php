<?php 
include 'config.php';   
session_start(); 
if (!isset($_SESSION['user'])){
    header('location: index.php');
} 
$user = $_SESSION['user']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php  modal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
    $('#niaou').DataTable();
} );
        </script>


<body>




<!-- Modal -->
<div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
                                    <input type="submit" value="Αποστολή Βλάβης" name="submit" class="btn btn-primary">
                                </form>
      
      
        
      </div>
      
    </div>
  </div>
</div>

<div class="container">
    <div class="jumbotron">
        <div class="card">
            <h2>php</h2>
        </div>
        <div class="card">
            <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adddata">
                 ADD DATA
            </button>

            </div>
        </div>
    </div>
</div>



            </div>
        </div>
    </div>
</div>


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






    
</body>

</html>