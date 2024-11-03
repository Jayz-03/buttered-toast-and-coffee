<?php
require_once 'config.php';

// Get filter parameters
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
$paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';

// Original sales data query
$sales_sql = "SELECT p.category_name, DATE(s.transaction_date) as sale_date, 
               SUM(si.quantity) as quantity_sold,
               SUM(si.quantity * si.price) as total_sales 
        FROM sales s 
        JOIN sale_items si ON s.sale_id = si.sale_id 
        JOIN product p ON si.product_id = p.product_id 
        WHERE 1=1";

if (!empty($startDate)) {
    $sales_sql .= " AND DATE(s.transaction_date) >= '$startDate'";
}

if (!empty($endDate)) {
    $sales_sql .= " AND DATE(s.transaction_date) <= '$endDate'";
}

if (!empty($paymentMethod)) {
    $sales_sql .= " AND s.payment_method = '$paymentMethod'";
}

$sales_sql .= " GROUP BY p.category_name, DATE(s.transaction_date)
                ORDER BY total_sales DESC";

$sales_result = mysqli_query($link, $sales_sql);

// Structure for sales data
$sales_data = [];
$total_income = 0;
$total_orders = 0;
$rank = 1;

if ($sales_result && mysqli_num_rows($sales_result) > 0) {
    while ($row = mysqli_fetch_assoc($sales_result)) {
        $sales_data[] = [
            'sale_date' => $row['sale_date'],
            'category_name' => $row['category_name'],
            'quantity_sold' => $row['quantity_sold'],
            'total_sales' => $row['total_sales'],
            'rank' => $rank++
        ];
        $total_income += $row['total_sales'];
        $total_orders += $row['quantity_sold'];
    }
}

// New query for product data with associated sales items
$product_sql = "SELECT si.product_name, SUM(si.quantity) as total_quantity, si.price
                FROM sale_items si
                JOIN sales s ON si.sale_id = s.sale_id
                WHERE 1=1";

if (!empty($startDate)) {
    $product_sql .= " AND DATE(s.transaction_date) >= '$startDate'";
}

if (!empty($endDate)) {
    $product_sql .= " AND DATE(s.transaction_date) <= '$endDate'";
}

if (!empty($paymentMethod)) {
    $product_sql .= " AND s.payment_method = '$paymentMethod'";
}

$product_sql .= " GROUP BY si.product_name, si.price
                ORDER BY total_quantity DESC";

$product_result = mysqli_query($link, $product_sql);

// Structure for product data
$product_data = [];

if ($product_result && mysqli_num_rows($product_result) > 0) {
    while ($row = mysqli_fetch_assoc($product_result)) {
        $product_data[] = [
            'product_name' => $row['product_name'],
            'total_quantity' => $row['total_quantity'],
            'price' => $row['price']
        ];
    }
}

// Return JSON with both sales and product data
echo json_encode([
    'total_income' => $total_income,
    'total_orders' => $total_orders,
    'sales_data' => $sales_data,
    'product_data' => $product_data
]);
?>
