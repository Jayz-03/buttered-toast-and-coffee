<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $paymentMethod = $data['payment_method'];
    $totalAmount = $data['total_amount'];

    if ($paymentMethod == 'Card') {
        $query = "SELECT balance, limits, status FROM card WHERE status = 0";
        $stmt = $link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($balance, $limits, $status);
        $stmt->fetch();
        $stmt->close();

        if ($status == 1) {
            echo json_encode(['status' => 'error', 'message' => 'Card is unavailable.']);
        }
        elseif (($balance + $totalAmount) > $limits) {
            echo json_encode(['status' => 'error', 'message' => 'Transaction will exceed card limits.']);
        }
        else {
            $new_balance = $balance + $totalAmount;

            $update_query = "UPDATE card SET balance = ? WHERE status = 0";
            $stmt = $link->prepare($update_query);
            $stmt->bind_param('d', $new_balance);
            $stmt->execute();
            $stmt->close();

            echo json_encode(['status' => 'success']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
