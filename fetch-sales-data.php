<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btncs_db";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$filter = $_GET['filter']; // day, week, month, year

switch ($filter) {
    case 'day':
        $start_date = date('Y-m-d 00:00:00');
        $end_date = date('Y-m-d 23:59:59');
        break;
    case 'week':
        $start_date = date('Y-m-d 00:00:00', strtotime('-1 week'));
        $end_date = date('Y-m-d 23:59:59');
        break;
    case 'month':
        $start_date = date('Y-m-01 00:00:00');
        $end_date = date('Y-m-t 23:59:59');
        break;
    case 'year':
        $start_date = date('Y-01-01 00:00:00');
        $end_date = date('Y-12-31 23:59:59');
        break;
}

$sql = "SELECT p.category_name, DATE(s.transaction_date) as sale_date, 
               SUM(si.quantity * si.price) as total_sales 
        FROM sales s 
        JOIN sale_Items si ON s.sale_id = si.sale_id 
        JOIN product p ON si.product_id = p.product_id 
        WHERE s.transaction_date BETWEEN :start_date AND :end_date 
        GROUP BY p.category_name, DATE(s.transaction_date)
        ORDER BY sale_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':start_date', $start_date);
$stmt->bindParam(':end_date', $end_date);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);
?>
