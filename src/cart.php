<?php
    require_once '../config/db_connect.php';
    $data = json_decode(file_get_contents(
        "php://input"
    ));
    $userId = isset($data->userId) ? intval($data->userId) : 1;

    $sql = "SELECT * from cart WHERE user_id=$userId";
    $result = $conn->query($sql);
    $cartList = [];
    while($row = $result->fetch_assoc()){
        $prodId = $row['prod_id'];
        $quantity = $row['quantity'];
        $prod_result = $conn->query(
            "SELECT * FROM products where prod_id=$prodId"
        );
        $prod = $prod_result->fetch_assoc();

        // Add to cartList 
        $cartList[] = [
            'prodImg' => $prod['prod_img'],
            'prodName' => $prod['prod_name'],
            'quantity' => $quantity,
            'prod_price' => $prod['prod_price'],
            'total_prod_price' => ($quantity * $prod['prod_price'])
        ];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="./cart.css">
</head>
<body>

    <div class="container cart">
        <h1>Your Cart</h1>
        <?php
            if( count($cartList) < 1 ){
                echo "
                <p class='empty-cart'>Your cart is empty.</p>
                ";
                exit;
            }
            ?>
        <!-- Cart Items Table -->
        <table class="cart-list">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
            foreach ($cartList as $item) {
                echo "
                    <tr>
                        <td id='product'>
                            <img src='../assets/images/products/{$item['prodImg']}' alt='{$item['prodName']}' width='50' />
                            <p>{$item['prodName']}</p>
                        </td>
                        <td>{$item['quantity']}</td>
                        <td>₹{$item['prod_price']}</td>
                        <td>₹{$item['total_prod_price']}</td>
                    </tr>
                ";
            }
            ?>
        </table>


        <!-- Total Price -->
        <div class="total-price">
            <strong>
                <?php
                    $totalPrice = 0;
                    foreach ($cartList as $item){
                        $totalPrice += $item['total_prod_price'];
                    }
                    echo '₹'.$totalPrice;
                ?>
            </strong>
        </div>

        <!-- Buttons -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="#" class="btn">Proceed to Checkout</a>
            <a href="./index.php" class="btn" style="background-color: #28a745;">Continue Shopping</a>
        </div>
    </div>

</body>
</html>