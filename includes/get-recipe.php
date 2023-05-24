<?php
session_start();
include "db-conn.php";

$userId = $_SESSION['id'];
$sql = "SELECT * FROM `addedRecipes` WHERE userId = '$userId'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res)) {
    $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $data = json_encode(array('empty' => false, 'recipes' => $row));
    print_r($data);
    echo $data;
} else {
    $return = [
        "empty" => true
    ];
    echo json_encode($return);
}
?>