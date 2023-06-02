<?php
if (isset($_POST['recipeName'])) {
    print_r($_FILES);
    $targetDirectory = "../uploads/recpie-images";
    $extension = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
    $uniqueName = uniqid() . '.' . $extension;
    $targetFile = $targetDirectory . $uniqueName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    // Check the file size (optional)
    // if ($_FILES["photo"]["size"] > 500000) {
    //     echo "File is too large.";
    //     $uploadOk = 0;
    // }

    // Allow only certain file formats (optional)
    if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png" && $imageFileType !== "gif") {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If all checks pass, move the file to the target directory and save the recipe details in the database
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Save the recipe details and image path in the database
            $imagePath = $targetFile;
            
    }
}}
?>