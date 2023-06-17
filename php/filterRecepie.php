<?php
include '/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php';

$fetchByIngredient =  function($ing, $conn){

    $ans = array();
 
    $filter_stmt = "SELECT * FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `ingredients` LIKE '%_!" . $ing ."_!%' GROUP BY `ratings`.`rid`;
    ";
    
    // -- // echo $filter_stmt;


    $result = $conn->query($filter_stmt);
    return $result;

    // if ($result->num_rows > 0) {
    //   while($row = $result->fetch_assoc()) {
    //     $ans[] = $row;
    //   }
    //   return $ans;
    // } else {
    //   return [];
    // }
    // mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent
    
};

$fetchByCuisineType = function($cus, $conn){
 
    $ans = array();
    $cus  = ucwords($cus);
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `cuisine` = '{$cus}' GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);
    return $result;

    // if ($result->num_rows > 0) {
    //   while($row = $result->fetch_assoc()) {
    //     $ans[] = $row;
    //   }
    //   return $ans;
    // } else {
    //   return [];
    // }
    
};

$getAuthorIds = function($fname, $lname, $conn){
  $filter_stmt = "SELECT `uid`  FROM `user` WHERE `first_name` = '$fname' AND `last_name` = '$lname';";
  $result = $conn->query($filter_stmt);

  $ans = [];

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $ans[] = $row; 
  }
}


    $s = [];
    foreach($ans as $uid){
      $s[] = strval($uid['uid']);
    }
    // print_r(join(",", $s));

    return join(",", $s);
};

$fetchByAuthor = function($author, $conn){
 
    $author = explode(" ", ucwords($author));
    $author_id_list = $GLOBALS['getAuthorIds']($author[0], $author[1], $conn);
    print_r($author_id_list);

    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `author` in ($author_id_list) GROUP BY `recepie`.`rid`;";
    $result = $conn->query($filter_stmt);

    return $result;
    // if ($result->num_rows > 0) {
    //   while($row = $result->fetch_assoc()) {
    //     $ans[] = $row;
    //   }
    //   return $ans;
    // } else {
    //   return [];
    // }
    // $conn->close();
    
};
$fetchByPrepTime =  function($prept, $conn){
 
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `prep_time` <= {$prept} GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);
    return $result;

    // if ($result->num_rows > 0) {
    //   while($row = $result->fetch_assoc()) {
    //     $ans[] = $row;
    //   }
    //   return $ans;
    // } else {
    //   return [];
    // }
    
};
$fetchByCookTime = function($cookt, $conn){
 
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `cook_time` <= {$cookt} GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);
    return $result;

    // if ($result->num_rows > 0) {
    //   while($row = $result->fetch_assoc()) {
    //     $ans[] = $row;
    //   }
    //   return $ans;
    // } else {
    //   return [];
    // }
    
};
$fetchByDifficulty = function($diff, $conn){

    $diff = ucwords($diff);
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `difficulty_level` = '{$diff}' GROUP BY `recepie`.`rid`;";
    
    $result = $conn->query($filter_stmt);
    return $result;

    // if ($result->num_rows > 0) {
    //   while($row = $result->fetch_assoc()) {
    //     $ans[] = $row;
    //   }
    //   return $ans;
    // } else {
    //   return [];
    // }
    
};

$fetchByName = function($name, $conn){
    $name = ucwords($name);
    $ans = array();
    $filter_stmt = "SELECT `recepie`.`rid`, `recipe_name`, `image_url`, `author`, AVG(`rating`) as rating FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `recipe_name` LIKE '% ". $name. " %'  OR `recipe_name` LIKE '%". $name. " %' OR `recipe_name` LIKE '% ". $name. "%' OR `recipe_name` = '". $name. "' GROUP BY `recepie`.`rid`;";
    $result = $conn->query($filter_stmt);
    return $result;
    
};

$fetchSingleItem = function($rid, $conn){
    $filter_stmt = "SELECT *, COUNT(`rating`) as count, AVG(`rating`) as avg FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` WHERE `recepie`.`rid` = {$rid} GROUP BY `recepie`.`rid`;";

    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();

    } else {
      return [];
    }

};

$getAuthor = function($id, $conn){
    if($id == null){
        $id = 1;
    }
    $select_stmt = "SELECT * FROM `user` WHERE uid = " .$id . ";";
    $result = $conn->query($select_stmt);

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();

    } else {
      return [];
    }


};

$fetchByMultipleIds = function($input, $conn){
  $res = [];
  foreach($input as $item){
    $res[] = $GLOBALS['fetchSingleItem']($item, $conn);
  }
  return $res;
};

$popularN = function($n, $conn){
    $filter_stmt = "SELECT *, COUNT(`rating`) as count, AVG(`rating`) as avg FROM `recepie` LEFT JOIN `ratings` ON `ratings`.`rid` = `recepie`.`rid` GROUP BY `recepie`.`rid` ORDER BY rating DESC LIMIT $n;
    ";
    $result = $conn->query($filter_stmt);

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();

    } else {
      return [];
    }
};





?>