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






    



?>