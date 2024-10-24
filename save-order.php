<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
date_default_timezone_set('Asia/Manila');

if ($data) {
    $day = date('d');
    $hour = date('H');
    $seconds = date('s');
    $queue_no = $day . $hour . $seconds;

    $cart = $data['cart'];
    $paymentMethod = $data['payment_method'];
    $totalAmount = $data['total_amount'];
    $customerPay = $data['customer_pay'];
    $change = $data['change'];

    $orderQuery = "INSERT INTO sales (total_amount, customer_pay, change_amount, payment_method, queue_no) VALUES (?, ?, ?, ?, ?)";
    $stmt = $link->prepare($orderQuery);
    $stmt->bind_param('dddss', $totalAmount, $customerPay, $change, $paymentMethod, $queue_no);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    foreach ($cart as $productId => $product) {
        $itemQuery = "INSERT INTO sale_items (sale_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $link->prepare($itemQuery);
        $stmt->bind_param('iisid', $orderId, $productId, $product['name'], $product['quantity'], $product['price']);
        $stmt->execute();

        $ingredientQuery = "SELECT product_ingredients FROM product WHERE product_id = ?";
        $stmt = $link->prepare($ingredientQuery);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $stmt->bind_result($productIngredientsJson);
        $stmt->fetch();
        $stmt->close();

        $productIngredients = json_decode($productIngredientsJson, true);

        foreach ($productIngredients as $ingredient) {
            $inventoryId = $ingredient['inventory_id'];
            $ingredientQuantity = $ingredient['quantity'] * $product['quantity'];

            $updateInventoryQuery = "UPDATE inventory SET quantity = quantity - ? WHERE inventory_id = ?";
            $stmt = $link->prepare($updateInventoryQuery);
            $stmt->bind_param('ii', $ingredientQuantity, $inventoryId);
            $stmt->execute();
        }
    }

    echo json_encode(['status' => 'success', 'queue_no' => $queue_no]);

} else {
    echo json_encode(['status' => 'error']);
}
?>