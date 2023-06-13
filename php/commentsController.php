<?php
session_start();
 include "/opt/lampp/htdocs/mesobmagic/inc/config/dbconn.php";
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

$getParentCommentRid  = function($rcid, $conn){
    $stmnt = "SELECT * FROM `comments` WHERE `cid` =  $rcid;";
    $result = $conn->query($stmnt);
    // var_dump($stmnt);
    return $result->fetch_assoc()['rid'];
};


$saveComment = function($comment, $uid, $rid,  $rcid, $conn) {
    var_dump($comment, $uid, $rid, $rcid);
    if($rid == 0)
        $rid = $GLOBALS["getParentCommentRid"](intval($rcid), $conn);
    // return $rid;


    if($rcid!== NULL){
    $insert_stmt = $conn->prepare("INSERT INTO comments (comment, uid, rid, rcid) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("siii", $comment, $uid, $rid, $rcid);
    
    if ($insert_stmt->execute()) {
        return true;
    } else {
        return false;
    }

    }
    else{

    $insert_stmt = $conn->prepare("INSERT INTO comments (comment, uid, rid) VALUES (?, ?, ?)");
    $insert_stmt->bind_param("sii", $comment, $uid, $rid);
    
    if ($insert_stmt->execute()) {
        return true;
    } else {
        return false;
    }

    }
    
};

$saveOGComment = function($comment, $uid, $rid, $conn){

    return $GLOBALS["saveComment"]($comment, $uid, $rid, NULL, $conn);

};

// echo $saveComment("snkdn", 1, 2, $conn);



// print_r($_POST);
if(isset($_POST['func']) && $_POST['func'] == "get"){

    $rid = $_POST['rid'];
    $rcid  = $_POST['rcid'];

    echo $getCommentJSON($rid, $rcid);

}

else if(isset($_POST['func']) && $_POST['func'] == "save"){

    $comment = $_POST['comment'];
    // var_dump($_POST);
    $rcid  = ($_POST['rcid'] != "")? intval($_POST['rcid']) : NULL;
    $uid = intval($_SESSION['uid']);
    $rid = intval($_POST['rid']);

    if($rid == 0){


        if($saveComment($comment, $uid, $rid, $rcid, $conn)){
            echo "success";
        }
        else
        {echo "Fail";}

        }   

else{

    if($saveOGComment($comment, $uid,  $rid, $conn)){
        echo "success";
       }
       else
       {echo "Fail";}
    
    }

}




?>
