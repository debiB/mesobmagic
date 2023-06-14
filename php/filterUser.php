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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id']; // Assuming the user ID is passed in the 'id' parameter
  $user = $getUser($id, $conn);

  // Return the user data as JSON
  header('Content-Type: application/json');
  echo json_encode($user);
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
