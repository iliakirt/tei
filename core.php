
                <?php
                include 'config.php';
                //ADMIN
                $type = $_POST['admin'];
                if ($type=="admin"){
                if (isset($_POST['save'])){
                    $name = $_POST['name_company'];
                    $adr = $_POST['address'];
					$phone = $_POST['phone'];
                    $mail = $_POST['email'];
                    $idc = $_POST['idc'];
                    $pass = $_POST['password'];
                    $res = mysqli_query($con, "UPDATE company SET name_company = '$name', address = '$adr', phone = '$phone', email = '$mail', type = 'elevator', password = '$pass' WHERE idc = '$idc'");
                    //chatdata
                    $res= mysqli_query($con, "UPDATE users SET fname = '$name', email = '$mail' WHERE id = '$idc' AND lname = 'elevator'");
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

                    $r = mysqli_query($con, "SELECT * FROM users WHERE lname='elevator' AND id = '$idc'");
                    $idchat = mysqli_fetch_array($r);
                    $unique = $idchat['unique_id'];
                    $email = $idchat['email'];

                    $res = mysqli_query($con, "DELETE FROM errors WHERE idc='$idc';");
                    $res = mysqli_query($con, "DELETE FROM diaxeiristes WHERE idc='$idc';");
                    $res = mysqli_query($con, "DELETE FROM company WHERE idc='$idc';");
                    
                    //chatdata
                    $res = mysqli_query($con, "DELETE FROM messages WHERE incoming_msg_id='$unique' OR outgoing_msg_id='$unique'");
                    $res = mysqli_query($con, "DELETE FROM users WHERE unique_id='$unique'");
                    $res = mysqli_query($con, "DELETE FROM users WHERE img='$email'");
                    if ($res) {
                        echo '<script> alert("Διαγράφηκε"); </script>';
                        header('Location: profile.php');
                     } else { 
                        echo '<script> alert("Σφάλμα"); </script>';
                       //header('Location: profile.php');
                     } 
                 }
                 //ELEVATOR 
                } else {
                    if (isset($_POST['save'])){
                        $name = $_POST['fullname'];
                        $adr = $_POST['address'];
                        $phone = $_POST['phone'];
                        $mail = $_POST['email'];
                        $id = $_POST['id'];
                        $pass = $_POST['password'];
                        
                        $res = mysqli_query($con, "UPDATE diaxeiristes SET fullname = '$name', address = '$adr', phone = '$phone', email = '$mail',password = '$pass', type = 'super' WHERE id = '$id'");  
                        //chatdata
                        $res= mysqli_query($con, "UPDATE users SET fname = '$name', email = '$mail' WHERE id = '$id' AND lname = 'super'"); 

                        if ($res) { 
                            
                            //echo '<script> alert("Ενημερώθηκε"); </script>';
                            header('Location: profile.php');
                         } else { 
                            echo '<script> alert("Σφάλμα"); </script>';
                            header('Location: profile.php');
                             }     
                     } 
                    if (isset($_POST['delete'])){
                        
                        $id = $_POST['id'];

                        $r = mysqli_query($con, "SELECT * FROM users WHERE lname='super' AND id = '$id'");
                        $idchat = mysqli_fetch_array($r);
                        $unique = $idchat['unique_id']; 

                        $res = mysqli_query($con, "DELETE FROM errors WHERE id='$id'");
                        $res = mysqli_query($con, "DELETE FROM diaxeiristes WHERE id='$id'"); 
                        //chatdata
                        $res = mysqli_query($con, "DELETE FROM messages WHERE incoming_msg_id='$unique' OR outgoing_msg_id='$unique'");
                        $res = mysqli_query($con, "DELETE FROM users WHERE unique_id='$unique'");
                        if ($res) {
                            
                            header('Location: profile.php');
                         } else { 
                            echo '<script> alert("Σφάλμα"); </script>';
                            //header('Location: profile.php');
                         } 
                     } 
                }
                 
 ?>