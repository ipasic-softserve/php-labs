<?php
session_start();

$valid_username = "admin";
$valid_password = "root";

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user'] = [
            'username' => $username,
            'logged_in' => true,
            'login_time' => time()
        ];
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}

$is_logged_in = isset($_SESSION['user']) && $_SESSION['user']['logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
</head>
<body>
    <h1>Session Management</h1>
    
    <?php if ($is_logged_in): ?>
        <div>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
            <p>You are successfully logged in.</p>
            <p>Login time: <?php echo date('Y-m-d H:i:s', $_SESSION['user']['login_time']); ?></p>
            
            <form method="post">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    <?php else: ?>
        <div>
            <h2>Login</h2>
            
            <?php if (isset($error_message)): ?>
                <div><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
