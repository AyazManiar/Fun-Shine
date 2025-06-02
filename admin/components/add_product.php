<?php
require_once '../config/db_connect.php';

// Fetch categories from DB
$sql = 'SELECT * FROM categories';
$categories = $conn->query($sql);

// HTML form
echo '
    <div class="edit_product-page">
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name:</label><br>
            <input type="text" name="prod_name"><br><br>

            <label>Brand:</label><br>
            <input type="text" name="brand"><br><br>

            <label>Categories:</label><br>
            <select name="categories[]" multiple size="5">
';

if ($categories) {
    while ($row = $categories->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
    }
}

echo '
            </select><br><br>

            <label>Description:</label><br>
            <textarea name="prod_desc"></textarea><br><br>

            <label>Price:</label><br>
            <input type="number" step="0.01" name="prod_price"><br><br>

            <label>Stock:</label><br>
            <input type="number" name="prod_stock"><br><br>

            <label>Product Image:</label><br>
            <input type="file" name="prod_image"><br><br>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
';


// Handle form submission
if (isset($_POST['submit'])) {
    $prodName = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $prodDesc = mysqli_real_escape_string($conn, $_POST['prod_desc']);
    $prodPrice = floatval($_POST['prod_price']);
    $stock = intval($_POST['prod_stock']);
    $categories = $_POST['categories'];

    $imageName = '';
    if (isset($_FILES['prod_image']) && $_FILES['prod_image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['prod_image']['name']);
        $uploadPath = '../assets/images/products/' . $imageName;

        // Check if file exists in folder or DB
        $checkSql = "SELECT * FROM products WHERE prod_image = '$imageName'";
        $checkResult = $conn->query($checkSql);

        if (file_exists($uploadPath) || $checkResult->num_rows > 0) {
            echo "<p>❌ Image with the same name already exists.</p>";
            $imageName = ''; // Do not save if duplicate
        } else {
            move_uploaded_file($_FILES['prod_image']['tmp_name'], $uploadPath);
        }
    }

    // Only proceed if image saved or no image uploaded
    $sql = "INSERT INTO products (product_name, brand, description, price, stock, prod_image)
            VALUES ('$prodName', '$brand', '$prodDesc', $prodPrice, $stock, '$imageName')";

    if ($conn->query($sql)) {
        $productId = $conn->insert_id;

        // Add category mapping (if needed)
        foreach ($categories as $catId) {
            $catId = intval($catId);
            $conn->query("INSERT INTO product_categories (product_id, category_id) VALUES ($productId, $catId)");
        }

        echo "<p>✅ Product added successfully.</p>";
    } else {
        echo "<p>❌ Failed to add product: " . $conn->error . "</p>";
    }
}
?>
