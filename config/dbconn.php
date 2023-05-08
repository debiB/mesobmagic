<?php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'Amanuel');
define('DB_PASS', 'passaman');
define('DB_NAME', 'mesobmagic');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error){
    die('Connection Failed' . $conn->error);
}
else{
    // echo "Connected";
}

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
    $conn->close();
    
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
    $conn->close();
    
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
    $conn->close();
    
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
    $conn->close();
    
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
    $conn->close();
    
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
    $conn->close();
    
}