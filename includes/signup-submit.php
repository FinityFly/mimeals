<?php
session_start();
include "db-conn.php";

if (isset($_POST['email-input']) && isset($_POST['password-input'])) {
    
    // sanitize the data to prevent web attacks
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

    // A) Check if submitted email is a valid email address
    if (filter_var($uemail, FILTER_VALIDATE_EMAIL)) {

        // check database if a user pre-exists with the submitted email
        $sql = "SELECT * FROM users WHERE email='$uemail'";
        $result = mysqli_query($conn, $sql);

        // if a result appears, then this user already exists. Return an error message to the user.
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uemail) {
                header("Location: ../guest-signup.php?error=Email already in use");
                exit();
            }
        } else {

            // C) check if two passwords match
            if ($upassword === $ucpassword) {

                // hash the password for security and privacy purposes
                $hashedPassword = hash('sha256', $upassword);
                
                //store the user's name, hashed password, and email in the database
                $sql = "INSERT INTO `users`(`id`, `email`, `password`, `name`) 
                                    VALUES (NULL, '$uemail','$hashedPassword','$uname');";
                mysqli_query($conn, $sql);  

                // uhm why are we doing this
                $sql = "SELECT * FROM users WHERE email='$uemail'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                // create Session variables and redirect user to 'dashboard'
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../dashboard.php");
                exit();
            } else {
                // C) if passwords do not match, return an error message to the user. 
                header("Location: ../guest-signup.php?error=Passwords don't match");
                exit();
            }
        }
    } else {
        // A) If the submitted email is not valid address, return an error message to the user. 
        header("Location: ../guest-signup.php?error=Invalid email");
        exit();
    }
} else {
    header("Location: ../index.php");
}
?>