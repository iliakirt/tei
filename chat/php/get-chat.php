    <?php 
        session_start();
        if(isset($_SESSION['unique_id'])){
            include_once "config.php";
            $outgoing_id = $_SESSION['unique_id'];
            $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
            $output = "";
            $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                    OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
                    $sql2 = "update messages set incomingmsgseen = 1 where (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})";
            $query = mysqli_query($con, $sql);
            $query2 = mysqli_query($con, $sql2);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['outgoing_msg_id'] === $outgoing_id){

                        $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                    </div>';
                        var_dump($output);
                    }else{
                        $output .= '<div class="chat incoming">
                                    
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                    </div>';
                    }
                
            
            } 
            }else{
                $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
            }
            echo $output;
        }else{
            header("location: ../login.php");
        }

    ?>