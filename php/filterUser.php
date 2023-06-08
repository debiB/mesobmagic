
<?php

  $getUser = function($id, $conn){

    $select_stmt = "SELECT * FROM `user` WHERE uid = " .$id . ";";
    $result = $conn->query($select_stmt);

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();

    } else {
      return [];
    }

    


  }
?>
