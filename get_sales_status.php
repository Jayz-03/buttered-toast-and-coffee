<?php
// Database connection (change with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btncs_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch sales data based on status
$query = "SELECT sale_id, queue_no, total_amount, status FROM sales";
$result = $conn->query($query);

// Check if any data was fetched
if ($result->num_rows > 0) {
    $sales = [];
    while ($row = $result->fetch_assoc()) {
        $sales[] = $row;
    }
    // Return the result as a JSON response
    echo json_encode($sales);
} else {
    // Log an error message if no data is found
    error_log("No data found in sales table.");
    echo json_encode([]);
}

$conn->close();
?>
