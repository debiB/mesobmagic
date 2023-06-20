<?php
    session_start();
    
    include("/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php");
    include("/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php");

 

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

        $select_img = "SELECT image_url from recepie WHERE rid = " .$input["rid"] .";";

        // print_r($input);

//         $result = $conn->query($select_img);

//     if ($result->num_rows > 0){
//       $img = $result->fetch_assoc()['image_url'];
//       if (file_exists($img)) {
//         if (unlink($img)) {
//             echo 'File deleted successfully.';
//         } else {
//             echo 'Unable to delete the file.';
//         }
//     } else {
//         echo 'File does not exist.';
// }

//     }

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
        $del_stmt = "DELETE FROM `recepie` WHERE rid = $rid";

        print_r($del_stmt);
        $img = $GLOBALS['fetchSingleItem']($rid, $conn)['image_url'];
        
        if (unlink($img)) {
            echo "Image deleted successfully!";
        } else {
            echo "Failed to delete image.";
        }


        $stmt = $conn->query($del_stmt);

        if ($stmt) {
            echo "Recipe deleted successfully!";
            return true;
        } else {
            echo "Failed to delete recipe.";
            return false;
        }

    };

    
    // print_r($_POST);

    if(isset($_POST['recipeName'])){

        $ingredients = array();

        // foreach($ingredients as $ingredient){
        //     $ingredients[] = join(",", $ingredient);
        // }

        $path = "recpie-images";

        $ingredients = join("_!", $_POST['ingredient']);
        $instructions = join("_!", $_POST['step']);

        include "/opt/lampp/htdocs/mesobmagic/php/uploadImages.php";
        // print_r("HERE $imagePath");
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
            "author"=> $_SESSION['uid']];
        
        print_r($input);
        
        if($_POST['function'] == "create")
            $createPost($input, $conn);
        else if ($_POST['function'] == "update"){
            $input['rid'] = $_POST['rid'];

            

            $updatePost($input, $conn);
        }
       
        // print_r($input);
        
    }

    else if (isset($_POST['function']) && $_POST['function'] == "delete"){
        $rid = intval($_POST['rid']);
        if($deletePost($rid, $conn))
            echo "deleted";
    }







    



?>
