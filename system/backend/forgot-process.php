<?php
    include '../dbms/conn.php';
    
    include "../PHPMailer/src/PHPMailer.php";
    require "../PHPMailer/src/SMTP.php";
    require "../PHPMailer/src/Exception.php";

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['fp'])) {
        
        $Email_ = $_POST['email'];
        $BdaY_ = $_POST['bday'];

        $get_info = "SELECT * FROM upti_reseller WHERE reseller_email = '$Email_' AND reseller_bday = '$BdaY_'";
        $get_info_sql = mysqli_query($connect, $get_info);
        $get_info_num = mysqli_num_rows($get_info_sql);
        $get_info_fetch = mysqli_fetch_array($get_info_sql);

        if($get_info_num > 0) {

            $email_add = $get_info_fetch['reseller_email'];
            $name = $get_info_fetch['reseller_name'];

            // Create Instance of PHPMAILER
            $mail = new PHPMailer();
            
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            
            //Set SMTP host name                          
            $mail->Host = "smtp.gmail.com";
            
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;

            //If SMTP requires TLS encryption then set it
            // $mail->SMTPSecure = "tls";
        
            //Set TCP port to connect to
            $mail->Port = 587;
            
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            //Provide username and password     
            $mail->Username = "uptimisedcorporation2022@gmail.com";
            $mail->Password = "@User2022";
            
            $mail->From = "uptimisedcorporation2022@gmail.com";
            $mail->FromName = "Uptimised Corporation Philippines";
            
            $mail->addAddress($email_add, $name);
            
            $mail->isHTML(true);
            
            $mail->Subject = "Forgot Password Code";
            
            $mail->Body = "Hello Name, Here's your new password: <b> 123456 </b>";  
            
            try {
                $mail->send();
                echo "<script>alert('Please check your email address to verify code');window.location='../index.php'</script>";
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                echo "TEst Error";
            }
        } else {
            echo "<script>alert('Email Address and Birthday not match, Please Try Again!');window.location='../index.php'</script>";
        }
    }
?>