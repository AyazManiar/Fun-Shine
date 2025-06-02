<?php
    require_once '../config/db_connect.php';
    
    $content = "
    <div class='products-page'>
        <header class='products-page-header'>
            <h1>Products</h1>
            <div class='product-searchbar'> 
                <img src='../assets/images/icons/search.svg' alt='search-icon'>
                <input type='search'>
            </div>
        </header>
        <div class='products-page-content'>
            <div class='prod-list-header'>
                <h2>Products List </h2>
                <img id='add-icon' src='../assets/images/icons/add.svg'>
            </div>
            <div class='pgc-top'>
                <table class='product-list'>
                    <tr class='list-header'>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Categories</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Created at</th>
                        <th>Average Rating</th>
                        <th>Number of Ratings</th>
                        <th>Delete</th>
                    </tr>
    ";
    $result = $conn->query('SELECT * from products');
    while($row = $result->fetch_assoc()){
        $prod_id = intval($row['prod_id']);
        $categories_result = $conn->query(
                "SELECT c.category_name
                        FROM products p
                        INNER JOIN product_categories pc ON p.prod_id = pc.prod_id
                        INNER JOIN categories c ON pc.category_id = c.category_id
                        WHERE p.prod_id = $prod_id"
                    );
        // 'MySQLi result object' to 'Array'
        $categories = [];
        while ($category = $categories_result->fetch_assoc()) {
            $categories[] = $category['category_name'];
        }
        // Array to String with delimiter(,)
        $categories_string = implode(",", $categories);
        $content .= "
                    <tr
                        data-id={$prod_id}
                    >
                        <td class='product'>
                            <img src='../assets/images/products/{$row['prod_img']}' alt='product image'>
                            <p>{$row['prod_name']}
                        </td>
                        <td>{$row['brand']}</td>
                        <td>{$categories_string}</td>
                        <td>{$row['prod_desc']}</td>
                        <td>₹{$row['prod_price']}</td>
                        <td>{$row['prod_stock']}</td>
                        <td>{$row['prod_created_at']}</td>
                        <td>{$row['avg_rating']}</td>
                        <td>{$row['num_ratings']}</td>
                        <td
                            class='delete-icon'
                            data-id={$prod_id}
                        >
                            <lord-icon
                                style='cursor: pointer'
                                src='https://cdn.lordicon.com/xyfswyxf.json'
                                trigger='hover'
                                colors='primary:#911710'
                                style='width:250px;height:250px'>
                            </lord-icon>
                        </td>
                    </tr>
        ";
    }
    $content .= "
                </table>
            </div>
        </div>
    </div>    
    ";
    echo $content;
    
    
?>