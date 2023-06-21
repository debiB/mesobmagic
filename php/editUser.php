<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";

$updateUser  = function($input, $conn){

    $update_stmt = "UPDATE `user` SET `first_name`= ?,`last_name`=?,`dob`=?,`email`=?,`country`=?,`job_title`=? ,`password`=?, `avatar` = ? WHERE uid = ?";

    $stmt = $conn->prepare($update_stmt);

    
        if (!$stmt) {
            return false;
        }

        
    
        $stmt->bind_param(
            "ssssssssi",
            $input["first_name"],
            $input["last_name"],
            $input['dob'],
            $input["email"],
            $input["country"],
            $input["job_title"],
            $input["password"],
            $input["avatar"],
            $_SESSION['uid']

        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
          
            return false;
        }

};

$updateUserNoPW  = function($input, $conn){

    $update_stmt = "UPDATE `user` SET `first_name`= ?,`last_name`=?,`dob`=?,`email`=?,`country`=?,`job_title`=? ,`avatar` = ? WHERE uid = ?";

    $stmt = $conn->prepare($update_stmt);

    
        if (!$stmt) {
            return false;
        }

        
    
        $stmt->bind_param(
            "sssssssi",
            $input["first_name"],
            $input["last_name"],
            $input['dob'],
            $input["email"],
            $input["country"],
            $input["job_title"],
            // $input["password"],
            $input["avatar"],
            $_SESSION['uid']

        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
          
            return false;
        }

};


print_r(var_dump($_POST['withPass'] == 'true'));
if(isset($_POST['withPass']) && $_POST['withPass'] == 'true'){

    $path = "avatars";
    // ($_FILES);

    $select_img = "SELECT avatar from user WHERE uid = " .$_SESSION['uid'] .";";

    print_r($select_img);

    $result = $conn->query($select_img);

    if ($result->num_rows > 0){
    $img = $result->fetch_assoc()['avatar'];
    if (file_exists($img)) {
        if (unlink($img)) {
            echo 'File deleted successfully.';
        } else {
            echo 'Unable to delete the file.';
        }
    } else {
        echo 'File does not exist.';
    }

    }

    include "/opt/lampp/htdocs/mesobmagic/php/uploadImages.php";
    $input = [
        "first_name"=>$_POST['first_name'],
        "last_name"=>$_POST['last_name'],
        "dob"=>$_POST['dob'],
        "email"=>$_POST['email'],
        "country"=> $_POST['country'],
        "job_title"=>$_POST['job'],
        "password"=>password_hash($_POST['pass'], PASSWORD_DEFAULT),
        "avatar"=>$imagePath
    ];

    if($updateUser($input, $conn)){
        echo "Successful";
        
    }
    else{
        echo "AHHHHHH";
    }



}
else if(isset($_POST['withPass'])){

    

    $path = "avatars";
    // ($_FILES);


    $select_img = "SELECT avatar from user WHERE uid = " .$_SESSION['uid'] .";";


    $result = $conn->query($select_img);

    if ($result->num_rows > 0){
    $img = $result->fetch_assoc()['avatar'];
    

    }
    print_r(!isset($_FILES['photo']));
    if(!isset($_FILES['photo'])){
            print_r($_FILES);
            $sourceFilePath = $img;
            echo $img;

            $tmpFilePath = tempnam(sys_get_temp_dir(), 'tmpfile');

            copy($sourceFilePath, $tmpFilePath);

            $_FILES['photo'] = array(
                'name' => basename($sourceFilePath),
                'type' => mime_content_type($sourceFilePath),
                'tmp_name' => $tmpFilePath,
                'error' => 0,
                'size' => filesize($sourceFilePath)
            );


    }
    if (file_exists($img)) {
        if (unlink($img)) {
            echo 'File deleted successfully.';
        } else {
            echo 'Unable to delete the file.';
        }
    } else {
        echo 'File does not exist.';
    }

    include "/opt/lampp/htdocs/mesobmagic/php/uploadImages.php";
    $input = [
        "first_name"=>$_POST['first_name'],
        "last_name"=>$_POST['last_name'],
        "dob"=>$_POST['dob'],
        "email"=>$_POST['email'],
        "country"=> $_POST['country'],
        "job_title"=>$_POST['job'],
        "password"=>password_hash($_POST['pass'], PASSWORD_DEFAULT),
        "avatar"=>$imagePath
    ];

    if($updateUserNoPW($input, $conn)){
        echo "Successful";
        
    }
    else{
        echo "AHHHHHH";
    }



}



?>