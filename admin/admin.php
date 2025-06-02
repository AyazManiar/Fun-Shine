<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="./components/products.css">
</head>
<body>
    <div class="main-container">
        <nav class="admin-left">
            <h1 class="poppins">
                <a href="admin.php">Admin</a>
            </h1>
            <hr style="width: 100%;">
            <ul class="admin-panel">
                <li><a href="?page=products">
                    <h3>Product List</h3>
                </a></li>
                <li><a href="?page=categories">
                    <h3>Categories</h3>
                </a></li>
            </ul>
            <li id="back-to-shop" class="poppins">
                <img src="../assets/images/icons/arrow_left.svg" alt="">
                <a href="../src/index.php">Back to Shop</a>
            </li>
        </nav>
        <div class="admin-right">
            <?php
            $page = empty($_GET['page']) ? 'products' : $_GET['page'];
            $allowed_pages = [
                'products',
                'add_product',
                'edit_product',
                'delete_product',
                'categories'
            ];
            if (in_array($page, $allowed_pages)) {
                include("./components/{$page}.php");
            } else {
                echo "<p>Page not found.</p>";
            }
            ?>
        </div>
    </div>
    
    <script src="admin_script.js"></script>
    <script src="./components/products_script.js"></script>
    <!-- LordIcons -->
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</body>
</html>