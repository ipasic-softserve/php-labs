<?php
$logFile = "log.txt";

if(isset($_POST["submitText"]) && !empty($_POST["textContent"])) {
    $text = $_POST["textContent"] . "\n";
    
    if(file_put_contents($logFile, $text, FILE_APPEND) !== false) {
        echo "<p>Text successfully added to the log file.</p>";
    } else {
        echo "<p>Error writing to the log file.</p>";
    }
}

echo "<h2>Log File Content:</h2>";

if(file_exists($logFile)) {
    $fileContent = file_get_contents($logFile);
    if($fileContent !== false) {
        echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
    } else {
        echo "<p>Unable to read the log file.</p>";
    }
} else {
    echo "<p>Log file does not exist yet.</p>";
}

echo "<p><a href='index.html'>Back to form</a></p>";
