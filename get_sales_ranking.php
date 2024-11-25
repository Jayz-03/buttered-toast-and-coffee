<?php
$host = 'localhost';
$dbname = 'btncs_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get filter type from the request
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'daily';
    
    // Define SQL query based on the filter
    switch ($filter) {
        case 'weekly':
            $query = "
                SELECT 
                    p.product_name, 
                    CONCAT(YEAR(s.transaction_date), '-', WEEK(s.transaction_date)) AS period, 
                    SUM(si.quantity * si.price) AS total_sales,
                    RANK() OVER (PARTITION BY YEAR(s.transaction_date), WEEK(s.transaction_date) ORDER BY SUM(si.quantity * si.price) DESC) AS rank
                FROM sales s
                JOIN sale_items si ON s.sale_id = si.sale_id
                JOIN product p ON si.product_id = p.product_id
                WHERE s.status = 'completed'
                GROUP BY p.product_name, YEAR(s.transaction_date), WEEK(s.transaction_date)
                ORDER BY period, rank;
            ";
            break;

        case 'monthly':
            $query = "
                SELECT 
                    p.product_name, 
                    CONCAT(YEAR(s.transaction_date), '-', MONTH(s.transaction_date)) AS period, 
                    SUM(si.quantity * si.price) AS total_sales,
                    RANK() OVER (PARTITION BY YEAR(s.transaction_date), MONTH(s.transaction_date) ORDER BY SUM(si.quantity * si.price) DESC) AS rank
                FROM sales s
                JOIN sale_items si ON s.sale_id = si.sale_id
                JOIN product p ON si.product_id = p.product_id
                WHERE s.status = 'completed'
                GROUP BY p.product_name, YEAR(s.transaction_date), MONTH(s.transaction_date)
                ORDER BY period, rank;
            ";
            break;

        case 'yearly':
            $query = "
                SELECT 
                    p.product_name, 
                    YEAR(s.transaction_date) AS period, 
                    SUM(si.quantity * si.price) AS total_sales,
                    RANK() OVER (PARTITION BY YEAR(s.transaction_date) ORDER BY SUM(si.quantity * si.price) DESC) AS rank
                FROM sales s
                JOIN sale_items si ON s.sale_id = si.sale_id
                JOIN product p ON si.product_id = p.product_id
                WHERE s.status = 'completed'
                GROUP BY p.product_name, YEAR(s.transaction_date)
                ORDER BY period, rank;
            ";
            break;

        default: // Daily
            $query = "
                SELECT 
                    p.product_name, 
                    DATE(s.transaction_date) AS period, 
                    SUM(si.quantity * si.price) AS total_sales,
                    RANK() OVER (PARTITION BY DATE(s.transaction_date) ORDER BY SUM(si.quantity * si.price) DESC) AS rank
                FROM sales s
                JOIN sale_items si ON s.sale_id = si.sale_id
                JOIN product p ON si.product_id = p.product_id
                WHERE s.status = 'completed'
                GROUP BY p.product_name, DATE(s.transaction_date)
                ORDER BY period, rank;
            ";
            break;
    }

    // Execute the query
    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($results);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
