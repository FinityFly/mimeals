<?php
include "db-conn.php";
// import libraries for sending Emails using PHP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['email-input'])) {
    // function to sanitize data
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // sanitize the email input
    $uemail = validate($_POST['email-input']);

    // check if the email exists in the database
    if (filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email='$uemail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);

            // if the email exists, send the reset request
            if ($row['email'] === $uemail) {

                // create a selector and token to identify the user
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);
                
                // create a selector and token to recognize
                // Gonna need to change this URL later 
                $url = "http://localhost/sdp/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

                $expires = date("U") + 1800; // one hour reset expiry date

                // delete previous password reset results for this email
                $sql = "DELETE FROM pwdReset WHERE email='$uemail'";
                $result = mysqli_query($conn, $sql);

                // create a token to identify this specific password reset attempt
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                
                // insert the email, selector, token and expiry date into the password reset database
                $sql = "INSERT INTO pwdReset (id, email, selector, token, expires) VALUES (NULL, '$uemail', '$selector', '$hashedToken', '$expires');";
                $result = mysqli_query($conn, $sql);


                // Email Contents
                $subject = 'Reset your MiMeals password';
                $message = '<p> We have received a request to reset your MiMeals account password. To reset your password, click on the link below and follow the prompts. If you did not make this request, you can ignore this email. This link will expire in an hour.</p>';
                $message .= '<p>Here is your password reset link:</p>';
                $message .= '<p><a href="' . $url . '">' . $url . '</a></p>';
                try {
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'mimeals23@gmail.com';                     //SMTP username
                    $mail->Password   = 'lukezdavzpuueajh';                               //SMTP password
                    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    $mail->setFrom('mimeals23@gmail.com', 'MiMeals Services');
                    $mail->addAddress($uemail);
                    $mail->addReplyTo('mimeals23@gmail.com', 'MiMeals Services');

                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    if( !$mail->Send()) {
                        header("Location: ../reset-password.php?reset=error");
                        var_dump($mail);
                    } else {
                        header("Location: ../reset-password.php?reset=success");
                    }

                } catch (Exception $e) {
                    header("Location: ../reset-password.php?reset=error");
                }
                exit();
            } else {
                header("Location: ../reset-password.php?reset=Invalid email");
                exit();
            }
        } else {
            header("Location: ../reset-password.php?reset=Invalid email");
            exit();
        }
    } else {
        header("Location: ../reset-password.php?reset=Invalid email");
        exit();
    }
} else {
    header("Location: ../index.php");
}
?>