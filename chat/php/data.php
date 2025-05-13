<?php
$users = [];
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
            OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    // count the incoming seen messages
    $sql3 = "SELECT COUNT(*) as unread_count FROM messages 
             WHERE incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$row['unique_id']} AND incomingmsgseen = 0";
    $query3 = mysqli_query($con, $sql3);
    $row3 = mysqli_fetch_assoc($query3);
    $unread_count = $row3['unread_count'];

    $users[] = [
        'unique_id' => $row['unique_id'],
        'fname' => $row['fname'],
        'msg' => $msg,
        'you' => $you,
        'offline' => $offline,
        'unread_count' => $unread_count,
    ];
}

// Sort users by unread messages
usort($users, function ($a, $b) {
    return $b['unread_count'] <=> $a['unread_count'];
});

$output = '';

foreach ($users as $user) {
    $output .= '<a href="chat.php?user_id='. $user['unique_id'] .'">
                <div class="content">
                    <div class="details">
                        <span>'. $user['fname']. '</span>
                        <p>'. $user['you'] . $user['msg'] .'</p>
                    </div>
                </div>';

    if ($user['unread_count'] > 0) {
        $output .= '<div class="unread-msg-count">'. $user['unread_count'] .'</div>';
    }

    $output .= '<div class="status-dot '. $user['offline'] .'"><i class="fas fa-circle"></i></div>
            </a>';
}
?>
<style>
.unread-msg-count {
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 3px 10px;
    position: relative;
    margin-left: auto;
    margin-right: 10px;
    display: inline-block;
}
    </style>

