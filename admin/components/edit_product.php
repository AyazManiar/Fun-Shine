<?php
require_once '../../config/db_connect.php';

if (isset($_GET['prod_id'])) {
    $prodId = $_GET['prod_id'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE prod_id = $prodId";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    if ($product) {
        // Get product details
        $prodName = $product['prod_name'];
        $brand = $product['brand'];
        $prodDesc = $product['prod_desc'];
        $prodPrice = $product['prod_price'];
        $stock = $product['prod_stock'];
        $createdAt = $product['prod_created_at'];
        $avgRating = $product['avg_rating'];
        $numRating = $product['num_ratings'];

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get form data
            $prodName = $_POST['prod_name'];
            $brand = $_POST['brand'];
            $prodDesc = $_POST['prod_desc'];
            $prodPrice = $_POST['prod_price'];
            $stock = $_POST['prod_stock'];

            // Update the product in the database
            $sql = "UPDATE products SET 
                        prod_name = '$prodName', 
                        brand = '$brand', 
                        prod_desc = '$prodDesc', 
                        prod_price = '$prodPrice', 
                        prod_stock = '$stock' 
                    WHERE prod_id = $prodId";

            if ($conn->query($sql) === TRUE) {
                // Redirect after successful update
                echo "Product updated successfully.";
                header("Location: ../admin.php?page=products");
                exit;
            } else {
                echo "Error updating product: " . $conn->error;
            }
        }

        // Output the form with current product data
        echo '  
        <div class="edit_product-page">
            <form method="POST" action="./components/edit_product.php?prod_id=' . $prodId . '">
                <label>Product Name:</label><br>
                <input type="text" name="prod_name" value="' . htmlspecialchars($prodName) . '"><br><br>

                <label>Brand:</label><br>
                <input type="text" name="brand" value="' . htmlspecialchars($brand) . '"><br><br>

                <label>Description:</label><br>
                <textarea name="prod_desc">' . htmlspecialchars($prodDesc) . '</textarea><br><br>

                <label>Price:</label><br>
                <input type="number" name="prod_price" step="0.01" value="' . htmlspecialchars($prodPrice) . '"><br><br>

                <label>Stock:</label><br>
                <input type="number" name="prod_stock" value="' . htmlspecialchars($stock) . '"><br><br>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        ';
    } else {
        echo 'Product not found.';
    }
} else {
    echo 'Invalid product ID.';
}
?>
