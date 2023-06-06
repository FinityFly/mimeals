<?php

// this one is for planned recipes

session_start();
include "db-conn.php";

$request = file_get_contents("php://input"); // gets the raw data
$post = json_decode($request, true); // true for return as array

if (isset($post['recipeId'])) {
    $userId = $_SESSION['id'];
    $recipeId = $post['recipeId'];

    $sql = "SELECT * FROM `plannedMeals` WHERE userId = '$userId' AND recipeId = '$recipeId'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
        $data = json_encode(array('empty' => false, 'recipes' => $row));
    echo $data;
    } else {
        $return = [
            "empty" => true
        ];
        echo json_encode($return);
    }
} else {
    echo "bruh";
}
?>