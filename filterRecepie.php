<?php
include 'config/dbconn.php';
// fetchByCuisineType("Italian", $conn);
// print_r(fetchByIngredient("primis", $conn));
// fetchByPrepTime(100, $conn);
// fetchByCookTime(100, $conn);
print_r(fetchByDifficulty("Easy",$conn));

?>