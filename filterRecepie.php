<?php
include 'config/dbconn.php';

function fetchByIngredient($ing, $conn){

    $ans = array();
 
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid`  WHERE `ingredients` LIKE '%{$ing}%' GROUP BY `ratings`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}

function fetchByCuisineType($cus, $conn){
 
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `cuisine` = '{$cus}' GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}

function fetchByAuthor($author, $conn){
 
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `author` = '{$author}' GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}
function fetchByPrepTime($prept, $conn){
 
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `prep_time` <= {$prept} GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}
function fetchByCookTime($cookt, $conn){
 
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `cook_time` <= {$cookt} GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}
function fetchByDifficulty($diff, $conn){

    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `difficulty_level` = '{$diff}' GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}

function fetchByName($name, $conn){

    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `recipe_name` LIKE ' %{$name}% ' GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
      }
      return $ans;
    } else {
      echo "0 results";
    }
    // $conn->close();
    
}

function fetchSingleItem($rid, $conn){
    $filter_stmt = "SELECT *, COUNT(`rating`) as count, AVG(`rating`) as avg FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `recepie`.`rid` = {$rid} GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();

    } else {
      echo "0 results";
    }

}


// print_r(fetchByCookTime(100, $conn));
// echo '<hr/>';
// print_r(fetchByDifficulty("Easy",$conn));

?>