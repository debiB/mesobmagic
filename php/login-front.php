<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Mesobmagic</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="loginsign_body">
    
    <div class="Login-signup-container" id="Login-signup-container">
      <div class="form-container sign-up-container">
        <form id="signup-form" action="registrationController.php" method="POST" enctype="multipart/form-data">
          <h1 class="lsup_header">Create Account</h1>
          <input type="text" id="first-name" placeholder="First Name"  name = "first_name"/>
          <span class="login_signup-error-message" id="first-name-error"></span>
          <input type="text" id="last-name" placeholder="Last Name" name  = "last_name"/>
          <span class="login_signup-error-message" id="last-name-error"></span>
          <input type="email" id="email" placeholder="Email" name = "email" />
          <span class="login_signup-error-message" id="email-error"></span>
          <input type="password" id="password" placeholder="Password" name = "password"/>
          <span class= "login_signup-error-message" id="password-error"></span>
          <input type="password" id="confirm-password" placeholder="Confirm Password"  />
          <span class="login_signup-error-message" id="confirm-password-error"></span>
          <input type="text" id="job-title" placeholder="Job Title" name = "job-title" />
          <span class="login_signup-error-message" id="job-title-error"></span>
          <div class ="lsup-age_container">
            <label for = "lsup_age" style="width: 21%; margin-right: 2%;">Date of Birth: </label>
            <input type="date" id="age" placeholder="Date of Birth"  width="50%" max="2013-01-01" name = "dob"/>
          </div>
          <span class="login_signup-error-message" id="age-error"></span>
          <img id="preview_image" src="#" alt="Preview">
          <div class = "profile_picture-container">
            <label for = "profile_picture" style="width: 24%; margin-right: 2%;">Profile Picture:</label>
            <input type="file" id="profile_picture" name = "photo" onchange="previewProfilePicture(event)" onclick="resize()">
          </div>
          <span class="login_signup-error-message" id="profile-picture-error"></span>
          <div class="lsup_country_container">
            <p class="country_lsup_text" style="display: inline;">Country: </p>
            <select id="lsup_country" name= "country">
              <option>Select a country</option>
              <option value = "Ethiopia" >Ethiopia</option>
            </select>
            <input type="text"name=  "country" id="other-country-options" placeholder="if not listed, specify your country here">
            <span class="login_signup-error-message" id="country-error" style="display: inline;"></span>
          </div>
          <button type="submit" class="lsup_btn" id = "sign-up_lsup_btn">Sign Up</button>
        </form>
      </div>
      <div class="form-container sign-in-container">
        <form id="signin-form" action="loginController.php" method="POST">
          <h1 class="lsup_header">Sign in</h1>
          <input type="email" id="signin-email" placeholder="Email" name = "signin-email" />
          <span class="login_signup-error-message" id="signin-email-error"></span>
          <input type="password" id="signin-password" placeholder="Password" name = "sigin-password"/>
          <span class="login_signup-error-message" id="signin-password-error"></span>
          
          <a class="lsup_link" href="#">Forgot your password?</a>
          <button type="submit" class="lsup_btn">Sign In</button>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p class="lsup_text">To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn" onclick ="minorResize()">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hello!</h1>
            <p class="lsup_text">Enter your personal details and start journey with us</p>
            <button class="ghost" id="signUp" onclick = "mainResize()">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
    
    <script src="../scripts/login.js"></script>
</body>
</html>
