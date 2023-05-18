function zoomImage(image) {
  image.classList.toggle("zoomed");
}
window.addEventListener("DOMContentLoaded", function() {
  var navbarContainer = document.getElementById("navbar-container");

  fetch("nav.html")
    .then(response => response.text())
    .then(data => {
      navbarContainer.innerHTML = data;
    });
});

window.addEventListener("resize", adjustIframeHeight);
// Make an AJAX request to retrieve the rating value from the server-side
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
  if (this.readyState === 4 && this.status === 200) {
    // Parse the JSON response
    var response = JSON.parse(this.responseText);
    
    // Retrieve the rating value from the response
    var ratingValue = response.rating_value;
    
    // Update the HTML with the rating value
    document.getElementById('rating-number').innerText = ratingValue;
  }
};

xhr.open('GET', 'get_rating.php', true); // Assuming you have a server-side script named 'get_rating.php' that retrieves the rating value
xhr.send();

