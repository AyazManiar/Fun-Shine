<?php
    require_once '../config/db_connect.php';

    $data = json_decode(file_get_contents(
        "php://input"
    ));
    $prodId = $data->prodId;
    $userId = isset($data->userId) ? intval($data->userId) : 1;
    $cart = $conn->query(" 
        SELECT * FROM cart 
        WHERE user_id=$userId AND prod_id=$prodId;"
    );
    if($row = $cart->fetch_assoc()){
        // Increase Quantity
        $quantity = $row['quantity'] + 1;

        $sql = "UPDATE cart SET quantity=$quantity 
                WHERE user_id=$userId AND prod_id=$prodId;";
        if($conn->query($sql)){
            echo 'success';
            exit;
        }
        else{
            echo "query not sent to database";
            exit;
        }
    }
    else{
        $quantity=1;
        $sql = "INSERT INTO cart (user_id, prod_id, quantity)
                 VALUES ($userId, $prodId, $quantity);
        ";
        if($conn->query($sql)){
            echo 'success';
            exit;
        }
        else{
            echo "query not sent to database";
            exit;
        }
    }

?>