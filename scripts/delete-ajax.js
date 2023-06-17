function deletePost(event){
    const rid = parseInt(event.target.dataset.rid);
    const func = "delete"
    
    var formData = new FormData();
    formData.append("rid", rid);
    formData.append("function", func);
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
    location.reload();
    }