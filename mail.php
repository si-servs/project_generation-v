<?php

    header("Access-Control-Allow-Origin: *");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    $form = $_GET["form"];
    switch ($form){
        case "home":
            $name = trim($_POST["fname"]);
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $message = trim($_POST["msg"]);

            // Build the email content.
            $email_content = "Name: $name\n";
            $email_content .= "Email: $email\n\n";
            $email_content .= "Phone: $phone\n\n";
            $email_content .= "Message:\n$message\n";
            break;

        case "contact":
            $name = trim($_POST["fname"]);
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $code = trim($_POST["code"]);
            $location = trim($_POST["location"]);
            $comment = trim($_POST["comment"]);

            $radio1 = $_POST['radio1'];
            $radio2 = $_POST['radio2'];
            $radio3= $_POST['radio3'];


            // Build the email content.
            $email_content = "For: $radio1\n";
            $email_content = "I need it: $radio2\n";
            $email_content = "Reach me by: $radio3\n";
            $email_content = "Name: $name\n";
            $email_content .= "Email: $email\n\n";
            $email_content .= "Phone: $code.$phone\n\n";
            $email_content .= "Location: $location\n\n";
            $email_content .= "Comment:\n$comment\n";
            break;
    }

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ibrahim.aboukhalil@pomechain.com';     //SMTP username
    $mail->Password   = 'dxb@pomechain2022';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ibrahim.aboukhalil@pomechain.com', 'Mailer');
    $mail->addAddress($email, $name);     //Add a recipient

    //Content
    $mail->Subject = 'New contact from Form ['.$form.']';
    $mail->Body    = $email_content;

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}
?>
