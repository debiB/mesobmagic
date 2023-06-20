function submitUpdateForm() {
    // Create a new FormData object
    var formData = new FormData(document.getElementById("post_recipeForm"));
    formData.append("function", "update");
    // Create a new XMLHttpRequest object
    console.log(formData)
    var xhr = new XMLHttpRequest();
  
    // Set up the callback function for the AJAX request
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Request successfu
          console.log(xhr.responseText);
          alert("your recipie has been saved successfuly")
          window.location = "../php/search.php"
        } else {
          // Request failed
          console.log(xhr.status);
        }
      }
    };
  
    // Open the AJAX request
    xhr.open("POST", "postRecepie.php", true);
  
    // Send the form data
    xhr.send(formData);
    
  }

  document.getElementById("post_recipeForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
  
    // Clear previous error messages
    clearErrors();
    isvalid = true;
    isvalid &= cuisine();
    isvalid &= recipeName();
    isvalid &= photo();
    isvalid &= preparation();
    isvalid &= cookTime();
    isvalid &= difficulty();
    isvalid &= ingredients();
    isvalid &= description();
    // isvalid &= authorName();
    isvalid &= desc();
    // validate description 
    function desc() {
    var descInput = document.getElementById("desc");
    var descError = document.getElementById("desceError");
    var description = descInput.value.trim();
  
    if (description === "") {
      descError.textContent = "Description is required.";
      return false;
    } else if (description.length < 50) {
      descError.textContent = "Description should be at least 50 characters.";
      return false;
    } else {
      descError.textContent = "";
      return true;
    }
  }
  
    // Validate cuisine type
    function cuisine() {
      var cuisineInput = document.getElementById("cuisine");
      var cuisineError = document.getElementById("cuisineError");
      if (cuisineInput.value === "") {
        cuisineError.textContent = "Please select a cuisine type";
        return false;
      } else {
        cuisineError.textContent = "";
        return true;
      }
    }
  
    // Validate recipe name
    function recipeName() {
      var recipeNameInput = document.getElementById("recipeName");
      var recipeNameError = document.getElementById("recipeNameError");
      var alphanumericRegex =  /^[a-zA-Z0-9-\s]+$/;
  
      if (recipeNameInput.value.trim() === "") {
        recipeNameError.textContent = "Recipe name is required";
        return false;
      } else if (!alphanumericRegex.test(recipeNameInput.value) || recipeNameInput.value.length < 3) {
        recipeNameError.textContent = "Invalid recipe name. Recipe name should only contain alphanumeric characters,whitespace, and hyphen. Also, the recipe name should be atleast three characters.";
        return false;
      } else {
        recipeNameError.textContent = ""; // Clear any previous error message
        return true;
      }
    }
  
    // Validate photo upload format (assuming only image formats are allowed)
    function photo() {
      var photoInput = document.getElementById("photo");
      var photoError = document.getElementById("photoError");
  
      if (photoInput.files.length === 0) {
        photoError.textContent = "Photo is required";
        return false;
      } else {
        var allowedFormats = ["jpg", "jpeg", "png"]; // Add more allowed formats if needed
        var fileExtension = photoInput.files[0].name.split(".").pop().toLowerCase();
        var file = photoInput.files[0];
    
      var maxSize = 2 * 1024 * 1024; 
      
      if (file.size > maxSize) {
        photoError.textContent = "The selected photo exceeds 2 MB.";
        return false;
      } 
     
        if (!allowedFormats.includes(fileExtension)) {
          photoError.textContent = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
          return false;
        } else {
          photoError.textContent = ""; // Clear any previous error message
          return true;
        }
  
  
  
      }
    }
  
    // Validate preparation time
    function preparation() {
      var prepTimeInput = document.getElementById("prepTime");
      var prepTimeError = document.getElementById("prepTimeError");
      if (prepTimeInput.value.trim() === "") {
        prepTimeError.innerText = "Preparation time is required";
        return false;
      } else {
        prepTimeError.innerText = "";
        return true;
      }
    }
  
    // Validate cook time
    function cookTime() {
      var cookTimeInput = document.getElementById("cookTime");
      var cookTimeError = document.getElementById("cookTimeError");
      if (cookTimeInput.value.trim() === "") {
        cookTimeError.textContent = "Cook time is required";
        return false;
      } else {
        cookTimeError.textContent = "";
        return true;
      }
    }
  
    // Validate difficulty
    function difficulty() {
      var difficultyInput = document.getElementById("difficulty");
      var difficultyError = document.getElementById("difficultyError");
      if (difficultyInput.value === "") {
        difficultyError.textContent = "Please select a difficulty level";
        return false;
      } else {
        difficultyError.textContent = "";
        return true;
      }
    }
  
    // Validate ingredients
    function ingredients() {
      var ingredientsList = document.getElementById("ingredientsList");
      var ingredientsError = document.getElementById("ingredientsError");
      var ingredients = Array.from(ingredientsList.getElementsByTagName("input")).map(function(ingredient) {
        return ingredient.value.trim();
      });
  
      var alphanumericRegex =  /^[a-zA-Z0-9-\s]+$/;
      var invalidIngredients = ingredients.filter(function(ingredient) {
        return ingredient !== "" && !alphanumericRegex.test(ingredient);
      });
  
      if (ingredients.length === 0 || (ingredients.length === 1 && ingredients[0] === "")) {
        ingredientsError.textContent = "At least one ingredient is required";
        return false;
      } else if (ingredients.every(function(ingredient) {
        return ingredient === "";
      })) {
        ingredientsError.textContent = "Please enter at least one ingredient";
        return false;
      } else if (invalidIngredients.length > 0) {
        ingredientsError.textContent = "Invalid ingredients. Ingredients should only contain alphanumeric characters, whitespace, and hyphen.";
        return false;
      } else {
       ingredientsError.textContent = ""; // Clear any previous error message
        return true;
      }
    }
  
    // Validate description
    function description() {
      var descriptionInput = document.getElementById("description");
      var descriptionError = document.getElementById("descriptionError");
      var descriptionValue = descriptionInput.value.trim();
    
      if (descriptionValue === "") {
        descriptionError.textContent = "Instruction is required";
        return false;
      } else if (descriptionValue.length  < 50) {
        descriptionError.textContent = "Instruction must be more than 50 characters.";
        return false;
      } else {
        descriptionError.textContent = "";
        return true;
      }
    }
    
  
    // Clear error messages
    function clearErrors() {
      document.getElementById("cuisineError").textContent = "";
      document.getElementById("recipeNameError").textContent = "";
      document.getElementById("photoError").textContent = "";
      document.getElementById("prepTimeError").textContent = "";
      document.getElementById("cookTimeError").textContent = "";
      document.getElementById("difficultyError").textContent = "";
      document.getElementById("ingredientsError").textContent = "";
      document.getElementById("descriptionError").textContent = "";
    }
  
    if (isvalid) {
      // If all fields are valid, submit the form and reload the page
      // event.target.submit();
      submitUpdateForm();
      alert("your recipie has been saved successfuly")
      // location.reload();
      
    }
  });
  var count = 1; // Counter for input fields
  
  // Add Ingredient Button
  var addIngredientButton = document.getElementById("addIngredient");
  addIngredientButton.addEventListener("click", addIngredient);
  
  // Function to Add Ingredient Field
  function addIngredient() {
    var ingredientsList = document.getElementById("ingredientsList");
  
    // Create new ingredient list item
    var li = document.createElement("li");
  
    // Create input field for ingredient
    var ingredientInput = document.createElement("input");
    ingredientInput.type = "text";
    ingredientInput.name = "ingredient[]";
  
    // Create button to remove ingredient
    var removeButton = document.createElement("button");
    removeButton.type = "button";
    removeButton.className = "removeIngredient";
    removeButton.textContent = "X";
    removeButton.addEventListener("click", removeIngredient);
  
    // Append input and remove button to list item
    li.appendChild(ingredientInput);
    li.appendChild(removeButton);
  
    // Append new list item to the ingredients list
    ingredientsList.appendChild(li);
  }
  
  // Function to Remove Ingredient Field
  function removeIngredient(event) {
    var li = event.target.parentNode;
    // console.log(event);
    var ul = li.parentNode;
    ul.removeChild(li);
  }
  
  var stepCount = 1; // Counter for step fields
  
  // Function to add a step field with a remove button
  function addStepField() {
    stepCount++;
    
    var stepsContainer = document.getElementById("stepsContainer");
  
    // Create a new step container div
    var stepContainer = document.createElement("div");
    stepContainer.className = "step-container";
  
    // Create a label for the step
    var stepLabel = document.createElement("label");
    stepLabel.textContent = "Step " + stepCount;
    stepLabel.htmlFor = "description" + stepCount;
  
    // Create a div to hold the textarea and remove button
    var stepsDiv = document.createElement("div");
    stepsDiv.className = "steps";
  
    // Create a textarea for the step description
    var stepTextarea = document.createElement("textarea");
    stepTextarea.name = "step[]";
    stepTextarea.placeholder = "Enter step description";
    stepTextarea.id = "description" + stepCount;
  
    // Create a remove button
    var removeButton = document.createElement("button");
    removeButton.type = "button";
    removeButton.className = "removeStep";
    removeButton.textContent = "X";
  
    // Add an event listener to the remove button
    removeButton.addEventListener("click", function() {
      stepContainer.remove(); // Remove the step field when the button is clicked
      stepCount-=1
    });
  
   
  
    // Append the label, textarea, and remove button to the step container
    stepsDiv.appendChild(stepTextarea);
    stepsDiv.appendChild(removeButton);
  
    stepContainer.appendChild(stepLabel);
    stepContainer.appendChild(stepsDiv);
  
    // Append the step container to the steps container
    stepsContainer.appendChild(stepContainer);
  }
  
  function removeStep(event){
    // this.remove();
    var li = event.target.parentNode;
    // console.log(event);
    var ul = li.parentNode;
    ul.remove(li);
  }
  
  // Add an event listener to the "Add Step" button
  var addStepButton = document.getElementById("addStep");
  addStepButton.addEventListener("click", addStepField);
  
  
  function calculateSum() {
    var input1 = document.getElementById("prepTime").value;
    var input2 = document.getElementById("cookTime").value;
  
    var value1 = input1 ? parseInt(input1) : 0;
    var value2 = input2 ? parseInt(input2) : 0;
  
    var sum = value1 + value2;
  
    document.getElementById("result").innerText = sum;
  }
  
  var photoInput = document.getElementById("photo");
  var fileUploadLabel = document.getElementById("file-upload-label");
  var uploadStatus = document.querySelector(".upload-status");
  var photoError = document.getElementById("photoError");
  
  photoInput.addEventListener("change", function () {
    if (photoInput.files && photoInput.files[0]) {
      uploadStatus.innerText = "Selected file: " + photoInput.files[0].name;
      fileUploadLabel.innerText = "Change file";
      
      photoError.innerText = ""; // Clear any previous error message
    } else {
      uploadStatus.innerText = "No file selected";
      fileUploadLabel.innerText = "Choose a file";
    }
  });