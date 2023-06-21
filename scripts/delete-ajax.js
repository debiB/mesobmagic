function deletePost(event){
    const rid = parseInt(event.target.dataset.rid);
    const func = "delete"
    console.log(event.target);
    
    var formData = new FormData();
    formData.append("rid", rid);
    formData.append("function", func);
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
            
        } else {
            console.log(xhr.status);
        }
        }
    };

    xhr.open("POST", "postRecepie.php", true);

    xhr.send(formData);
    }


    function openUrlWithPost(url, postData) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
      
        for (const key in postData) {
          if (postData.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = postData[key];
            form.appendChild(input);
          }
        }
      
        document.body.appendChild(form);
        form.submit();
      }
      
      
      
      
      


function handleEvent(event){
    const rid = parseInt(event.target.dataset.rid);
    openUrlWithPost("../php/update.php", {rid:rid});
const formData = {
    rid: rid
  };
  
  fetch('../php/update.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(formData),
  })
    .then(response => {
      if (response.ok) {
        return response.text();
      } else {
        throw new Error('POST request failed');
      }
    })
    .then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error(error);
    });
  

}