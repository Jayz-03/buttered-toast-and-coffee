<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btncs_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if (isset($_POST['sale_id']) && isset($_POST['new_status'])) {
    $sale_id = $_POST['sale_id'];
    $new_status = $_POST['new_status'];

    $sql = "UPDATE sales SET status = ? WHERE sale_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_status, $sale_id);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Order status updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating order status: " . $conn->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = "Sale ID or New Status not set";
}

$conn->close();

echo json_encode($response);
?>
