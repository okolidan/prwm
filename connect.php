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
    $number = $_POST['number'];
    $subject = $_POST['subject'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    

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
        $mail->Subject = "New Appointment Form Submission - $subject";
        $mail->Body    = "
            <h3>Contact Form Submission</h3>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Phone Number:</b> $number</p>
            <p><b>Subject:</b> $subject</p>
            <p><b>Date:</b> $date</p>
            <p><b>Time:</b> $time</p>
            
        ";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
