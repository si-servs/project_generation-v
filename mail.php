<?php

    header("Access-Control-Allow-Origin: *");
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

        // Set the recipient email address.
        $recipient = "ibrahimakdxb@gmail.com";

        // Set the email subject.
        $subject = "New contact from Form [".$form."]";


        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            return true;
        } else {
            return false;
        }
?>
