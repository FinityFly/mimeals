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

    $uemail = validate($_POST['email-input']);
    $upassword = validate($_POST['password-input']);
    $hashedPassword = hash('sha256', $upassword);

    if (filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email='$uemail' AND password='$hashedPassword'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uemail && $row['password'] === $hashedPassword) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../dashboard.php");
                exit();
            } else {
                header("Location: ../guest-login.php?error=Incorrect email/password");
                exit();
            }
        } else {
            header("Location: ../guest-login.php?error=Incorrect email/password");
            exit();
        }
    } else {
        header("Location: ../guest-login.php?error=Invalid email");
        exit();
    }
} else {
    header("Location: ../index.php");
}
?>