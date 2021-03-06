<?php

     // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../vendor/autoload.php';
    
    $subject = isset($_POST['subject']) ? $_POST['subject'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";
    
    if(validate($subject, $email, $message)){

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.datasights.ng';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'contact@datasights.ng';                     // SMTP username
            $mail->Password   = 'YOURPASSWORD HERE';                               // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('contact@datasights.ng', 'DataSights.ng - Contact Form');
            $mail->addAddress("contact@datasights.ng", "Contact Form");     // Add a recipient
            $mail->addReplyTo($email);
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Mail from DataSights.ng - " . $subject;
            $mail->Body    = "Email: " . $email . "\n\n" . $message;
            $mail->AltBody = "Email: " . $email . "\n\n" . $message;

            $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }else{
            echo 0;
        }
    

    function validate($name, $email, $message){

        if($name != " " && $email != " " && $message != " " && filter_var($email, FILTER_VALIDATE_EMAIL)){
               return true;
        }
         
         return false;
    }
    


    
