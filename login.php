<?php
session_start();
include 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists
    $query = "SELECT * FROM member WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['idmember'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['profile']; // 'admin' or 'member'

        // Redirect to dashboard based on role
        if ($user['profile'] == 'admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: member_dashboard.php');
        }
    } else {
        echo "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/page.css">
</head>
<body>
    <div class="container">
        <h1>Login Page</h1>
        <?php if (!empty($error_message)): ?>
            <p class="error"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" id="username" name="username" placeholder="username" required>
            <br><br>
            <input type="password" id="password" name="password" placeholder="password" required>
            <br><br>
            <input type="submit" value="Login">
        </form>
        <br>
        <p>belum memiliki akun? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>