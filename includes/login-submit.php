<?php
session_start();
include "db-conn.php";


if (isset($_POST['email-input']) && isset($_POST['password-input'])) {
    
    // define a function to sanitize input data to prevent web attacks
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Sanitize email and password inputs
    // and hash the password to keep user data secure in case of data leaks
    $uemail = validate($_POST['email-input']);
    $upassword = validate($_POST['password-input']);
    $hashedPassword = hash('sha256', $upassword);

    // check if email is valid
    if (filter_var($uemail, FILTER_VALIDATE_EMAIL)) {

        // if the email is valid, check if any users exist in the 'users' database 
        // with the same email and hashed password.
        $sql = "SELECT * FROM users WHERE email='$uemail' AND password='$hashedPassword'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);

            // if a pair of email/hashed password from the database matches
            // store the user's () in session variables

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