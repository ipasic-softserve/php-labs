<?php
if (isset($_POST['delete_cookie'])) {
    setcookie("username", "", time() - 3600);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['submit']) && isset($_POST['username'])) {
    setcookie("username", $_POST['username'], time() + (7 * 24 * 60 * 60));
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie</title>
</head>
<body>
    <h1>Cookie</h1>
    
    <?php if (isset($_COOKIE['username'])): ?>
        <div>
            <h2>Welcome back, <?php echo htmlspecialchars($_COOKIE['username']); ?>!</h2>
        </div>
        
        <form method="post">
            <button type="submit" name="delete_cookie">Delete Cookie</button>
        </form>
    <?php else: ?>
        <form method="post">
            <h2>Please enter your name:</h2>
            <input type="text" name="username" required>
            <button type="submit" name="submit">Save</button>
        </form>
    <?php endif; ?>
</body>
</html>
