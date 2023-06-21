<?php
session_start();
print_r($_FILES);
if (isset($_POST['recipeName']) || isset($_POST['first_name']) ) {
    
    $targetDirectory = "../uploads/$path/";
    $extension = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
    $uniqueName = uniqid() . '.' . $extension;
    // echo $uniqueName;

    $targetFile = $targetDirectory . $uniqueName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $imagePath = "";
   
    if (file_exists($targetFile)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["photo"]["size"] > 500000) {
        echo "File is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png" && $imageFileType !== "gif") {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // print_r($_FILES);
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
            // echo "HERE";
            // 
    }
    // $imagePath = $targetFile;
}}
?>