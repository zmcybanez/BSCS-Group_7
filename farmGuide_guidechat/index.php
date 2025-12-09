<?php
// index.php - Login page with improved error handling and logging
session_start();
include 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: chat.php");
    exit();
}

$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'] ?? '';
    
    // Validate inputs
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address";
        error_log("Index.php: Invalid email provided for login: $email");
    } elseif (empty($password) || strlen($password) < 6) { // Basic password length check
        $error = "Password is required and must be at least 6 characters";
        error_log("Index.php: Invalid password length for email: $email");
    } else {
        // Prepare and execute query
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ? LIMIT 1");
        if (!$stmt) {
            error_log("Index.php: Prepare failed: " . $conn->error);
            $error = "Database error. Please try again later.";
        } else {
            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                error_log("Index.php: Execute failed for email: $email - " . $stmt->error);
                $error = "Database error. Please try again later.";
            } else {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $user = $result->fetch_assoc();
                    if (password_verify($password, $user['password'])) {
                        // Successful login
                        $_SESSION['user_id'] = (int)$user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['logged_in_at'] = time(); // Optional: Track login time for session management
                        
                        error_log("Index.php: Successful login for user_id: " . $user['id'] . " (email: $email)");
                        
                        // Regenerate session ID for security (session fixation prevention)
                        session_regenerate_id(true);
                        
                        header("Location: chat.php");
                        exit();
                    } else {
                        $error = "Invalid password";
                        error_log("Index.php: Invalid password for email: $email");
                    }
                } else {
                    $error = "No user found with that email";
                    error_log("Index.php: No user found for email: $email");
                }
            }
            $stmt->close();
        }
    }
}

// Close connection if open (though db.php might handle it, explicit is better)
if (isset($conn)) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmGuide - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-card">
            <h1>FarmGuide Chat</h1>
            <p>Connect with other farmers and share insights</p>
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <form method="POST" action="" novalidate> <!-- novalidate to allow custom validation -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>" required autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" minlength="6">
                </div>
                <button type="submit">Login</button>
            </form>
            <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
    
    <!-- Optional: Add client-side validation with JS for better UX -->
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            if (!email || !password || password.length < 6) {
                e.preventDefault();
                alert('Please enter a valid email and password (at least 6 characters).');
            }
        });
    </script>
</body>
</html>