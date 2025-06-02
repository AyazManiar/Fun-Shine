<?php
    require_once '../config/db_connect.php';
    $prodId = $_GET['prodId'];
    if(isset($prodId)){
        // Product Table
        $sql = "SELECT * from products WHERE prod_id=$prodId";
        $prod = $conn->query($sql);
        $row = $prod->fetch_assoc();
        $prodName = $row['prod_name'];
        $brand = $row['brand'];
        $prodImg = $row['prod_img'];
        $prodDesc = $row['prod_desc'];
        $prodPrice = $row['prod_price'];
        $prodStock = $row['prod_stock'];
        $avgRating = $row['avg_rating'];
        $numRatings = $row['num_ratings'];

        // Categories Table
        $sql = "SELECT c.category_name
                FROM categories c
                JOIN product_categories pc ON c.category_id = pc.category_id
                WHERE pc.prod_id = $prodId;
                ";
        $category_result = $conn->query($sql);
        $category_array = [];
        while($row = $category_result->fetch_assoc()){   
            $category_array[] = $row['category_name'];
        }
        $categories = implode(", ", $category_array);
        // Calculate the rating stars
        $stars = str_repeat("⭐", floor($avgRating)) . str_repeat("☆", 5 - floor($avgRating));


        $content = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Product Detail Page</title>
            <link rel="stylesheet" href="product_details_style.css">
        </head>
        <body>
            <div class="product-container">
                <div class="left-column">
                    <img src="../assets/images/products/'.$prodImg.'" alt="Product Image">
                </div>
            
                <!-- Center Column: Product Details -->
                <div class="center-column">
                    <h1 class="product-name">'.$prodName.'</h1>
                    <p class="brand">Brand: <span>'.$brand.'</span></p>
                    <div class="rating">'.$stars.' <span class="reviews">('.$numRatings.' reviews)</span></div>
                    <div class="categories">
                        '.(empty($categories) ? '' : '<span class="tag">'.$categories.'</span>').'
                    </div>
                    <p class="description">'.$prodDesc.'</p>
                </div>
            
                <!-- Right Column: Buy Box -->
                <div class="right-column">
                    <p class="price">₹'.$prodPrice.'</p>
                    <button class="buy-btn">Add to Cart</button>
                </div>
            </div>
        </body>
        </html>
        ';
        echo $content;
    }
    else{
        echo 'Product with '.$prodId.' not found';
    }
?>
