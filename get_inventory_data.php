<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btncs_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter value from the query string
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'All';

// Prepare the SQL query based on the filter
if ($filter === 'In Stock') {
    $sql = "SELECT * FROM inventory WHERE quantity > low_stock";
} elseif ($filter === 'Low Stock') {
    $sql = "SELECT * FROM inventory WHERE quantity <= low_stock AND quantity > 0";
} elseif ($filter === 'Out of Stock') {
    $sql = "SELECT * FROM inventory WHERE quantity = 0";
} else {
    $sql = "SELECT * FROM inventory"; // Default to "All"
}

$result = $conn->query($sql);

// Fetch the data
$inventory_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inventory_data[] = [
            'item' => $row['item'],
            'quantity' => $row['quantity'],
            'low_stock' => $row['low_stock'],
            'status' => getStatus($row['quantity'], $row['low_stock']),
        ];
    }
} else {
    echo "0 results";
}

// Return the data as JSON
echo json_encode($inventory_data);

// Function to determine status
function getStatus($quantity, $low_stock) {
    if ($quantity === 0) {
        return 'Out of Stock';
    } elseif ($quantity <= $low_stock) {
        return 'Low Stock';
    } else {
        return 'In Stock';
    }
}

// Close the connection
$conn->close();
?>
