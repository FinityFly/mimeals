<?php

// this one is for planned recipes

session_start();
include "db-conn.php";

$request = file_get_contents("php://input"); // gets the raw data
$post = json_decode($request, true); // true for return as array

if (isset($post['recipeId'])) {
    $userId = $_SESSION['id'];
    $recipeId = $post['recipeId'];
    $time = $post['time'];

    $sql = "DELETE FROM `plannedMeals` WHERE id NOT IN (SELECT MIN(id) FROM `plannedMeals` WHERE `userId` = '$userId' AND `recipeId` = '$recipeId' AND `time` = '$time' GROUP BY `userId`, `recipeId`, `time`) AND `userId` = '$userId' AND `recipeId` = '$recipeId' AND `time` = '$time'";
    // $sql = "DELETE TOP 1 FROM `plannedMeals` WHERE `userId` = '$userId' AND `recipeId` = '$recipeId' AND `time` = '$time'";
    mysqli_query($conn, $sql);
    $data = json_encode(array('deleted' => true));
    echo $data;
} else {
    $data = json_encode(array('deleted' => false));
    echo $data;
}
?>