<?php include "config/dbconn.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,900;1,400&display=swap" 
rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans&family=Encode+Sans+Semi+Condensed:wght@100;200&family=Lato:ital,wght@0,100;0,300;0,400;0,900;1,400&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<link rel="stylesheet" href="../styles/search.css"> 
<link rel="stylesheet" href="../styles/single-item.css">
<link rel="stylesheet" href="../styles/post.css">
<link rel="stylesheet" href="../styles/profile.css">
 <link rel="stylesheet" href="../styles/delete_rec.css">
 <link rel="stylesheet" href="../styles/login.css">
 <link rel="stylesheet" href="../styles/editProfile.css">
 <link rel="stylesheet" href="../styles/about.css">
<link rel="stylesheet" href = "../styles/footer.css">
<link rel="stylesheet" href="../styles/header.css"> 
<link rel="stylesheet" href="../styles/nav.css"> 
<style>

@import url('https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Condensed:wght@900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Condensed:wght@600;900&display=swap'); 

*{
  font-family: "Encode Sans Semi Condensed", sans-serif;
  box-sizing: border-box;
}


</style>
   
<title>MesobMagic</title>
    
</head>
<body>
  <div class="main_container">
<header class="nav_header">
        <div class="nav_logo">
            <img src="../mesobmagic22v2.gif">
            <p class="header_txt"><a href = "../php/home_page.php" style="text-decoration: none; color:black;" >MESOB MAGIC</a></p>
        </div>
        <nav class="nav_wrapper">
            <ul class ="nav_menu">
            <li class="nav_links"><a href = "../php/search.php">Discover</a></li>
            <li class="nav_links"><a href = "../php/post.php">Share</a></li>
            <li class="nav_links"><a href = "../php/about.php">Contact</a></li>
            <li class="nav_links"><a href = "../php/about.php">About Us</a></li>
            <li class="nav_links"><select id="nav_button" onchange="handleAccountAction(this.value)">
    <option>Accounts</option>
    <option value="logout">Log Out</option>
    <option value="signup">Sign Up</option>
</select>



            </li>
            </ul>
        </nav>
        <div class="hamburger">
            <span class = "home_bar"></span>
            <span class = "home_bar"></span>
            <span class = "home_bar"></span>
        </div>
    </header>
    </div>


    <script src = "../scripts/nav.js"></script>
    <script>
    function handleAccountAction(action) {
        if (action === "logout") {
            // Redirect to the session destroyer script
            window.location.href = "sessionDestroyer.php";
        } else if (action === "signup") {
            // Redirect to the sign-up page
            window.location.href = "login-front.php";
        }
    }
</script>
<!-- <div style="visibility:hidden; min-height:4em;"></div> -->