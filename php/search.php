<?php include "/opt/lampp/htdocs/mesobmagic/inc/header.php" ?>
<?php include('/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php');?>
<?php

?>


<div class="container">
  <label for="search" class="searchtxt">Search</label>
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="get" id  = "cont">
  <div class="search-container">
    
    <input type="text" id="search" name = "input">
    <button type="submit"class="search-container button" id = "search-btn" ></button>
    
  </div>  
  <label for="filter" class="searchtxt">Filter by</label>
  <select id="filter" class="filter" name="function">
    <option value="name"     >Name</option>
    <option value="cusine"     >Cusine</option>
    <option value="ingredient"  > Ingredient</option>
    <option value="prep_time"    >Preparation Time</option>
    <option value="difficulty"   > Diffculty</option>
    <option value="author" >Author</option>
  </select>
  </form>
</div>


<?php

$functions = [
  "name"=>$fetchByName,
  "difficulty"=>$fetchByDifficulty,
  "prep_time"=>$fetchByPrepTime,
  "author"=>$fetchByAuthor,
  "ingredient"=>$fetchByIngredient,
  "cusine"=>$fetchByCuisineType

];


$ans = array();

$result = NULL;
if (isset($_GET['function']) && isset($_GET['input']))
{
  $fun = $functions[$_GET['function']];
  $arg = $_GET['input'];
  $result = $fun($arg, $conn);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ans[] = $row;
        
      }
}
}
else{
  $result = $fetchByDifficulty("Hard", $conn);
  while($row = $result->fetch_assoc()) {
    $ans[] = $row;
}
} 
?>
<?php 
// print_r($_GET);
if ((isset($_GET['function']) && isset($_GET['input']))):
?>
  
  <p class="search-info"><?php echo "{$result->num_rows} recipes found with {$_GET["function"]} : {$_GET["input"]}"; ?></p>
<?php endif; ?>
<div class="card-wrapper1">
  <?php
  foreach ($ans as $item) :
  ?>
    <div class="card">

      <img class="recipie_pic" src="https://www.alphafoodie.com/wp-content/uploads/2023/01/Falafel-square.jpeg">
      <p class="auth"><?php echo $item['author'] ?></p>
      <a href="single_item.php?recipe=<?php echo $item['rid']; ?>">
        <p class="r_name"><?php echo $item['recipe_name'] ?></p>
      </a>

      <div class="ratings-stars">
        <div id="rating-number" class="rating-number">
          <?php $avg_rating = $item['rating'];

          if ($avg_rating == null) $avg_rating = 0;
          echo $avg_rating; ?>
        </div>
        <div class="stars">
          <?php $avg_rating = $item['rating'];

          if ($avg_rating == null) $avg_rating = 0;


          $i = 0;
          while ($i < 5) {
            if ($i < $avg_rating) {
              echo "<span class=\"star\">&#9733;</span>";
            } else {
              echo "<span class=\"star\">&star;</span>";
            }
            $i++;
          }
          ?>
        </div>


      </div>
    </div>

  <?php endforeach; ?>



</div>

<script src= "../scripts/filter.js">
</script>
<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php"; ?>