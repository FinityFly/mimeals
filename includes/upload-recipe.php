<?php
session_start();
include "db-conn.php";

if ($bucketlist < 1) {
    $userId = $_SESSION['userId'];
    $userName = $_SESSION['name'];
    $recipeTitle = $_GET['recipeTitle'];
    $recipeDescription = $_GET['recipeDescription'];
    $prepTime = $_GET['prepTime'];
    $cookTime = $_GET['cookTime'];
    $totalTime = $_GET['totalTime'];
    $ingredients = $_GET['ingredients'];
    $numServings = $_GET['numServings'];
    $priceServing = $_GET['priceServing'];
    $instructions = $_GET['recipeSteps'];
    $dairyFree = $_GET['dairyFree'];
    $glutenFree = $_GET['glutenFree'];
    $vegan = $_GET['vegan'];
    $vegetarian = $_GET['vegetarian'];
    $lowFODMAP = $_GET['lowFODMAP'];
    $image = $_GET['image'];
    
    $sql = "INSERT INTO `recipeCache` (`id`, `userId`, `userName`, `recipeTitle`, `recipeDescription`, `prepTime`, `cookTime`, `totalTime`, `ingredients`, `numServings`, `priceServing`, `instructions`, `dairyFree`, `glutenFree`, `vegan`, `vegetarian`, `lowFODMAP`, 'image') 
                                VALUES (NULL, '$userId', '$userName', '$recipeTitle', '$recipeDescription', '$prepTime', '$cookTime', '$totalTime', '$ingredients',  '$numServings', '$priceServing' , '$instructions', `$dairyFree`, '$glutenFree', '$vegan', '$vegetarian', '$lowFODMAP', '$image')";
    mysqli_query($conn, $sql);
    return json_encode(array("status" => true, "added" => true));
} else {
    return json_encode(array("status" => true, "added" => false));
}
?>