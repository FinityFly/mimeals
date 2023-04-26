<?php
include "db-conn.php";
echo $_POST['recipeId'];
// $json = json_decode($_POST);
// echo $json;
if (isset($_POST['recipeId'])) {
    // $json = json_decode($_POST);
    echo "hi!";
    if ($bucketlist < 1) {
        $userId = $_SESSION['id'];
        $recipeId = $_POST['recipeId'];
        $recipeTitle = $_POST['recipeTitle'];
        $recipeImage = $_POST['recipeImage'];
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