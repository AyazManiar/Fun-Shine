<?php
// Use __DIR__ for safe path resolution
include __DIR__ . '/../../config/db_connect.php';
include __DIR__ . '/../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $category_id = generate_uuid();
        $category_name = $_POST['category_name'];
        $stmt = $conn->prepare("INSERT INTO categories (category_id, category_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $category_id, $category_name);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_category'])) {
        $category_id = $_POST['category_id'];
        $conn->query("DELETE FROM product_category WHERE category_id = '$category_id'");
        $conn->query("DELETE FROM categories WHERE category_id = '$category_id'");
    }
}

$categories = $conn->query("SELECT category_id, category_name FROM categories");
?>
<div class="categories">
    <h1 class="poppins">Categories</h1>
    <form method="POST" action="" class="add-category-form">
        <div class="form-group">
            <label for="category_name">Add New Category:</label>
            <input type="text" id="category_name" name="category_name" required>
        </div>
        <button type="submit" name="add_category" class="btn">Add Category</button>
    </form>
    <table class="category-table">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cat = $categories->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $cat['category_name']; ?></td>
                    <td>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="category_id" value="<?php echo $cat['category_id']; ?>">
                            <button type="submit" name="delete_category" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <?php if ($categories->num_rows == 0) { ?>
                <tr><td colspan="2">No categories found.</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $conn->close(); ?>