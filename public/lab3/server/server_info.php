<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: server_info_redirect.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Information</title>
</head>
<body>
    <h1>Server Information</h1>
    
    <div>
        <h2>Basic Server Information</h2>
        <table>
            <tr>
                <th>Information</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Client IP Address</td>
                <td><?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?></td>
            </tr>
            <tr>
                <td>Browser Information</td>
                <td><?php echo htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'Not available'); ?></td>
            </tr>
            <tr>
                <td>Current Script</td>
                <td><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?></td>
            </tr>
            <tr>
                <td>Request Method</td>
                <td><?php echo htmlspecialchars($_SERVER['REQUEST_METHOD']); ?></td>
            </tr>
            <tr>
                <td>Server Script Path</td>
                <td><?php echo htmlspecialchars($_SERVER['SCRIPT_FILENAME']); ?></td>
            </tr>
            <tr>
                <td>Server Name</td>
                <td><?php echo htmlspecialchars($_SERVER['SERVER_NAME']); ?></td>
            </tr>
            <tr>
                <td>Server Software</td>
                <td><?php echo htmlspecialchars($_SERVER['SERVER_SOFTWARE']); ?></td>
            </tr>
            <tr>
                <td>Server Protocol</td>
                <td><?php echo htmlspecialchars($_SERVER['SERVER_PROTOCOL']); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
