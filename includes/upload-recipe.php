<?php
session_start();
include "db-conn.php";

$request = file_get_contents("php://input"); // gets the raw data
$post = json_decode($request, true); // true for return as array

if (isset($post['recipeTitle'])) {
    $userId = $_SESSION['id'];
    $userName = $_SESSION['name'];
    $recipeTitle = $post['recipeTitle'];
    $recipeDescription = $post['recipeDescription'];
    $prepTime = $post['prepTime'];
    $cookTime = $post['cookTime'];
    $totalTime = $post['totalTime'];
    $ingredients = $post['ingredients'];
    $numServings = $post['numServings'];
    $priceServing = $post['priceServing'];
    $instructions = $post['instructions'];
    $dairyFree = $post['dairyFree'];
    $glutenFree = $post['glutenFree'];
    $vegan = $post['vegan'];
    $vegetarian = $post['vegetarian'];
    $lowFODMAP = $post['lowFODMAP'];
    $image = $post['image'];
    $sql = "INSERT INTO `recipeCache` (`id`, `userId`, `userName`, `recipeTitle`, `recipeDescription`, `prepTime`, `cookTime`, `totalTime`, `ingredients`, `numServings`, `priceServing`, `instructions`, `dairyFree`, `glutenFree`, `vegan`, `vegetarian`, `lowFODMAP`, `image`) VALUES (NULL, '$userId', '$userName', '$recipeTitle', '$recipeDescription', '$prepTime', '$cookTime', '$totalTime', '$ingredients',  '$numServings', '$priceServing' , '$instructions', '$dairyFree', '$glutenFree', '$vegan', '$vegetarian', '$lowFODMAP', '$image')";
    mysqli_query($conn, $sql);
    echo json_encode(array("status" => true, "added" => true));
} else {
    echo json_encode(array("status" => true, "added" => false));
}
?>