<?php
$server_name = "azureprivatedns.net";
$username = "bgoictwmuo";
$password = "C26L3E2V50WJ34I5$";
$db_name = "mimeals_usr";
$conn = mysqli_connect($server_name, $username, $password, $db_name);

if (!$conn) {
    echo "Oop connection failed!";
}