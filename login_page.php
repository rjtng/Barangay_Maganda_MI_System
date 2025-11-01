<?php
// Barangay Maganda Login Page
include 'connect.php';

// $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'] ?? '';
    $password = $_REQUEST['password'] ?? '';

    // Use prepared statement to prevent SQL injection
    $query = $connect->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows === 1) {
        // Successful login
        $_SESSION['username'] = $username;
        header("Location: homepage.php");
        exit();
    } else {
        // Invalid credentials — show message on the same page
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Maganda Login</title>
    
</head>
<body>
    <h1>Barangay Maganda Login</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <p>Don't have an account? <a href="create_account_form.html">Create one here</a></p>
        <br>
        <input type="submit" value="Login">

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

    </form>
</body>
</html>