function deletePost(event){
    const rid = parseInt(event.target.dataset.rid);
    const func = "delete"
    console.log(event.target);
    
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
    // location.reload();
    }


    function openUrlWithPost(url, postData) {
        // Create a new form element
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
      
        // Create form fields based on the postData object
        for (const key in postData) {
          if (postData.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = postData[key];
            form.appendChild(input);
          }
        }
      
        // Append the form to the document body and submit it
        document.body.appendChild(form);
        form.submit();
      }
      
      // Example usage:
      
      
      
      


function handleEvent(event){
    const rid = parseInt(event.target.dataset.rid);
    openUrlWithPost("../php/update.php", {rid:rid});
    // Create the data payload for the POST request
// const formData = {
//     rid: rid
//     // Add more fields as needed
//   };
  
//   // Send a POST request using fetch()
//   fetch('../php/update.php', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//     },
//     body: JSON.stringify(formData),
//   })
//     .then(response => {
//       if (response.ok) {
//         // Request succeeded
//         return response.text();
//       } else {
//         // Request failed
//         throw new Error('POST request failed');
//       }
//     })
//     .then(data => {
//       // Handle the response data
//       console.log(data);
//     })
//     .catch(error => {
//       // Handle any errors
//       console.error(error);
//     });
  

}