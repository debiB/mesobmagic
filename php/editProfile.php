<?php 
session_start();
include "/opt/lampp/htdocs/mesobmagic/inc/header.php";
include "/opt/lampp/htdocs/mesobmagic/php/filterUser.php";

$data = $getUser($_SESSION['uid'], $conn);

?>

<h1 class ="post-header">&#128394; Edit Profile</h1>
<div class="edit-profile-container">
  <form class = "edit-profile-form">
    <label class = "edit-profile-label" for="firstName">First Name:</label>
    <input class = "edit-profile-input" type="text" id="first-name" name="firstName"
    value = "<?php echo $data["first_name"]?>"
    >
    <span class="login_signup-error-message" id="first-name-error"></span>

    <label class = "edit-profile-label" for="lastName">Last Name:</label>
    <input class = "edit-profile-input" type="text" id="last-name" name="lastName"
    value = "<?php echo $data["last_name"]?>"
    >
    <span class="login_signup-error-message" id="last-name-error"></span>

    <label class = "edit-profile-label" for="dob">Date of Birth:</label>
    <input class = "edit-profile-input" type="date" id="dob" name="dob"
    value = "<?php echo $data["dob"]?>"
    >
    <span class="login_signup-error-message" id="dob-error"></span>
    

    <label class = "edit-profile-label" for="email">Email:</label>
    <input class = "edit-profile-input" type="email" id="email" name="email"
    value = "<?php echo $data["email"]?>"
    disabled>
    <span class="login_signup-error-message" id="email-error"></span>

    <label class="edit-profile-label" for="country">Country:</label>
<select class="edit-profile-input" id="country" name="country">
  <option value="USA" <?php echo ($data["country"] == "USA") ?  "selected":""; ?>>USA</option>
  <option value="Canada" <?php echo ($data["country"] == "Canada") ?  "selected":""; ?>>Canada</option>
  <option value="Ethiopia" <?php echo ($data["country"] == "Ethiopia") ?  "selected":""; ?>>Ethiopia</option>
  <option value="Other" selected>Other</option>
</select>

<span class="login_signup-error-message" id="country-error"></span>


    <label class = "edit-profile-label" for="jobTitle">Job Title:</label>
    <input class = "edit-profile-input" type="text" id="job-title" name="jobTitle" value = "<?php echo $data["job_title"]?>">

    <span class="login_signup-error-message" id="job-title-error"></span>

    <input type="button" id = "changePasswordButton" value="Change Password">
    <div id="chpass">



    <label class = "edit-profile-label" for="password">New Password:</label>
    <input class = "edit-profile-input" type="password" id="password" name="password"><br>
    <span class="login_signup-error-message" id="password-error"></span>


    <label class = "edit-profile-label" for="cpassword"> Confirm Password:</label>
    <input class = "edit-profile-input" type="password" id="confirm-password" name="cpassword"><br>
    <span class="login_signup-error-message" id="confirm-password-error"></span>

    </div>

    <div class="edit-photo">
    
    <img id="imagePreview" src="<?php echo $data["avatar"]?>" alt="Image Preview"  width="200px">
    </div>

    <label class = "edit-profile-label" for="profileImage">Profile Image (< 2MB):</label>
    <input type="file" class = "edit-profile-file" id="profileImage" name="profileImage" onchange="previewImage(event)">
    <span class="error" id="photoError" style="display: block"></span>
   

    <input class="edit-profile-submit" type="button" value="Update" id = "edit-form-submit">
    
  </form>

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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
  // Initially hide the password fields
  $("#chpass").hide();

  // Show/hide password fields when "Change Password" button is clicked
  $("#changePasswordButton").click(function() {
    $("#chpass").toggle();
    

  });
  ;
});
</script>
<script src="../scripts/validateUpdate.js"></script>


<?php
include "/opt/lampp/htdocs/mesobmagic/inc/footer.php";?>
?>
