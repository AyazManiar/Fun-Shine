<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="signup-container">
        <h2 class="poppins">Admin Sign Up</h2>
        <?php
        session_start();
        if (isset($_SESSION['admin_id'])) {
            header("Location: admin.php");
            exit();
        }

        // Verify inclusion of functions.php
        if (!file_exists(__DIR__ . '/../includes/functions.php')) {
            die("Error: functions.php not found in includes directory. Expected path: " . realpath(__DIR__ . '/../includes/functions.php'));
        }
        require_once __DIR__ . '/../includes/functions.php';

        // Check if generate_uuid function exists
        if (!function_exists('generate_uuid')) {
            die("Error: generate_uuid() function is not defined. Please ensure it is included in functions.php.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Use __DIR__ for safe path resolution
            include __DIR__ . '/../config/db_connect.php';

            $name = $_POST['name'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate email uniqueness
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<p class='error'>Email already exists. Please use a different email.</p>";
            } else {
                // Generate user_id and hash password
                $user_id = generate_uuid();
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $is_admin = 1; // Set as admin

                // Insert new admin user
                $stmt = $conn->prepare("INSERT INTO users (user_id, name, phone_number, email, password_hash, is_admin) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssi", $user_id, $name, $phone_number, $email, $password_hash, $is_admin);
                if ($stmt->execute()) {
                    echo "<p class='success'>Admin account created successfully! <a href='login.php'>Log in here</a>.</p>";
                } else {
                    echo "<p class='error'>Error creating account. Please try again.</p>";
                }
            }
            $stmt->close();
            $conn->close();
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p class="signup-link">Already have an account? <a href="login.php">Log in here</a>.</p>
    </div>
</body>
</html>