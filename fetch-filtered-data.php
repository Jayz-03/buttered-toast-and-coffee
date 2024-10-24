<?php
require_once 'config.php';

$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
$paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';

$sql = "SELECT p.category_name, DATE(s.transaction_date) as sale_date, 
               SUM(si.quantity * si.price) as total_sales 
        FROM sales s 
        JOIN sale_items si ON s.sale_id = si.sale_id 
        JOIN product p ON si.product_id = p.product_id 
        WHERE 1=1";

if (!empty($startDate)) {
    $sql .= " AND DATE(s.transaction_date) >= '$startDate'";
}

if (!empty($endDate)) {
    $sql .= " AND DATE(s.transaction_date) <= '$endDate'";
}

if (!empty($paymentMethod)) {
    $sql .= " AND s.payment_method = '$paymentMethod'";
}

$sql .= " GROUP BY p.category_name, DATE(s.transaction_date)
          ORDER BY sale_date ASC";

$result = mysqli_query($link, $sql);

$sales_data = [];
$total_income = 0;
$total_orders = 0;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sales_data[] = [
            'category_name' => $row['category_name'],
            'sale_date' => $row['sale_date'],
            'total_sales' => $row['total_sales']
        ];
        $total_income += $row['total_sales'];
        $total_orders++;
    }
}

echo json_encode([
    'total_income' => $total_income,
    'total_orders' => $total_orders,
    'sales_data' => $sales_data
]);
?>
