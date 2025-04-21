<?php
if(isset($_POST["submit"])) {
    $targetDir = "uploads/";
    
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    
    if(!is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
        echo "Error: The file was not uploaded properly.";
        $uploadOk = 0;
    }
    
    if($_FILES["fileToUpload"]["size"] > $maxFileSize) {
        echo "Error: File size exceeds the limit of 2MB.";
        $uploadOk = 0;
    }
    
    $allowedTypes = array("jpg", "jpeg", "png");
    if(!in_array($imageFileType, $allowedTypes)) {
        echo "Error: Only JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }
    
    if(file_exists($targetFile)) {
        $fileBaseName = pathinfo($fileName, PATHINFO_FILENAME);
        $newFileName = $fileBaseName . "_" . date("YmdHis") . "." . $imageFileType;
        $targetFile = $targetDir . $newFileName;
        echo "A file with the same name already exists. The file will be saved as: " . $newFileName . "<br>";
    }
    
    if($uploadOk == 1) {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $fileInfo = pathinfo($targetFile);
            $fileSize = round(filesize($targetFile) / 1024, 2); // Size in KB
            
            echo "<h2>File successfully uploaded</h2>";
            echo "File name: " . basename($targetFile) . "<br>";
            echo "File type: " . $imageFileType . "<br>";
            echo "File size: " . $fileSize . " KB<br>";
            echo "<a href='" . $targetFile . "' download>Download file</a><br><br>";
            echo "<a href='index.html'>Back to form</a> | <a href='list.php'>View all files</a>";
        } else {
            echo "Error uploading the file.";
        }
    }
} else {
    header("Location: index.html");
    exit();
}
