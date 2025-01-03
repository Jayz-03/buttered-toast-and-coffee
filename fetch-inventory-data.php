<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btncs_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT item, stocks FROM inventory";
$result = $conn->query($sql);

$items = [];
$quantities = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row['item'];
        $quantities[] = (int)$row['stocks'];
    }
}

$response = [
    'items' => $items,
    'quantities' => $quantities
];

echo json_encode($response);

$conn->close();
?>
