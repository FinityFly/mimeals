<?php
$server_name = "localhost";
$username = "root";
$password = "";
$db_usr_name = "mimeals_usr";
$db_api_name = "mimeals_api";
$conn = mysqli_connect($server_name, $username, $password, $db_usr_name);
$apiconn = mysqli_connect($server_name, $username, $password, $db_api_name);

if (!$conn || !$apiconn) {
    echo "Oop, connection failed";
}
?>