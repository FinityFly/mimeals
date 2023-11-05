<?php

// this one is for planned recipes

session_start();
include "db-conn.php";

$userId = $_SESSION['id'];
$sql = "SELECT * FROM `plannedMeals` WHERE userId = '$userId'";
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
?>