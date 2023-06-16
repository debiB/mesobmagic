<?php


include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";
include "/opt/lampp/htdocs/mesobmagic/php/filterUser.php";

$registerUser = function($input, $conn){
    $insert_stmt = "INSERT INTO `user`(`first_name`, `last_name`, `email`, `country`, `job_title`, `password`, `avatar`, `dob`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insert_stmt);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param(
        "ssssssss",
        $input["first_name"],
        $input["last_name"],
        $input["email"],
        $input["country"],
        $input["job_title"],
        $input["password"],
        $input["avatar"],
        $input['dob']
    );

    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }
};



if(isset($_POST['dob'])){

    $input = [];
    print_r($_FILES);

    $path = "avatars";


    include "uploadImages.php";

    $input['first_name'] = $_POST['first_name'];
    $input['last_name'] = $_POST['last_name'];
    $input['dob']  = $_POST['dob'];
    $input['email'] = $_POST['email'];
    $input['country'] = $_POST['country'];
    $input['job_title'] = $_POST['job-title'];
    $input['password'] =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $input['avatar'] = $imagePath;


    $registerUser($input, $conn);
    $_SESSION['uid'] = $getUserByEmail($_POST['email'], $conn)['uid'];
    header("Location: userProfile.php?user=". strval($_SESSION['uid']));

}


?>