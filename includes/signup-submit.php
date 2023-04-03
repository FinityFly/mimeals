<?php
session_start();
include "db-conn.php";

if (isset($_POST['email-input']) && isset($_POST['password-input'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['name-input']);
    $uemail = validate($_POST['email-input']);
    $upassword = validate($_POST['password-input']);
    $ucpassword = validate($_POST['cpassword-input']);


    if (filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email='$uemail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uemail) {
                header("Location: ../guest-signup.php?error=Email already in use");
                exit();
            }
        } else {
            if ($upassword === $ucpassword) {
                $hashedPassword = hash('sha256', $upassword);
                $sql = "INSERT INTO `users`(`id`, `email`, `password`, `name`) VALUES (NULL, '$uemail','$hashedPassword','$uname');";
                mysqli_query($conn, $sql);
                $sql = "SELECT * FROM users WHERE email='$uemail'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                // ADD THE NEW ACCOUNT LANDING PAGE HERE LATER
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../dashboard.php");
                exit();
            } else {
                header("Location: ../guest-signup.php?error=Passwords don't match");
                exit();
            }
        }
    } else {
        header("Location: ../guest-signup.php?error=Invalid email");
        exit();
    }
} else {
    header("Location: ../index.php");
}
?>