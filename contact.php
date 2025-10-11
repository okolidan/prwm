<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com'; // or your mail server
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'clemokolichambers@gmail.com'; // your Gmail
        $mail->Password   = 'lmtiknrougmrlbik'; // use Gmail app password
        $mail->SMTPSecure = 'tls';            
        $mail->Port       = 587;                                    

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('clemokolichambers@gmail.com', 'Law Firm');  

        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = "New Contact Form Submission - $subject";
        $mail->Body    = "
            <h3>Contact Form Submission</h3>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Number:</b> $number</p>
            <p><b>Service:</b> $subject</p>
            <p><b>Message:</b><br>$message</p>
        ";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
