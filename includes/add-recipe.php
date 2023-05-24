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
    $sql = "SELECT * FROM `addedRecipes` WHERE userId = '$userId' AND recipeId = '$recipeId'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        $error = [
            "status" => true,
            "added" => false,
            "userId" => $userId
        ];
        echo json_encode($error);
    } else {
        $sql = "INSERT INTO `addedRecipes` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`)  VALUES (NULL,'$userId','$recipeId','$recipeTitle','$recipeImage');";
        mysqli_query($conn, $sql);
        $error = [
            "status" => true,
            "added" => true,
            "userId" => $userId
        ];
        echo json_encode($error);
    }
} else {
    echo "no data bruh";
}
?>