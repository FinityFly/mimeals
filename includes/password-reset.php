<?php
include "db-conn.php";

if (isset($_POST['password-input']) && isset($_POST['cpassword-input'])) {
    function validate($data) {
        // sanitize data
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // cleanse the data from create-new-password.php
    $selector = validate($_POST['selector']);
    $validator = validate($_POST['validator']);
    $upassword = validate($_POST['password-input']);
    $ucpassword = validate($_POST['cpassword-input']);

    if ($upassword != $ucpassword) {
        header("Location: ../create-new-password.php?error=Passwords don't match");
        exit();
    }

    $currentDate = date("U");

    // from the reset password database, find the data entry that has the same 'selector' value, and has an expiry date that is greater than the current time (meaning it has not expired yet)
    $sql = "SELECT * FROM pwdReset WHERE selector='$selector' AND expires >= '$currentDate'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result)) {
        // get the result
        $row = mysqli_fetch_assoc($result);
        $tokenBin = hex2bin($validator);
        // verify the token
        $tokenCheck = password_verify($tokenBin, $row['token']);
        if ($tokenCheck) {
            // get the email from the token
            $tokenEmail = $row['email'];
            // search the password database for the user with the same email as the token 
            $sql = "SELECT * FROM users WHERE email='$tokenEmail'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {

                // if the password matches, update the new password
                $hashedPassword = hash('sha256', $upassword);
                $sql = "UPDATE users SET password='$hashedPassword' WHERE email='$tokenEmail'";
                mysqli_query($conn, $sql);

                // delete the password reset data in the reset password database
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