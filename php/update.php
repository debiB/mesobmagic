<?php include  "/opt/lampp/htdocs/mesobmagic/inc/header.php";
include "/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php";

$rid = intval($_POST['rid']);
$data =  $fetchSingleItem($rid, $conn);
$ingredients = explode('_!', $data['ingredients']);
$steps = explode('_!', $data['instructions']);
print_r($_POST);
?>



  <div class="post_main_container">
    <h1 class ="post-header">&#128394; Edit recipie</h1>
    <hr class = "post_separator_line" style="color: white; margin:5%;">
    <form id="edit-post_recipeForm" method="post" action = "postRecepie.php" enctype="multipart/form-data">
      <input type="hidden" value="<?php echo $rid;?>" name= "rid">
      <div>
        <label class = "post_label" for="recipeName">Recipe Name:</label>
        <input type="text" id="recipeName" name="recipeName" class = "post_input" value = "<?php echo $data['recipe_name'];?>">
        <span class="error" id="recipeNameError"></span>
      </div>
      <div>
      <label class = "post_label">Photo:</label>
        <img id="imagePreview" src="<?php echo $data['image_url'];?>" alt="Image Preview"  width="200px">
      
        <div class="photo_container">
          <label for="photo" id="file-upload-label">Choose a file</label>
          <input type="file" id="photo" name="photo" onchange="previewImage(event)">
          <span class="upload-status" style="padding: 1vh;">No file selected</span>
        </div>
        <span class="error" id="photoError" style="display: block"></span>
      </div>
      
      <div>
        <label class = "post_label" class = "ing">Ingredients:</label>
        <div class ="directions" id = "ing_direction">Enter one ingredient per line. Include the quantity (i.e. cups, tablespoons) and any special preparation (i.e. sifted, softened, chopped). </div>
        <ol id="ingredientsList">
          <?php 
          $i =  0;
          foreach ($ingredients as $ingredient):?>
          <li>
            <?php if($i == 0):?>
            <input type="text" name="ingredient[]" class = "post_input" value = "<?php echo $ingredient?>">
            <button type="button" class="removeIngredient">X</button>
            <?php else:?>
            <input type="text" name="ingredient[]" class = "post_input" value = "<?php echo $ingredient?>" >
            <button type="button" class="removeIngredient" onclick="removeIngredient(event)">X</button>
            <?php 
          endif;?>
          <?php $i+=1;?>
          </li>
          <?php endforeach;?>
        </ol>
        <button type="button" id="addIngredient">Add Ingredient</button>
        <span class="error" id="ingredientsError"></span>
      </div>
      <div>
        <label class = "post_label" for = "desc">Description:</label>
        <div class="directions" id="desc_directions">Share a story behind your recipe and what makes it special.</div>
        <textarea id="desc" rows="5" col="5" name = "description" placeholder="Describe your recpie"><?php echo $data["description"];?></textarea>
        <span class="error" id="desceError"></span>
      </div>
      <div>
        <label class = "post_label" for="description">Instructions:</label>
        <div class ="directions">Explain how to make your recipe, including oven temperatures, baking or cooking times, and pan sizes, etc.</div>
        <br>
        <div id="stepsContainer">
          <?php 
          $i = 0;
          foreach($steps as $step):?>
          <?php if($i == 0):?>
          <div class="step-container">
            <label for="description">Step <?php echo ($i+1);?></label>
            <div class="steps">
              <textarea id="description" name="step[]" placeholder="Enter step description"><?php echo $step;?></textarea>
              <button type="button" class="removeStep">X</button>
            </div>
          </div>
        <?php else:?>
          <div class="step-container">
            <label for="description">Step <?php echo ($i+1);?></label>
            <div class="steps">
              <textarea id="description" name="step[]" placeholder="Enter step description"><?php echo $step;?></textarea>
              <button type="button" class="removeStep" onclick="removeStep(event)">X</button>
            </div>
          </div>
        <?php endif;
        $i+=1;
        ?>
      <?php endforeach;?>
        </div>
        <button type="button" id="addStep">Add Step</button>
        <span class="error" id="descriptionError"></span>
        
      <div>
        <label class = "post_label" for="prepTime">Preparation Time:</label>
        <input type="number" id="prepTime" name="prepTime" min = "1" oninput="calculateSum()" class = "post_input"
        value = "<?php echo $data["prep_time"];?>">
        <span class="error" id="prepTimeError"></span>
      </div>
      <div>
        <label class = "post_label" for="cookTime">Cook Time:</label>
        <input type="number" id="cookTime" name="cookTime" min="1" oninput="calculateSum()" class = "post_input" value = "<?php echo $data["cook_time"];?>">
        <span class="error" id="cookTimeError"></span>
      </div>
      <input type="hidden" name="function" value="update">
      <div class ="calc">
        <p class = "total_time">Total time:</p>
        <p id="result"> <?php echo $data["prep_time"] + $data["cook_time"];?></p>
      </div>
      <div>
      <label class="post_label" for="cuisine">Cuisine Type:</label>
<select id="cuisine" name="cuisine">
  <option value="">Select Cuisine</option>
  <option value="italian" <?php echo ($data["cuisine"] == 'italian') ? 'selected' : ''; ?>>Italian</option>
  <option value="indian" <?php echo ($data["cuisine"] == 'indian') ? 'selected' : ''; ?>>Indian</option>
  <option value="chinese" <?php echo ($data["cuisine"] == 'chinese') ? 'selected' : ''; ?>>Chinese</option>
  <!-- Add more cuisine options as needed -->
</select>
<span class="error" id="cuisineError"></span>

      </div>
      <div>
      <label class="post_label" for="difficulty">Difficulty:</label>
<select id="difficulty" name="difficulty">
  <option value="">Select Difficulty</option>
  <option value="easy" <?php echo ($data["difficulty_level"] == 'easy') ? 'selected' : ''; ?>>Easy</option>
  <option value="medium" <?php echo ($data["difficulty_level"] == 'medium') ? 'selected' : ''; ?>>Medium</option>
  <option value="hard" <?php echo ($data["difficulty_level"] == 'hard') ? 'selected' : ''; ?>>Hard</option>
</select>
<span class="error" id="difficultyError"></span>

      </div>
      <button type="submit">Submit</button>
    </form>
    
  </div>
</div>
<script>

function previewImage(event) {
  var input = event.target;
  var preview = document.getElementById("imagePreview");

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      preview.setAttribute('src', e.target.result);
      preview.style.display = "block";
    }

    reader.readAsDataURL(input.files[0]);
  }
}






</script>
<script src="../scripts/post.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="../scripts/ajax.js"></script>
<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php"?>