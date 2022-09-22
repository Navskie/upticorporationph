<?php
include 'dbms/conn.php';
include('smtp/PHPMailerAutoload.php');

if (isset($_POST['fp'])) {
        
    $Email_ = $_POST['email'];
    $BdaY_ = $_POST['bday'];

    $get_info = "SELECT * FROM upti_reseller WHERE reseller_email = '$Email_' AND reseller_bday = '$BdaY_'";
    $get_info_sql = mysqli_query($connect, $get_info);
    $get_info_num = mysqli_num_rows($get_info_sql);
    $get_info_fetch = mysqli_fetch_array($get_info_sql);
    
    if($get_info_num == 0) {
        echo "<script>alert('Incorrect Email Address and Birthday');window.location='index.php'</script>";
    }
    
    $email_add = $get_info_fetch['reseller_email'];
    $name = $get_info_fetch['reseller_name'];
    $reseller_code = $get_info_fetch['reseller_code'];
    
    $newpass = uniqid();
    
    $update_reseller = "UPDATE upti_users SET users_password = '$newpass' WHERE users_code = '$reseller_code'";
    $update_reseller_sql = mysqli_query($connect, $update_reseller);
    
    $remarks = 'Hi '.$name. ',<br><br> We’ve received a request for a new password for your Uptimised Reseller account. You may now log-in to the Uptimised Systems Portal using your new password below:<br><br> New Password: <b>'.$newpass.'</b><br><br>Should you wish to change your system-generated password, go to “Information” in your reseller account and provide your preferred password.<br><br>
	This is a system-generated e-mail. Please do not reply.';

        // $mail->smtp_mailer($email_add,'Forgot Password',$remarks);
        // $mail->smtp_mailer($to,$subject, $msg);
    	$mail = new PHPMailer(); 
    	//$mail->SMTPDebug=3;
    	$mail->IsSMTP(); 
    	$mail->SMTPAuth = true; 
    	$mail->SMTPSecure = 'ssl'; 
    	$mail->Host = "smtp.hostinger.com";
    	$mail->Port = "465"; 
    	$mail->IsHTML(true);
    	$mail->CharSet = 'UTF-8';
    	$mail->Username = "rcnwebdeveloper@upticorporationph.com";
    	$mail->Password = '@User2022';
    	$mail->SetFrom("rcnwebdeveloper@upticorporationph.com");
    	$mail->Subject = 'Forgot Password';
    	$mail->Body =$remarks;
    	$mail->AddAddress($email_add);
    	$mail->SMTPOptions=array('ssl'=>array(
    		'verify_peer'=>false,
    		'verify_peer_name'=>false,
    		'allow_self_signed'=>false
    	));
    	if(!$mail->Send()){
    		echo $mail->ErrorInfo;
    	}else{
    		echo "<script>alert('Please check your email address');window.location='index.php'</script>";
    	}
    
}
        
?>