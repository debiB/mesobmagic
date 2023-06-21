<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php";
include "/opt/lampp/htdocs/mesobmagic/inc/header.php";
include "/opt/lampp/htdocs/mesobmagic/php/commentsController.php";


// session_start();
$recipe = intval($_REQUEST['recipe']);
$data = $fetchSingleItem($recipe, $conn);


$cookieName = $_SESSION['uid'];
$viewedRecipes = [];
if(isset($_COOKIE[$cookieName]))
    $viewedRecipes = unserialize($_COOKIE[$cookieName]);

$recipeId = $recipe; 

if (empty($viewedRecipes)) {
    $viewedRecipes = [];
}

if (!in_array($recipeId, $viewedRecipes)) {
    array_push($viewedRecipes, $recipeId);
    
    if(count($viewedRecipes) > 10){
    $viewedRecipes = array_slice($viewedRecipes, -10, 10);
    }
}

setcookie($cookieName, serialize($viewedRecipes), time() + (30 * 24 * 60 * 60));




?>
<?php include "/opt/lampp/htdocs/mesobmagic/php/sessionStarter.php"?>

<div style="visibility:hidden; min-height:15em;"></div>

    <div class="top-single-item">
        <div class= "top-title">
        <h1 class="single-item-title"><?php echo $data['recipe_name'] ?> </h1><a  class="single-auth-link" href="<?php echo 'userProfile.php?user=' . $data['author'];?>"><small class="single-item-author"> by <?php
        if(isset($data['author'])){
        $auth = $getAuthor($data['author'], $conn);
        $name = $auth['first_name'] . " " . $auth['last_name'];}
        else{
            $name = "";
        }
        echo  $name ?></small></a> on <i>
        <p> <?php 
        $dateString = $data['date_published']; // Example date string in dd-mm-yyyy format
        // echo $dateString;
        $date = DateTime::createFromFormat('Y-m-d', $dateString);

        if ($date) {
            $formattedDate = $date->format('M d, Y');
            echo $formattedDate; // Output: Jun 10, 2023
        } else {
            echo "Invalid date format";
        }
        
        ?></p></i></div>
        <div class="single-item-img">
        
            <img src="<?php echo $data['image_url']?>" alt="<?php echo $data["recipe_name"] ?>" >
            <div class="single-item-rating">
                <span id = "single-stars"></span>
                <span class="single-count"> <?php echo round( $data["avg"], 1); ?> (<?php echo $data["count"] ?> reviews)</span>
            </div>

        </div>


        <div class="single-item-section">
           
            <h2> Description </h1> 
                <p><?php echo $data['description']; ?></p>
        </div>

        <div class="single-item-section">
            <h2> Ingredients</h1>
                <ul>
                    <?php $ing_array  = explode("_!", $data['ingredients'], 10);
                    foreach ($ing_array as $ing_item) : ?>
                        <li> <?php echo $ing_item ?> </li>
                    <?php endforeach; ?>

                </ul>
        </div>

        <div class="single-item-section">
            <h2> Instructions</h1>
                <ol>
                    <?php $inst_array  = explode("_!", $data['instructions']);
                    // print_r($inst_array);
                    foreach ($inst_array as $inst_item) :
                        if ($inst_item) :
                    ?>
                            <li>
                                <?php echo $inst_item; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </ol>
        </div>

        <div class = "single-item-section">
            <h2>Recommended Time in the Kitchen</h2>
            <b>Estimated Preparation Time:</b> <span><?php echo $data["prep_time"]?> minutes    </span><br/>
            <b>Estimated Cook Time: </b> <span><?php echo $data["cook_time"]?> minutes</span><br/>
            <b>TotalTime: </b> <span><?php echo $data["total_time"]?> minutes</span>
            
        </div>

        <div class = "single-item-section">
            <h2>Cuisine Type</h2>
            <p> <?php echo ucwords($data['cuisine']);?></p>
            
        </div>

        <div class = "single-item-section">
            <h2>Difficulty Level</h2>
            <p> <?php echo $data['difficulty_level'];?></p>
            
        </div>


        <hr>
<br>
        <div id="star-rating">
  <div class="rate-me"> Care to rate this Recpie?</div>
  <span class="star" data-rating="1">&#9733;</span>
  <span class="star" data-rating="2">&#9733;</span>
  <span class="star" data-rating="3">&#9733;</span>
  <span class="star" data-rating="4">&#9733;</span>
  <span class="star" data-rating="5">&#9733;</span>
</div>
<input type="hidden" id="rating-input" name="rating">
<span id = "notice"></span>    


        

    </div>

    <div class="comments-container">
    <h1 class="comment-opener">Comments</h1>

    <div class="user-comment" data-rid="<?php echo $recipe;?>">
    <div class="write">Write a comment.</div>
    <textarea placeholder="Comment: Question, Suggestion, Chef's Kiss?"> </textarea>
    <br>
    <input type= "button" class="submit-comment" value="Submit Comment" onclick="saveOGComment(event)">
</div>

<hr>

    <div class="comment-section">

    <?php
    
    $top_comments = $getComment($recipe, NULL, $conn);
    if($top_comments->num_rows > 0){

        $R_comments = [];
        
    
        while($comment = $top_comments->fetch_assoc()){
            $R_comments[]  = $comment;
        }


    }




    
    if(isset($R_comments)):
   foreach($R_comments as $comment):
    
    
    ?>

    <div class="comment-div">
    <p class="comment-text"> <?php echo $comment['comment'];?></p>
    <div class="comment-about">


        <span  data-comm_id = "<?php echo $comment["cid"]?>" class="material-symbols-outlined comment-reply" onclick="showReply(event)">reply
    </span>

    
    

    <span class=  "comment-by"> by <a href="userProfile.php?user=<?php echo $comment['uid']?>"><?php
    
        $comm_author = $getAuthor($comment['uid'], $conn);
        echo $comm_author['first_name']. " ". $comm_author["last_name"];
    
    
    ?></a></span>
    <span class="comment-on"> on <?php $dateString = $comment['ts']; 
        $date = DateTime::createFromFormat('Y-m-d', $dateString);

        if ($date) {
            $formattedDate = $date->format('M d, Y');
            echo $formattedDate; 
        } else {
            echo "Invalid date format";
        }?></span>
    <span data-rcid = "<?php echo $comment['cid']?>"
    data-rid = "<?php echo $comment['rid']?>" 
    class="material-symbols-outlined expand-comment">

    
    
expand_more
</span>
<span id = "comm-<?php echo $comment["cid"]?>" class="reply-box" style="display:none">
    
    <input type = "text" name = "reply-<?php echo $comment["cid"] ?>">
    <span class="material-symbols-outlined send-symb" onclick="handleReply(event)">
send
</span>
    </span>
</div>
    <div id = "sub-<?php echo $comment['cid']?>"  class= "sub-comment"></div>
    </div>

    <?php endforeach;?>
    <?php endif;?>

        



    </div>


    </div>
    <!-- <div id="rate-stars">

    <img src="../images/stars/empty.png" onclick = "rate()" onclick="rate()"/>
    <img src="../images/stars/empty.png" onclick = "rate()" onclick="rate()"/>
    <img src="../images/stars/empty.png" onclick = "rate()" onclick="rate()"/>
    <img src="../images/stars/empty.png" onclick = "rate()" onclick="rate()"/>
    <img src="../images/stars/empty.png" onclick = "rate()" onclick="rate()" />

    </div> -->
  


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src = "../scripts/comments-ajax.js"></script>
    <script >
        let stars = document.getElementById("single-stars");
        var i = 0;
        let rating = "<?php echo round($data["avg"], 1);?>";
        console.log(rating);
        let img;
        while (i <= 4){
            img = document.createElement('img');
            if( i < rating && i+1 <= rating){
                img.setAttribute("src", "../images/stars/full.png");
            }
            else if(i < rating && i+1 > rating){
                img.setAttribute("src", "../images/stars/half.png");
            }
            else{
                img.setAttribute("src", "../images/stars/empty.png");
            }
            img.setAttribute("onclick", "rate()");

            stars.appendChild(img);
            i+=1

        }


        const stars_ = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating-input");

        stars_.forEach((star) => {
        star.addEventListener("mouseover", () => {
            const rating = star.dataset.rating;
            setRating(rating);
        });

        star.addEventListener("mouseout", () => {
            resetRating();
        });

        star.addEventListener("click", () => {
  const rating = star.dataset.rating;
  ratingInput.value = rating;
  setRating(rating);
  uid = parseInt("<?php echo $_SESSION['uid']?>", 10);
  rid = parseInt("<?php echo $_REQUEST['recipe']?>", 10);
  console.log(uid, rid);
  submitRating(uid, rid, rating);
});

        });

        function setRating(rating) {
        stars_.forEach((star) => {
            if (star.dataset.rating <= rating) {
            star.classList.add("hover");
            } else {
            star.classList.remove("hover");
            }
        });
        }

        function resetRating() {
        stars_.forEach((star) => {
            star.classList.remove("hover");
        });
        }

        function submitRating(user_uid, recipe_rid, user_rating) {
  var xhr = new XMLHttpRequest();
  var url = "ratings.php"; 
  var data = new FormData();
  data.append('uid', user_uid);
  data.append('rid', recipe_rid);
  data.append('rating', user_rating);

  xhr.open("POST", url, true);

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("notice").textContent = xhr.responseText;
    }
  };

  xhr.send(data);
}



            

    </script>

<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php"; ?>