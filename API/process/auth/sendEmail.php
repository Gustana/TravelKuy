<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once 'PHPMailer/vendor/autoload.php';

    $mail = new PHPMailer(true);

    $email = $_POST['email'];
    $username = $_POST['nama'];

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    
        $mail->setFrom('lalalelee99@gmail.com', 'Admin');
        $mail->addAddress($email, $username);
    
        $mail->isHTML(true);
        $mail->Subject = 'Congratulations!';
        $mail->Body    = "
                            Your Account has registered, please activate by click button below
                            <br>
                            <a href='http://localhost/PAW/tubes/TravelKuy/API/process/auth/activateEmail.php?email=$email'>
                                <button>Activate</button>
                            </a>
                        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>