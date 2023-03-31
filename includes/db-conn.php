<?php
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "mimeals_usr";
$conn = mysqli_connect($server_name, $username, $password, $db_name);

if (!$conn) {
    echo "Oop connection failed!";
}