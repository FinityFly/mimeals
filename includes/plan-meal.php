<?php
session_start();
include "db-conn.php";

$request = file_get_contents("php://input"); // gets the raw data
$post = json_decode($request, true); // true for return as array

if (isset($post['recipeId'])) {
    $userId = $_SESSION['id'];
    $recipeId = $post['recipeId'];
    $recipeTitle = $post['recipeTitle'];
    $recipeImage = $post['recipeImage'];
    $time = $post['time'];
    $sql = "INSERT INTO `plannedMeals` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`, `time`)  VALUES (NULL,'$userId','$recipeId','$recipeTitle','$recipeImage', '$time');";
    mysqli_query($conn, $sql);
    echo json_encode(array("status" => true, "added" => true));
} else {
    echo json_encode(array("status" => true, "added" => false));
}
?>