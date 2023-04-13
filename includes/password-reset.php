<?php
include "db-conn.php";

if (isset($_POST['password-input']) && isset($_POST['cpassword-input'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $selector = validate($_POST['selector']);
    $validator = validate($_POST['validator']);
    $upassword = validate($_POST['password-input']);
    $ucpassword = validate($_POST['cpassword-input']);

    if ($upassword != $ucpassword) {
        header("Location: ../create-new-password.php?error=Passwords don't match");
        exit();
    }

    $currentDate = date("U");

    $sql = "SELECT * FROM pwdReset WHERE selector='$selector' AND expires >= '$currentDate'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row['token']);
        if ($tokenCheck) {
            $tokenEmail = $row['email'];
            $sql = "SELECT * FROM users WHERE email='$tokenEmail'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {
                $hashedPassword = hash('sha256', $upassword);
                $sql = "UPDATE users SET password='$hashedPassword' WHERE email='$tokenEmail'";
                mysqli_query($conn, $sql);
                $sql = "DELETE FROM pwdReset WHERE selector='$selector'";
                mysqli_query($conn, $sql);
                header("Location: ../create-new-password.php?reset=success&selector=" . $selector . "&validator=" . bin2hex($validator));
                exit();
            } else {
                header("Location: ../create-new-password.php?reset=error&selector=" . $selector . "&validator=" . bin2hex($validator));
                exit();
            }
        } else {
            header("Location: ../create-new-password.php?reset=error&selector=" . $selector . "&validator=" . bin2hex($validator));
            exit();
        }
    } else {
        header("Location: ../create-new-password.php?reset=error&selector=" . $selector . "&validator=" . bin2hex($validator));
        exit();
    }
} else {
    header("Location: ../index.php");
}
?>