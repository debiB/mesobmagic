<?php include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";



$getComment = function($rid, $rcid, $conn){

    $select_stmt = "";

    if($rcid == NULL){

        $select_stmt = "SELECT `cid`, `comment`, `uid`, `rid`, `rcid`, `ts` FROM `comments` WHERE ISNULL(rcid) AND rid = $rid";
    }
    else{
        $select_stmt = "SELECT `cid`, `comment`, `uid`, `rid`, `rcid`, `ts` FROM `comments` WHERE rcid = $rcid AND rid = $rid";
    }

    $result = $conn->query($select_stmt);
    return $result;

};




$getCommentJSON = function($rid, $rcid){
    $comments = [];
    $conn = $GLOBALS["conn"];
    $getComment = $GLOBALS['getComment'];
    $result = $getComment($rid, $rcid, $conn);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $comments[] = $row;
        }
    }



    
    return json_encode(array_map("json_encode", $comments));
};

$saveComment = function($comment, $uid, $rid, $rcid, $conn) {
    $insert_stmt = $conn->prepare("INSERT INTO comments (comment, uid, rid, rcid) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("siii", $comment, $uid, $rid, $rcid);
    
    if ($insert_stmt->execute()) {
        return true;
    } else {
        return false;
    }
};



// print_r($_POST);
if(isset($_POST['func']) && $_POST['func'] == "get"){

    $rid = $_POST['rid'];
    $rcid  = $_POST['rcid'];

    echo $getCommentJSON($rid, $rcid);

}

else if(isset($_POST['func']) && $_POST['func'] == "save"){

    $comment = $_POST['comment'];
    $rid = $_POST['rid'];
    $rcid  = $_POST['rcid'];
    $uid = $_SESSION['uid'];
    


    echo $saveComment($comment, $uid,  $rid,  $rcid, $conn);

}

// print_r($POST);





?>
