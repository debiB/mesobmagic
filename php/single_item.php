<?php
include "/opt/lampp/htdocs/mesobmagic/php/filterRecepie.php";
include "/opt/lampp/htdocs/mesobmagic/inc/header.php";
$recipe = intval($_REQUEST['recipe']);
$data = $fetchSingleItem($recipe, $conn);
?>
<link rel="stylesheet" href="styles/single-item.css">
<body>

    <div class="top-single-item">
        <div class= "top-title">
        <h1 class="single-item-title"><?php echo "Ethiopian Kitfo" ?> </h1><small class="single-item-author"> by <?php echo "author"; ?></small></div>
        <div class="single-item-img">
            <img src="<?php echo "https://www.alphafoodie.com/wp-content/uploads/2023/01/Falafel-square.jpeg"?>" alt="<?php echo $data["recipe_name"] ?>" width="600px" , height="400px">
            <div class="single-item-rating">
                <span> <?php echo $data["avg"]; ?> ( <?php echo $data["count"] ?>) reviews.</span>
            </div>

        </div>


        <div class="single-item-section">
            <h2> Description</h1>
                <p><?php echo $data['description']; ?></p>
        </div>

        <div class="single-item-section">
            <h2> Ingredients</h1>
                <ul>
                    <?php $ing_array  = explode(" ", $data['ingredients'], 10);
                    foreach ($ing_array as $ing_item) : ?>
                        <li> <?php echo join(" ", explode("_", $ing_item)) ?> </li>
                    <?php endforeach; ?>

                </ul>
        </div>

        <div class="single-item-section">
            <h2> Instructions</h1>
                <ol>
                    <?php $inst_array  = explode(".", $data['instructions']);
                    // print_r($inst_array);
                    foreach ($inst_array as $inst_item) :
                        if ($inst_item) :
                    ?>
                            <li>
                                <?php echo $inst_item; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </ol>
        </div>

        <div class = "single-item-section">
            <h2>Recommended Time in the Kitchen</h2>
            <b>Estimated Preparation Time:</b> <span><?php echo $data["prep_time"]?> minutes    </span><br/>
            <b>Estimated Cook Time: </b> <span><?php echo $data["cook_time"]?> minutes</span><br/>
            <b>TotalTime: </b> <span><?php echo $data["total_time"]?> minutes</span>
            
        </div>

        <div class = "single-item-section">
            <h2>Cuisine Type</h2>
            <p> <?php echo $data['cuisine'];?></p>
            
        </div>

        <div class = "single-item-section">
            <h2>Difficulty Level</h2>
            <p> <?php echo $data['difficulty_level'];?></p>
            
        </div>
        <div class="rate-me"> Care to rate this Recpie?</div>

    </div>
</body>
<?php include "/opt/lampp/htdocs/mesobmagic/inc/footer.php"; ?>