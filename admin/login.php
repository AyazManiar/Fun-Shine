<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="login-container">
        <h2 class="poppins">Admin Login</h2>
        <?php
        session_start();
        if (isset($_SESSION['admin_id'])) {
            header("Location: admin.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Use __DIR__ for safe path resolution
            include __DIR__ . '/../config/db_connect.php';

            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT user_id, password_hash, is_admin FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password_hash']) && $user['is_admin'] == 1) {
                    $_SESSION['admin_id'] = $user['user_id'];
                    header("Location: admin.php");
                    exit();
                } else {
                    echo "<p class='error'>Invalid email or password, or not an admin.</p>";
                }
            } else {
                echo "<p class='error'>Invalid email or password.</p>";
            }
            $stmt->close();
            $conn->close();
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="signup-link">Don't have an account? <a href="signup.php">Sign up here</a>.</p>
    </div>
</body>
</html>