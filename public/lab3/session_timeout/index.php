<?php
session_start();

if (isset($_GET['session_expired'])) {
    session_unset();
    session_destroy();
}

$timeout_duration = 10;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout_duration)) {

    if (isset($_GET['session_expired'])) {
        session_unset();
        session_destroy();
    }
    
    header("Location: " . $_SERVER['PHP_SELF'] . "?session_expired=1");
    exit;
}

$_SESSION['last_activity'] = time();

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
        
        $_SESSION['last_activity'] = time();
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}

$is_logged_in = isset($_SESSION['user']) && $_SESSION['user']['logged_in'] === true;

$remaining_time = 0;
if ($is_logged_in && isset($_SESSION['last_activity'])) {
    $remaining_time = $timeout_duration - (time() - $_SESSION['last_activity']);
    if ($remaining_time < 0) { $remaining_time = 0; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Timeout</title>
    <?php if ($is_logged_in): ?>
    <script>
        let timeLeft = <?php echo $remaining_time; ?>;
        
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            const formattedTime = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            document.getElementById("timer").innerHTML = formattedTime;
            
            if (timeLeft <= 60) {
                document.getElementById("timer-container").classList.add("warning");
            }
            
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            } else {
                window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?session_expired=1";
            }
        }
        
        window.onload = function() {
            updateTimer();
        };
    </script>
    <?php endif; ?>
</head>
<body>
    <h1>Session Timeout</h1>
    
    <?php if (isset($_GET['session_expired'])): ?>
        <div>
            <h3>Session Expired</h3>
            <p>Your session has expired due to inactivity. Please log in again.</p>
        </div>
    <?php endif; ?>
    
    <?php if ($is_logged_in): ?>
        <div>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
            <p>You are successfully logged in.</p>
            <p>Login time: <?php echo date('Y-m-d H:i:s', $_SESSION['user']['login_time']); ?></p>
            
            <div id="timer-container">
                Session expires in: <span id="timer"></span>
            </div>
            
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
