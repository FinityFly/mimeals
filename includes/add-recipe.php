<?php
session_start();
include "db-conn.php";

$request = file_get_contents("php://input"); // gets the raw data
$post = json_decode($request, true); // true for return as array

if (isset($post['recipeId'])) {
    if ($bucketlist < 1) {
        $userId = $_SESSION['id'];
        $recipeId = $post['recipeId'];
        $recipeTitle = $post['recipeTitle'];
        $recipeImage = $post['recipeImage'];
        $sql = "INSERT INTO `addedRecipes` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`)  VALUES (NULL,'$userId','$recipeId','$recipeTitle','$recipeImage');";
        mysqli_query($conn, $sql);
        $error = [
            "status" => true,
            "added" => true,
            "userId" => $userId
        ];
        echo json_encode($error);
    } else {
        $error = [
            "status" => true,
            "added" => false,
            "userId" => $userId
        ];
        echo json_encode($error);
    }
} else {
    echo "no data bruh";
}
?>