$(document).ready(function() {


  
    $(".sub-comment").hide();
    
    // Event delegation to handle click on dynamically added elements
    $(document).on('click', '.expand-comment', function() {

      // $(".sub-comment").toggle();
      // $(".sub-comment").toggle();


      
      var par_div = $(this).parent().parent().children();
      
// console.log(par_div[1].children[3].innerHTML);
// $(par_div[2]).slideToggle();








        
    
      var rcid = parseInt($(this).data('rcid'));
      var rid = parseInt($(this).data('rid'));
      var cid = "sub-" + rcid;
      if(par_div[2].style.display == "none"){
      // console.log(this);
      $.ajax({
        url: '../php/commentsController.php',
        type: 'POST',
        data: {
          func:"get",
          rcid: rcid,
          rid: rid
        },
        dataType: 'json',
        success: function(response) {

            
            




          var sub_comment_div = $("#" + cid);

          sub_comment_div.empty();
  
          $.each(response.map(JSON.parse), function(index, comment) {


            var url = 'filterUser.php';
            var data = { id: comment.uid
            
            
            };
            var fname;
            var lname;
            
            $.ajax({
              url: url,
              type: 'POST',
              data: data,
              dataType: 'json',
              success: function(response) {
                // Handle the response here
                 fname = response.first_name;
                 lname = response.last_name;

                 handleResponse();
              },
              error: function(xhr, status, error) {
                // Handle any errors here
                console.log(error);
              }
            });


            function handleResponse(){


            // Assuming you have the date as a string
            var dateString = comment.ts;

            // Create a new Date object from the date string
            var date = new Date(dateString);

            // Format the date in "M d, y" format
            var options = { 
            month: 'short',
            day: 'numeric',
            year: 'numeric'
            };
            var formattedDate = date.toLocaleDateString('en-US', options);

            var comment_ts = formattedDate; // Output: Jun 12, 2023




            var div_main = $('<div>', { class: 'comment-div' });
            var c_text = $('<p>', { class: 'comment-text', text: comment.comment });
            var commentAbout = $('<div>', { class: 'comment-about' });
            var commentBy = $('<span>', { class: 'comment-by' });
            var author = $('<a>', { href: 'userProfile.php?user=' + comment.uid, text: fname + " "+ lname });
            var commentOn = $('<span>', { class: 'comment-on', text: ' on ' + comment_ts });
            var expand = $('<span>', { class: 'material-symbols-outlined expand-comment', text: 'expand_more', "data-rid": ""+rid, "data-rcid": ""+comment.cid });

            var reply_btn = $('<span>', {'data-comm_id': ''+comment.cid, class: 'material-symbols-outlined comment-reply', onclick: 'showReply(event)', text:"reply" });

            var reply_box = $('<span>', {
                id: "comm-"+comment.cid, class: "reply-box", style:"display:none"
            })


            var inp = $("<input>", {type:"text", name:"reply-"+comment.cid});
            var send_symbol = $('<span>', {class:"material-symbols-outlined send-symb", onclick:"handleReply(event)", text:"send"});

            reply_box.append(inp, send_symbol);


            commentBy.append(author);
            commentAbout.append(reply_btn, commentBy, commentOn, expand, reply_box);
            div_main.append(c_text, commentAbout);
  
            var sub_c = $('<div>', { id: 'sub-' + comment.cid, class: 'sub-comment', style:"display:none"});
            div_main.append(sub_c);

            
  
            sub_comment_div.append(div_main);

            }
          });
        },
        error: function(xhr, status, error) {
          console.log(error);
        }

      }
      );}
      function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
      }
      
      async function delayedCodeExecution() {
        // console.log("Before the delay");
        await sleep(500); // Pause the code execution for 2 seconds
        $(par_div[2]).slideToggle();
        par_div[1].children[3].innerHTML = (par_div[1].children[3].innerHTML.trim() == "expand_more" ? "expand_less" : "expand_more");
      }
      
      delayedCodeExecution();
      
            

    });

  });


  function showReply(event) {
    
    // Rest of your code here
    var commid = "comm-"+event.target.dataset.comm_id;
    // $(".reply-box").hide();
    $("#" + commid).slideToggle();
    
  }

  function handleReply(event){

    // saveComment("Hallelujah", 1, 1005, null);
    var rep_box = event.target.parentNode;

    comment = rep_box.children[0].value;
    cid = parseInt(rep_box.id.split("-")[1]);
    // console.log(comment, cid)
    saveComment(comment, cid, 0);

        

  }
  

  function saveOGComment(event){

    var comm_box = event.target.parentNode;
    var rid = comm_box.dataset.rid;
    var comm = comm_box.children[1].value;
    saveComment(comm, null, rid);



  }
  


  function saveComment(comment, rcid, rid) {
    // console.log(comment, rcid, rid);
    $.ajax({
      url: '../php/commentsController.php', // Replace with the path to your PHP script
      type: 'POST',
      data: {
        comment: comment,
        rcid: rcid,
        func: "save",
        rid:rid
      },
      success: function(response) {
        console.log(response);
        if (response === 'success') {
         
          console.log('Comment saved successfully.');
        } else {
          console.log('Failed to save the comment.');
        }
      },
      error: function(xhr, status, error) {
        console.log('An error occurred while saving the comment.');
        console.log(error);
      }
    })
    
    location.reload();
    
  }

  
  
  

  
  