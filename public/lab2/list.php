<?php
$targetDir = "uploads/";

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

echo "<h2>List of Uploaded Files</h2>";

$files = scandir($targetDir);
$hasFiles = false;

echo "<ul>";
foreach($files as $file) {
    if($file != "." && $file != "..") {
        $hasFiles = true;
        $filePath = $targetDir . $file;
        $fileSize = round(filesize($filePath) / 1024, 2); // Size in KB
        
        echo "<li>";
        echo "File: " . $file . " (" . $fileSize . " KB) ";
        echo "<a href='" . $filePath . "' download>Download</a>";
        echo "</li>";
    }
}
echo "</ul>";

if(!$hasFiles) {
    echo "<p>No files have been uploaded yet.</p>";
}

echo "<p><a href='index.html'>Back to form</a></p>";
