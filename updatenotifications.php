<?php
include 'config.php';
session_start();

$response = ['unseen_count' => 0]; // Default response

if (isset($_SESSION['unique_id'])) {
    $unique = $_SESSION['unique_id'];
    
    $query = "SELECT COUNT(*) as unseen_count FROM messages WHERE incomingmsgseen = 0 AND incoming_msg_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $unique);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $response['unseen_count'] = $row['unseen_count'];
}

echo json_encode($response);
?>
