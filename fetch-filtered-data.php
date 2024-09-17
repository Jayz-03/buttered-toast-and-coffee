<?php
require_once 'config.php';

$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
$paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';

$sql = "SELECT SUM(total_amount) AS total_income, COUNT(*) AS total_orders FROM sales WHERE 1=1";

if (!empty($startDate)) {
    $sql .= " AND DATE(transaction_date) >= '$startDate'";
}

if (!empty($endDate)) {
    $sql .= " AND DATE(transaction_date) <= '$endDate'";
}

if (!empty($paymentMethod)) {
    $sql .= " AND payment_method = '$paymentMethod'";
}

$result = mysqli_query($link, $sql);

$total_income = 0;
$total_orders = 0;

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $total_income = $data['total_income'] ? $data['total_income'] : 0;
    $total_orders = $data['total_orders'] ? $data['total_orders'] : 0;
}

echo json_encode([
    'total_income' => $total_income,
    'total_orders' => $total_orders
]);
?>
