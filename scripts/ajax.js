// var callback_search = function() {
  
//   let search_txt = document.getElementById('search').value;
//   let chosen_filter =document.getElementById('filter').value;
//   // console.log(search_txt);
//   // console.log(chosen_filter)

//   filter_functions = {
//     "name":"fetchByName",
//     "difficulty":"fetchByDifficulty",
//     "prep_time":"fetchByPrepTime",
//     "author":"fetchByAuthor",
//     "cusine":"fetchByCuisineType",
//     "ingredient":"fetchByIngredient"
//   }


//   var xhr = new XMLHttpRequest();
//   xhr.open('POST', '../search-body.php', true);
//   xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//   xhr.onreadystatechange = function() {
//     if (xhr.readyState === 4 && xhr.status === 200) {
      
//       document.body.innerHTML = xhr.responseText;
      
//     }
//   };

//   var functionName = filter_functions[chosen_filter];
//   var data = 'function=' + encodeURIComponent(functionName) + "&input="+encodeURIComponent(search_txt);
//   // console.log(data)

//   xhr.send(data);
// };
// document.getElementById('search-btn').addEventListener('click', callback_search);

// Function to handle form submission
function submitForm() {
  // Create a new FormData object
  var formData = new FormData(document.getElementById("post_recipeForm"));

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Set up the callback function for the AJAX request
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Request successfu
        console.log(xhr.responseText);
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
