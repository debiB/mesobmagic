<?php
session_start();
include "/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php";
// include "/opt/lampp/htdocs/mesobmagic/php/sessionStarter.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesobmagic</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_page.css">
</head>
<body>
    <div id="slider">
        <figure class="slideshow_fig">
            <img src="../images/mesobmagic-banners_1.gif" alt="Image 1">
            <img src="../images/mesobmagic-banners_2.gif" alt="Image 2">
            <img src="../images/mesobmagic-banners_3.gif" alt="Image 3">
            <img src="../images/mesobmagic-banners_4.gif" alt="Image 4">
            <img src="../images/mesobmagic-banners_1.gif" alt="Image 1">
        </figure>      
    </div>
    <div class="home_popular_section">
        <h1 class="just_for_you">Popular</h1>
        <div id="cardContainer">
        <?php 
            $popular = $popularN(6, $conn);
            // print_r(count($popular));
            foreach($popular as $item):
        ?> 


                    <div class="home_card" style="background-color: #f5f5f5; padding: 2vh;">
                        <img src="<?php echo $item['image_url']?>" class="home_card_img" style="width: 85%; height: 65%; object-fit: cover;">
                        <p class="home_recipie_name" style="font-weight: bold; margin-top: 10px;"><a href="single_item.php?recipe=<?php echo $item['rid']?>"><?php echo $item['recipe_name']?></a></p>
                        <p class="home_author_name" style="margin-top: 5px;"><?php echo $getAuthor($item['author'], $conn)['first_name'] . " " . $getAuthor($item['author'], $conn)['last_name']?></p>
                        <div class="ratings-stars">
        <div id="rating-number" class="home_stars">
          <?php $avg_rating = $item['avg'];
          if ($avg_rating == null) $avg_rating = 0;
           ?>
        </div>
        <div class="home_star">
          <?php
          $avg_rating = $item['avg'];
          if ($avg_rating == null) $avg_rating = 0;
          $i = 0;
          while ($i < 5) {
            if ($i < $avg_rating) {
              echo "<span class=\"star\">&#9733;</span>";
            } else {
              echo "<span class=\"star\">&star;</span>";
            }
            $i++;
          }
          ?>
        </div>
      </div>
                        </div>
                    
                

        <?php endforeach;?>
        </div>
        </div>
    </div>
    <div class = "home_difficulty_browse_section">
        <h2 class="home_difficulty_browse_post_txt">Our Recipies are classified by difficulty for your convinience!</h2> 
        <div class = "home_difficulty_container">
            <div class = "home_easy_difficulty">
                <img class="home_difficuly_img" src="https://www.allrecipes.com/thmb/JONH3j_92Z20gZR8EkH3apG6IYc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/7507446_Tres-Leches-Pancakes_lutzflcat_4x3-8b1943b72a6b40bebdbfc65c72dcbe6d.jpg" alt="easy food pic"> 
                <p><a  href="search.php?input=Easy&function=difficulty">Easy Recipies</a></p>
            </div>
            <div class = "home_medium_difficulty">
                <img class="home_difficuly_img" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F8140941.jpg&q=60&c=sc&orient=true&poi=auto&h=512" alt="easy food pic"> 
                <p><a href="search.php?input=Medium&function=difficulty"> Medium Recipie</a>s</p>
            </div>
            <div class = "home_hard_difficulty">
                <img class="home_difficuly_img" src="https://www.allrecipes.com/thmb/nxe9OYRmU-n-Y-quAhvbFL_PLXo=/800x533/filters:no_upscale():max_bytes(150000):strip_icc():focal(399x0:401x2):format(webp)/1384969_SpicyGrilledShrimp4x3-59e3a192062c420f9bcf12181453b357.jpg" alt="easy food pic"> 
                <p class= "diff-nav"><a  href="search.php?input=Hard&function=difficulty"> Hard  Recipies</a></p>
            </div>
        </div>
    </div>
    <div class = "home_testimonial">
        <h1 class = "home_testimonials">Testimonials</h1>
        <div class="testimonial-container" id="testimonial-container"></div>
    </div>
    <div class="home_browse_container">
        <div class="browse_post">
            <h2 class="browse_post_txt">Want to post your recipe?</h2>
            <img class="browse_post_img" src="https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg" alt="browse food">
            <p><i class="material-icons post_icon">post_add</i><a href="post.php">Post your recipe</a></p>
          </div>
        <div class = "home_browse_card">
            <h2 class = "home_browse_card_txt">Discover different cuisne types</h2>
        <div class="home_browse_card_cuisne_container" id="cuisine-container"></div>
        </div>
    </div>
    <div class = "contact-us_container">
        <div class = "contact-us">
        <h1 class ="send_us_message_txt">Send us message</h1>
        <form id ="home_contact-us">
            <input type="email" id= "home_contact-us_email" placeholder="Email" name = "email">
            <textarea id = "home_contact-us_message" placeholder="Your message" rows="6" col = "6" name = "feedback"></textarea>
            <button type="submit" id = "feed-btn">Send</button>
        </form>
    </div>
</div>
<object data="../php/footer.html" id="imported-footer-content" type="text/html"></object>
    <script src="../scripts/home_page.js"></script>
</body>
</html>
