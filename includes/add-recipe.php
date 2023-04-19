<?php
include "db-conn.php";
if (isset($_GET['recipeId'])) {
    echo "sup!";
}
if ($bucketlist < 1) {
    echo "yes!";
    $userId = $_SESSION['id'];
    echo "$userId";
    $recipeId = $_POST['recipeId'];
    echo "$recipeId";
    $recipeTitle = $_POST['recipeTitle'];
    echo "3";
    $recipeImage = $_POST['recipeImage'];
    echo "4";
    $sql = "INSERT INTO `addedRecipes` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`)  VALUES (NULL, '$userId', '$recipeId', '$recipeTitle', '$recipeImage')";
    echo "5";
    mysqli_query($conn, $sql);
    echo "6";
    return json_encode(array("status" => true, "added" => true));
} else {
    echo "no!";
    return json_encode(array("status" => true, "added" => false));
}
?>