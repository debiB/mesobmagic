<?php

ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 0);
session_start();
include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";
$getUserByEmail = function($email, $conn){
    $select_stmt = "SELECT * FROM `user` WHERE email = '" . $email . "';";
    $result = $conn->query($select_stmt);
    // echo $select_stmt;
    if($result->num_rows > 0){
    return $result->fetch_assoc();
    }
    else{
      return [];
    }
    
  };

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data = $getUserByEmail($_POST['signin-email'], $conn);
    

    $_SESSION['uid'] = intval($data['uid']);
    header("Location: userProfile.php?user=" . $_SESSION['uid']);
}









?>
