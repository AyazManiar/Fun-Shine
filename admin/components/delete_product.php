<?php
    require_once '../../config/db_connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if (isset($data['prod_id'])) {
            $prod_id = intval($data['prod_id']);
            if ($prod_id <= 0) {
                echo 'Invalid product ID';
                http_response_code(400);
                exit;
            }
            
            $sql = "DELETE FROM products WHERE prod_id = $prod_id";
            if ($conn->query($sql)) {
                echo 'success';
                http_response_code(200);  // OK
            } else {
                echo 'Delete failed: ' . $conn->error;
                http_response_code(500);  // Internal Server Error
            }
        } else {
            echo 'prod_id not provided';
            http_response_code(400);  // Bad Request
        }
    } 
    else {
        echo 'Invalid request method';
        http_response_code(405);  // Method Not Allowed
    }
?>
