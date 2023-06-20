<?php include  "/opt/lampp/htdocs/mesobmagic/inc/header.php"?>
  <div class="post_main_container">
    <h1 class ="post-header">+ Add a recipie</h1>
    <hr class = "post_separator_line" style="color: white; margin:5%;">
    <form id="post_recipeForm" method="post" action = "postRecepie.php" enctype="multipart/form-data">
      <div>
        <label class = "post_label" for="recipeName">Recipe Name:</label>
        <input type="text" id="recipeName" name="recipeName" class = "post_input">
        <span class="error" id="recipeNameError"></span>
      </div>
      <div>
      <label class = "post_label">Photo:</label>
        <img id="imagePreview" src="#" alt="Image Preview" style="display: none;" width="200px">
        
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
          <li>
            <input type="text" name="ingredient[]" class = "post_input">
            <button type="button" class="removeIngredient">X</button>
          </li>
        </ol>
        <button type="button" id="addIngredient">Add Ingredient</button>
        <span class="error" id="ingredientsError"></span>
      </div>
      <div>
        <label class = "post_label" for = "desc">Description:</label>
        <div class="directions" id="desc_directions">Share a story behind your recipe and what makes it special.</div>
        <textarea id="desc" rows="5" col="5" name = "description" placeholder="Describe your recpie"></textarea>
        <span class="error" id="desceError"></span>
      </div>
      <div>
        <label class = "post_label" for="description">Instruction:</label>
        <div class ="directions">Explain how to make your recipe, including oven temperatures, baking or cooking times, and pan sizes, etc.</div>
        <br>
        <div id="stepsContainer">
          <div class="step-container">
            <label for="description">Step 1</label>
            <div class="steps">
              <textarea id="description" name="step[]" placeholder="Enter step description"></textarea>
              <button type="button" class="removeStep">X</button>
            </div>
          </div>
        </div>
        <button type="button" id="addStep">Add Step</button>
        <span class="error" id="descriptionError"></span>
        
      <div>
        <label class = "post_label" for="prepTime">Preparation Time:</label>
        <input type="number" id="prepTime" name="prepTime" min = "1" oninput="calculateSum()" class = "post_input">
        <span class="error" id="prepTimeError"></span>
      </div>
      <div>
        <label class = "post_label" for="cookTime">Cook Time:</label>
        <input type="number" id="cookTime" name="cookTime" min="1" oninput="calculateSum()" class = "post_input">
        <span class="error" id="cookTimeError"></span>
      </div>
      <div class ="calc">
        <p class = "total_time">Total time:</p>
        <p id="result"></p>
      </div>
      <div>
        <label  class = "post_label" for="cuisine">Cuisine Type:</label>
        <select id="cuisine" name="cuisine">
          <option value="">Select Cuisine</option>
          <option value="italian">Italian</option>
          <option value="indian">Indian</option>
          <option value="chinese">Chinese</option>
          <!-- Add more cuisine options as needed -->
        </select>
        <span class="error" id="cuisineError"></span>
      </div>
      <div>
        <label class = "post_label" for="difficulty">Difficulty:</label>
        <select id="difficulty" name="difficulty">
          <option value="">Select Difficulty</option>
          <option value="easy">Easy</option>
          <option value="medium">Medium</option>
          <option value="hard">Hard</option>
        </select>
        <span class="error" id="difficultyError"></span>
      </div>
      <button type="submit">Submit</button>
    </form>
    
  </div>
</div>
<script src="../scripts/post.js"></script>
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
<script src="https://apis.google.com/js/api.js"></script>
<!-- <script src="../scripts/ajax.js"></script> -->
<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php"?>