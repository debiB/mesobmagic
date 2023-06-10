<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";

$rateRecipe = function($uid, $rid, $rating, $conn) {

    $select_stmt = "SELECT `uid`, `rid`, `rating` FROM `ratings` WHERE uid = $uid and rid = $rid;";
    $result = $conn->query($select_stmt);

    if ($result->num_rows > 0) {

        $update_stmt = "UPDATE `ratings` SET `rating`= ? WHERE rid = ? AND uid = ?";

        $stmt = $conn->prepare($update_stmt);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "sss",
            $rating,
            $rid,
            $uid
        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
            return false;
        }
        

    } else {
        $insert_stmt = "INSERT INTO `ratings`(`uid`, `rid`, `rating`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_stmt);
    
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param(
            "sss",
            $uid,
            $rid,
            $rating
        );
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    };
    };


if(isset($_POST["uid"])){
    $uid =  $_POST["uid"];
    $rid = $_POST["rid"];
    $rating = $_POST["rating"];

$rateRecipe($uid, $rid, $rating, $conn);
echo "Your rating has been saved successfully!";
}
?>
