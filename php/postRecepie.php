<?php
    session_start();
    
    include("/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php");


 

    $createPost = function ($input, $conn) {

        $insert_stmt = "INSERT INTO `recepie` (
            `recipe_name`, `description`, `ingredients`, `instructions`,
            `prep_time`, `cook_time`, `total_time`, `cuisine`, `difficulty_level`,
            `image_url`, `author`
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    
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
            $_SESSION["uid"]
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
            $_SESSION["uid"],
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

    
    print_r($_POST);

    if(isset($_POST['recipeName'])){

        $ingredients = array();

        // foreach($ingredients as $ingredient){
        //     $ingredients[] = join(",", $ingredient);
        // }

        $ingredients = join("_!", $_POST['ingredient']);
        $instructions = join("_!", $_POST['step']);

        include "/opt/lampp/htdocs/mesobmagic/php/uploadImages.php";
       
        $input = [
            "recepie_name" => $_POST['recipeName'],
            "description" => $_POST['description'],
            "ingredient" => $ingredients,
            "instruction" => $instructions,
            "prep_time"=> $_POST['prepTime'],
            "cook_time"=>$_POST['cookTime'],
            "total_time"=>$_POST['prepTime'] + $_POST['cookTime'],
            "cusine"=> $_POST['cuisine'],
            "difficulty"=>$_POST['difficulty'],
            "image_url"=>$imagePath,
            "author"=>intval($_POST['authorName'])];
        
        
        

        $createPost($input, $conn);
        // print_r($input);
        
    }






    



?>
