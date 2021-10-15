<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once 'PHPMailer/vendor/autoload.php';

    $mail = new PHPMailer(true);

    $email = $_POST['email'];

    try {
        $mail->SMTPDebug = 1;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lalalelee99@gmail.com';
        $mail->Password   = 'hahahehe123!';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    
        $mail->setFrom('lalalelee99@gmail.com', 'Admin');
        $mail->addAddress($email, 'User');
    
        $mail->isHTML(true);
        $mail->Subject = 'Congratulations!';
        $mail->Body    = "
                            Your Account has registered, please activate by click button below
                            <br>
                            <a href='http://localhost/PAW/TravelKuy/API/process/auth/activateEmail.php?email=$email'>
                                <button>Activate</button>
                            </a>
                        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>