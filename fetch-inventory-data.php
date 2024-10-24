<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btncs_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT item, quantity FROM inventory WHERE quantity <= 10000";
$result = $conn->query($sql);

$items = [];
$quantities = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row['item'];
        $quantities[] = (int)$row['quantity'];
    }
}

$response = [
    'items' => $items,
    'quantities' => $quantities
];

echo json_encode($response);

$conn->close();
?>
