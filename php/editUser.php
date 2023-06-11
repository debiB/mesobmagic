<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";

$updateUser  = function($input, $conn){

    $update_stmt = "UPDATE `user` SET `first_name`= ?,`last_name`=?,`age`=?,`email`=?,`country`=?,`job_title`=? ,`password`=? WHERE uid = ?";

    $stmt = $conn->prepare($update_stmt);

    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "ssissssi",
            $input["first_name"],
            $input["last_name"],
            $input['age'],
            $input["email"],
            $input["country"],
            $input["job_title"],
            password_hash($input["password"], PASSWORD_DEFAULT),
            $_SESSION['uid']

        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
          
            return false;
        }

};

$input = [
    "first_name"=>"john",
    "last_name"=>"doe",
    "age"=>20,
    "email"=>"jdoe@gmail.com",
    "country"=> "Other",
    "job_title"=>"Student",
    "password"=>"password"
];

if($updateUser($input, $conn)){
    echo "Successful";
    
}
else{
    echo "AHHHHHH";
}

?>