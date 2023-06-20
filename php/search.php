<?php include "/opt/lampp/htdocs/mesobmagic/inc/header.php" ?>
<?php include('/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php');?>
<?php include "/opt/lampp/htdocs/mesobmagic/php/sessionStarter.php"?>
<?php
session_start();
// print_r($_SESSION);
// include "/opt/lampp/htdocs/mesobmagic/php/sessionStarter.php";
?>
<div style="visibility:hidden; min-height:9em;"></div>
<div class="container">
  <label for="search" class="searchtxt">Search</label>
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="get" id  = "cont" class="search-form">
    <div class="search-container">
      <input type="text" id="search" name="input">
      <button type="submit" id="search-btn"></button>
    </div>  
    <label for="filter" class="searchtxt">Filter by</label>
    <select id="filter" class="filter" name="function">
      <option value="name">Name</option>
      <option value="cusine">Cusine</option>
      <option value="ingredient">Ingredient</option>
      <option value="prep_time">Preparation Time</option>
      <option value="difficulty">Diffculty</option>
      <option value="author">Author</option>
    </select>
  </form>
</div>

<?php
$viewedRecipes = isset($_COOKIE[$_SESSION['uid']]) ? unserialize($_COOKIE[$_SESSION['uid']]) : [];
// print_r($_COOKIE);
$functions = [
  "name" => $fetchByName,
  "difficulty" => $fetchByDifficulty,
  "prep_time" => $fetchByPrepTime,
  "author" => $fetchByAuthor,
  "ingredient" => $fetchByIngredient,
  "cusine" => $fetchByCuisineType
];

$ans = [];

if (isset($_GET['function']) && isset($_GET['input'])) {
  $fun = $functions[$_GET['function']];
  $arg = $_GET['input'];
  $result = $fun($arg, $conn);

  if(!empty($result)){
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $ans[] = $row;
    }
  }
}
} else {
  if (!empty($viewedRecipes)) {
    $ans = $fetchByMultipleIds(array_slice($viewedRecipes, -10), $conn);
    // while ($row = $result->fetch_assoc()) {
    //   $ans[] = $row;
    //}
  }

}


?>
<?php if ((isset($_GET['function']) && isset($_GET['input']))): ?>
  <p class="search-info"><?php echo count($ans) . " recipes found with {$_GET["function"]} : {$_GET["input"]}"; ?></p>

<?php else:?>
  <p class="search-info"><?php echo "Your most recent visits." ?></p>

<?php endif; ?>

<div class="card-wrapper1">
  <?php foreach ($ans as $item) : ?>
    <div class="card">
      <img class="recipie_pic" src="<?php echo $item["image_url"]; ?>">
      <p class="auth"><?php echo $getAuthor($item['author'], $conn)["first_name"] . " " . $getAuthor($item['author'], $conn)["last_name"]; ?></p>
      <a href="single_item.php?recipe=<?php echo $item['rid']; ?>">
        <p class="r_name"><?php echo $item['recipe_name'] ?></p>
      </a>
      <div class="ratings-stars">
        <div id="rating-number" class="rating-number">
          <?php $avg_rating = $item['rating'];
          if ($avg_rating == null) $avg_rating = 0;
          echo round($avg_rating, 1); ?>
        </div>
        <div class="stars">
          <?php
          $avg_rating = $item['rating'];
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

<script src="../scripts/filter.js"></script>
<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php"; ?>
