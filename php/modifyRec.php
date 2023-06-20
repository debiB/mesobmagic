<?php
session_start();

include "/opt/lampp/htdocs/mesobmagic/inc/header.php";
include "/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php";

?>

<?php 
if (!isset($_POST['name'])):?>

<div class="nav_del_container">
<h1 class="delete-recipie_text">- Delete recipe</h1>
  <form class = "del-form-field" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="name" class="delete-search-input" id="search-bar" placeholder="Search...">
    <a><button class="delete-search-button"><i class="material-icons">search</i></button></a>
  </form>
<!-- <h1 class="delete-recipie_text">- Delete recpie</h1>
  <form class = "del-form-field" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="name" class="delete-search-input" id="search-bar" placeholder="Search...">
    <a><button  class="delete-search-button"><i class="material-icons">search</i></button></a>
  </form> -->


  <p class="unfiltered-list"> Your Posts </p>
  <?php
  $posts = $getByAuthorId($_SESSION['uid'], $conn);
  // print_r($posts);
  foreach ($posts as $post) : ?>

    <div class="delete-recipe-card">
      <div class="delete-imgtxt" style="max-width:410px; flex-wrap:wrap;">
        <img src="<?php echo $post['image_url']; ?>" class="delete-recipe-image">
        <p class="delete-recipe-name" style="text-align: right; font-size: 30px; margin-right:50px"><a href="<?php echo 'single_item.php?recipe='. strval($post['rid'])?>"><?php echo $post['recipe_name']; ?></a>
      </p>
      <div class="stars" style="display:block">
          <?php
          $avg_rating = $post['rating'];
          if ($avg_rating == null) $avg_rating = 0;
          $i = 0;
          while ($i < 5) {
            if ($i < $avg_rating) {
              echo "<span style = \"color: black;\" class=\"star\">&#9733;</span>";
            } else {
              echo "<span style = \"color:black\" class=\"star\">&star;</span>";
            }
            $i++;
          }
          ?>
        </div>
        
      </div>
      
      <div class="delete-recipe-date">Published on <?php
                                                    $dateString = $post['date_published'];
                                                    $date = DateTime::createFromFormat('Y-m-d', $dateString);

                                                    if ($date) {
                                                      $formattedDate = $date->format('M d, Y');
                                                      echo $formattedDate; // Output: Jun 10, 2023
                                                    } else {
                                                      echo "Invalid date format";
                                                    } ?></div>
      <div class="delete-recipe-buttons">
        <a href="#"><button id="delete_recpie_button" data-rid="<?php echo $post['rid'];?>"
        ><i data-rid = "<?php echo $post['rid'];?>" class="material-icons" onclick="deleteConfirm()">delete</i></button></a>
        <script>
          function deleteConfirm() {
            var con = window.confirm("Are you sure you want to delete your recpie?");
            if(con){
              deletePost(event);
            }
          }
        </script>
        <a><button><i data-rid = "<?php echo $post['rid'];?>" onclick = "handleEvent(event)" class="material-icons">edit</i></button></a>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php endif;?>
<?php if (($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['name'])):?>
  <?php $name = $_POST['name'];
  
  ?>
  
<div class="nav_del_container">
  <h1 class="delete-recipie_text">- Delete recpie</h1>
  <form class = "del-form-field" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="name" class="delete-search-input" id="search-bar" placeholder="Search...">
    <a><button  class="delete-search-button"><i class="material-icons">search</i></button></a>
  </form>
  <p class="unfiltered-list"> Your Posts </p>
  <?php
  $posts = $getByAuthorIdAndName($_SESSION['uid'], $name, $conn);
  // print_r($posts);
  foreach ($posts as $post) : ?>

    <div class="delete-recipe-card">
      <div class="delete-imgtxt" style="max-width:410px; flex-wrap:wrap;">
        <img src="<?php echo $post['image_url']; ?>" class="delete-recipe-image">
     
        <p class="delete-recipe-name" style="text-align: right; font-size: 30px; margin-right:50px"><a href="<?php echo 'single_item.php?recipe='. strval($post['rid'])?>"><?php echo $post['recipe_name']; ?></a>
      </p>
      <div class="stars" style="display:block">
          <?php
          $avg_rating = $post['rating'];
          if ($avg_rating == null) $avg_rating = 0;
          $i = 0;
          while ($i < 5) {
            if ($i < $avg_rating) {
              echo "<span style = \"color: black;\" class=\"star\">&#9733;</span>";
            } else {
              echo "<span style = \"color:black\" class=\"star\">&star;</span>";
            }
            $i++;
          }
          ?>
        </div>
        
      </div>
      
      <div class="delete-recipe-date">Published on <?php
                                                    $dateString = $post['date_published'];
                                                    $date = DateTime::createFromFormat('Y-m-d', $dateString);

                                                    if ($date) {
                                                      $formattedDate = $date->format('M d, Y');
                                                      echo $formattedDate; // Output: Jun 10, 2023
                                                    } else {
                                                      echo "Invalid date format";
                                                    } ?></div>
      <div class="delete-recipe-buttons">
        <a href="#"><button id="delete_recpie_button" data-rid="<?php echo $post['rid'];?>"
        ><i data-rid = "<?php echo $post['rid'];?>" class="material-icons" onclick="deleteConfirm()">delete</i></button></a>
        <script>
          function deleteConfirm() {
            var con = window.confirm("Are you sure you want to delete your recpie?");
            if(con){
              deletePost(event);
            }
          }
        </script>
        <a><button><i data-rid = "<?php echo $post['rid'];?>" onclick = "handleEvent(event)" class="material-icons">edit</i></button></a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php endif;?>
<script src="../scripts/delete-ajax.js"></script>

<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php" ?>