<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'PHPMailer/vendor/autoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    
   
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username = 'properrity@gmail.com';
        $mail->Password = 'inder@123';;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->isHTML(true);
        $mail->setFrom('inderpreet0508@gmail.com', $subject); 
        $mail->addAddress("inderpreet0805@gmail.com","Inder");
        $mail->Subject = ("$email ($subject)");
        $mail->Body = '<p>From:'.$name.'</p><br>'.'<p>subject:'.$subject.'</p><br>
        <p>Message:'.$message.'</p>';
    
        
        
        $mail->send();
        echo 'mail has been sent';
        header("Location:contact.php");
        } catch (Exception $e) {
            echo "mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

      

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Link Tags-->
    <?php include "common/links.php" ?>
    <title>Contact Us</title>
</head>

<body class="bg-light">
    <?php include "common/navbar.php" ?>
    <div class="container-fluid" id="contactus">
        <div class='row m-0'>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="row shadow-lg mx-5 my-5 bg-white">
                    <br>
                    <div class="md-hide img-bg col-lg-5 col-xl-5">
                        &nbsp;
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
                        <h3 class='lg-ft my-4 text-center'>CONTACT US</h3>

                        <form method="post">
                            <div class="form-group">
                                <label htmlFor="name">Enter Name</label>
                                <input type="text" name='name' class='form-control' placeholder='Enter Name' />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="Subject" placeholder="Subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <label htmlFor="message">Enter Message </label>
                                <textarea name="message" id="message" class="form-control" cols="20" rows="5"></textarea>
                            </div>


                            <input type="submit" value='Submit' name="submit" class='btn btn-dark btn-block' />

                        </form>
                        <br>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Script tags-->
    <?php include "common/scripts.php" ?>
</body>

</html> 