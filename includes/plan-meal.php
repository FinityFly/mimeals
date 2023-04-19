<?php
include "db-conn.php";

if ($bucketlist < 1) {
    $userId = $_SESSION['userId'];
    $recipeId = $_GET['recipeId'];
    $recipeTitle = $_GET['recipeTitle'];
    $recipeImage = $_GET['recipeImage'];
    $time = $_GET['time'];
    $sql = "INSERT INTO `addedRecipes` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`, `time`)  VALUES (NULL, '$userId', '$recipeId', '$recipeTitle', '$recipeImage', '$time')";
    mysqli_query($conn, $sql);
    return json_encode(array("status" => true, "added" => true));
} else {
    return json_encode(array("status" => true, "added" => false));
}
?>