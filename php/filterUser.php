<?php
// filterUser.php

include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";
$getUser = function($id, $conn) {
  $select_stmt = "SELECT * FROM `user` WHERE uid = " . $id . ";";
  $result = $conn->query($select_stmt);

  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return [];
  }
};

$isValidEmail= function($email, $conn){
  $select_stmt = "SELECT * FROM `user` WHERE email = '" . $email . "';";
  $result = $conn->query($select_stmt);
  // echo $select_stmt;
  if ($result->num_rows > 0) {
    echo "false";
  } else {
    
    echo "true";
  }
};

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



// print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['id'])){
  $id = $_POST['id']; // Assuming the user ID is passed in the 'id' parameter
  $user = $getUser($id, $conn);

  // Return the user data as JSON
  header('Content-Type: application/json');
  echo json_encode($user);
  }
  else if (isset($_POST['func']) && $_POST['func'] == 'email'){
    // print_r($_POST);
    echo ($isValidEmail($_POST['email'], $conn));
  }
  else if (isset($_POST['func2'])){
    $data = $getUserByEmail($_POST['email'], $conn);
    // print_r($_POST);
    if (count($data) > 0) {
      if (password_verify($_POST['password'], $data['password'])) {
          // Password is correct
          // Proceed with the login process
          echo "";
      } else {
          // Password is incorrect
          echo "Incorrect Email or Password.";
      }
  } else {
      // No such email
      echo "No such email";
  }
}
  
      
    
  }


$calcReputation = function($uid, $conn){
  $stmt = "SELECT sum(rating)as s FROM recepie INNER JOIN ratings on ratings.rid = recepie.rid WHERE author = $uid;
  ";
  // echo $stmt;
  $result = $conn->query($stmt);
  if ($result->num_rows > 0){
    return intval($result->fetch_assoc()["s"]);
  }
  else{
    return 0;
  }
};



// echo $calcReputation(2102, $conn);

?>
