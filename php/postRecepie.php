<?php

    include("/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php");

    

    $createPost = function ($input, $conn) {
        $insert_stmt = "INSERT INTO `recepie` (
            `recipe_name`, `description`, `ingredients`, `instructions`,
            `prep_time`, `cook_time`, `cuisine`, `difficulty_level`,
            `image_url`, `author`
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($insert_stmt);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "ssssiiisssi",
            $input["recepie_name"],
            $input["description"],
            $input["ingredient"],
            $input["instruction"],
            $input["prep_time"],
            $input["cook_time"],
            $input["total_time"],
            $input["cusine"],
            $input["difficulty"],
            $input["image_url"],
            $input["author"]
        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    };

    $updatePost = function ($input, $conn) {
        $update_stmt = "UPDATE `recepie` SET
            `recipe_name` = ?,
            `description` = ?,
            `ingredients` = ?,
            `instructions` = ?,
            `prep_time` = ?,
            `cook_time` = ?,
            `total_time` = ?,
            `cuisine` = ?,
            `difficulty_level` = ?,
            `image_url` = ?,
            `author` = ?
        WHERE
            `rid` = ?";
    
        $stmt = $conn->prepare($update_stmt);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "ssssiiisssii",
            $input["recepie_name"],
            $input["description"],
            $input["ingredient"],
            $input["instruction"],
            $input["prep_time"],
            $input["cook_time"],
            $input["total_time"],
            $input["cusine"],
            $input["difficulty"],
            $input["image_url"],
            $input["author"],
            $input["rid"]
        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
          
            return false;
        }
    };

    $deletePost = function ($rid, $conn) {
        $del_stmt = "DELETE FROM `recepie` WHERE rid = ?";
    
        $stmt = $conn->prepare($del_stmt);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param("i", $rid);
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    };

    // Assuming you have a database connection object called $conn

$input = array(
    
    "rid" => 1, // Assuming the recipe ID you want to update is 1
    "recepie_name" => "Updated Recipe Name",
    "description" => "Updated recipe description",
    "ingredient" => "Updated ingredient list",
    "instruction" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum, illo ab voluptate autem labore saepe est? Libero accusamus nulla, tempora, nemo ipsum quas itaque similique perferendis delectus ab excepturi reprehenderit.",
    "prep_time" => 45, // Integer value for prep_time
    "cook_time" => 30, // Integer value for cook_time
    "total_time" => 75,
    "cusine" => "Mexican",
    "difficulty" => "Hard",
    "image_url" => "https://example.com/updated-image.jpg",
    "author" => 3
);

$result = $updatePost($input, $conn);

if ($result) {
    echo "Recipe updated successfully.";
} else {
    echo "Error updating recipe.";
}



    



?>