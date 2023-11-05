<?php

// WE NEED TWO FILES, ONE FOR DELETING CUSTOM RECIPES ONE FOR DELETING API RECIPES

session_start();
include "db-conn.php";

$request = file_get_contents("php://input"); // gets the raw data
$post = json_decode($request, true); // true for return as array

if (isset($post['recipeId'])) {
    $userId = $_SESSION['id'];
    $recipeId = $post['recipeId'];

    $sql = "DELETE FROM `recipeCache` WHERE userId = '$userId' AND id = '$recipeId'";
    mysqli_query($conn, $sql);
    $data = json_encode(array('deleted' => true));
    echo $data;
} else {
    $data = json_encode(array('deleted' => false));
    echo $data;
}
?>