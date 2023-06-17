<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";

$saveFeedback = function($uid, $feedback, $conn){
    $insert_stmnt = "INSERT INTO `feedback`(`email`, `feedback`) VALUES ('$uid','$feedback')";
    // print_r($insert_stmnt);
    $result = $conn->query($insert_stmnt);
    if($result){
        return true;
    }
    else{
        return false;
    }
};

// print_r($_POST);

if($_SERVER['REQUEST_METHOD'] =="POST" ){
    $saveFeedback($_POST['email'], $_POST['feedback'], $conn);
}


?>