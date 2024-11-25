<?php
session_start();
include 'config.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login");
    exit;
}

// Get parameters
$queue_no = $_GET['queue_no'];
$new_status = $_GET['status'];

$sql = "UPDATE sales SET status = ? WHERE queue_no = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $new_status, $queue_no);

if ($stmt->execute()) {
    header("Location: staff-kitchen-process"); 
} else {
    echo "Error updating record: " . $link->error;
}

$stmt->close();
$link->close();
?>
