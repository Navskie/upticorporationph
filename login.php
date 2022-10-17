<html class="no-js" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Uptimised Corporation</title>
<meta name="description" content="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/274966106_640652090373107_513539919171817442_n.ico">
<!-- Plugins CSS -->
<link rel="stylesheet" href="assets/css/plugins.css">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<!-- Main Style CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Toastr -->
<link rel="stylesheet" href="toastr/toastr.min.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<?php
  // session_start();
  include 'include/db.php';
  include 'function.php'; 

  // delete pending order 
  $less_date = date('m-d-Y', strtotime('-14 days'));

  $pending_auto = mysqli_query($connect, "UPDATE upti_transaction SET trans_status = 'Canceled' WHERE trans_date <= '$less_date' AND trans_status = 'Pending' AND trans_mop != 'Cash on Pick Up'");

  $pending_auto2 = mysqli_query($connect, "UPDATE upti_order_list SET ol_status = 'Canceled' WHERE ol_date <= '$less_date' AND ol_status = 'Pending'");
?>
<?php
    session_start();
    if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
        $_SESSION['status'] = 'invalid';
      }
    
      if ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIMAIN') {
        header('Location: system/uptimain.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIMAINS') {
        header('Location: system/uptimain.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIHR') {
        header('Location: system/uptimain.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIRESELLER') {
        header('Location: system/reseller.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIMANAGER') {
        header('Location: system/manager.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTILEADER') {
        header('Location: system/leader.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIOSR') {
        header('Location: system/osr.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTICREATIVES') { 
        header('Location: creatives.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTICSR') {
        header('Location: system/uptikier.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'SPECIAL') {
        header('Location: system/admin-reseller.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIACCOUNTING') {
        header('Location: system/accounting.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'IT/Sr Programmer') {
        header('Location: system/navskie.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'BRANCH') {
        header('Location: system/branch.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'ADS') {
        header('Location: system/ads.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'WEBSITE') {
        header('Location: system/cs-onprocess-order.php');
      }
      elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'Customer') {
        header('Location: profile.php');
      }
?>
<?php
    include 'system/smtp/PHPMailerAutoload.php';  

    date_default_timezone_set('Asia/Manila');
    $araw_ngayon = date('m-d-Y');

    $default_email = 'uptimisedcorporation2022@gmail.com';

    $get_stockist = "SELECT * FROM stockist_inventory";
    $get_stockist_qry = mysqli_query($connect, $get_stockist);
    while($get_stockist_fetch = mysqli_fetch_array($get_stockist_qry))
    // $get_stockist_num = mysqli_num_rows($get_stockist_qry);
    {
      // echo '<br>';
      $stockist_code = $get_stockist_fetch['si_code']; 
      // echo ' - ';
      $si_item_code = $get_stockist_fetch['si_item_code'];
      // echo ' - ';
      $si_item_desc = $get_stockist_fetch['si_item_desc'];
      // echo ' - ';
      $si_item_country = $get_stockist_fetch['si_item_country'];
      // echo ' - ';
      $si_item_stock = $get_stockist_fetch['si_item_stock'];
      // echo ' > ';
      $si_item_critical = $get_stockist_fetch['si_item_critical'];
      // echo '<br>';
  
      if ($si_item_stock <= $si_item_critical) {
        // echo 'mas mataas si critical';
        // echo '<br>';
        $warning = "SELECT * FROM stockist_warning WHERE warning_date = '$araw_ngayon' AND warning_country = '$si_item_country' AND warning_status = 'Sent' AND warning_code = '$si_item_code' AND warning_stockist = '$stockist_code'";
        $warning_qry = mysqli_query($connect, $warning);
        $warning_num_rows = mysqli_num_rows($warning_qry);
  
        if ($warning_num_rows == 0) {
          $insert_warning = "INSERT INTO stockist_warning (
              warning_date,
              warning_code,
              warning_desc,
              warning_qty,
              warning_status, 
              warning_country,
              warning_stockist
            ) VALUES (
              '$araw_ngayon',
              '$si_item_code',
              '$si_item_desc',
              '$si_item_stock',  
              'Sent',
              '$si_item_country',
              '$stockist_code'
            )";
          $insert_warning_sql = mysqli_query($connect, $insert_warning);
          
          $get_email = "SELECT * FROM upti_reseller WHERE reseller_code = '$stockist_code'";
          $get_email_qry = mysqli_query($connect, $get_email);
          $get_email_fetch = mysqli_fetch_array($get_email_qry);
  
          $reseller_email = $get_email_fetch['reseller_email'];
          $reseller_name = 'UPTIMAIN';
  
          if ($reseller_email != '') {
            $default_email = $get_email_fetch['reseller_email'];
            $reseller_name = $get_email_fetch['reseller_name'];
          }
  
          $remarks = 'Good Day, '.$reseller_name. ',<br><br> Your stock on hand for '.$si_item_desc.' has reached its critical level. It’s about time to re-stock!<br><br>Thank you,<br>Uptimised';
  
          $mail = new PHPMailer(); 
          //$mail->SMTPDebug=3;
          $mail->IsSMTP(); 
          $mail->SMTPAuth = true; 
          $mail->SMTPSecure = 'ssl'; 
          $mail->Host = "smtp.hostinger.com";
          $mail->Port = "465"; 
          $mail->IsHTML(true);
          $mail->CharSet = 'UTF-8';
          $mail->Username = "system@upticorporationph.com";
          $mail->Password = '@User2022';
          $mail->SetFrom("system@upticorporationph.com", "Critical Stocks");
          $mail->Subject = 'Critical Stocks Warning';
          $mail->Body = $remarks;
          $mail->AddAddress($default_email);
          $mail->SMTPOptions=array('ssl'=>array(
              'verify_peer'=>false,
              'verify_peer_name'=>false,
              'allow_self_signed'=>false
          ));
          if(!$mail->Send()){
              echo $mail->ErrorInfo;
          }
  
        }
  
      } 
      // else {
      //   echo 'mas mataas si stock';
      //   echo '<br>';
      // }
    }


?>
<!--Body Content-->
<div id="page-content">     
    
    <div class="katawan">
      <div class="contain">
        <div class="forms">
          <div class="form login">
            <span class="title">Uptimised Corporations</span>
            <form action="login-process.php" method="post">
              <div class="input-field">
                <input type="text" name="us" placeholder="Input your username" required autocomplete="off">
                <i class="uil uil-user icon"></i>
              </div>
              <div class="input-field">
                <input type="password" name="pw" class="password" placeholder="Input your password" required autocomplete="off">
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash showHidePw"></i>
              </div>

              <div class="checkbox-text">
                <div class="checkbox-content">
                  <!-- <input type="checkbox" name="" id="logCheck"> -->
                  <!-- <label for="logCheck" class="text" style="align-items: center;">Remember Me</label> -->
                </div>

                <a href="system/index.php" class="text">Forgot Password</a>
              </div>

              <div class="input-field button">
                <input type="submit" value="Sign In" name="sign-in">
              </div>
            </form>
            <div class="login-signup">
              <span class="text">Not a member? <br><br>
                <a href="#" class="text signup-link" style="padding: 14px 20px !important; background: #4070f4; color: #fff">Signup now</a>
              </span>
            </div>
          </div>

          <!-- Register -->
          <div class="form signup">
            <span class="title">Be ones of us</span>
            <form action="login-process.php" method="post">
              <div class="input-field">
                <input type="text" placeholder="Username" name="us" required autocomplete="off">
                <i class="uil uil-user icon"></i>
              </div>              
              <div class="row">
                <div class="col-6">
                  <div class="input-field">
                    <input type="password" class="password" name="pw" placeholder="password" required autocomplete="off">
                    <i class="uil uil-lock icon"></i>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-field">
                    <input type="password" class="password" name="pw2" placeholder="Retype password" required autocomplete="off">
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-field">
                    <input type="text" placeholder="First Name" name="fn" required autocomplete="off">
                    <i class="uil uil-user-plus"></i>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-field">
                    <input type="text" placeholder="Last Name" name="ln" required autocomplete="off">
                    <i class="uil uil-user-plus"></i>
                  </div>
                </div>
              </div>
              <div class="input-field">
                <input type="email" placeholder="Email Address" name="ea" required autocomplete="off">
                <i class="uil uil-envelope-shield"></i>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="input-field">
                    <input type="text" placeholder="Mobile Number" name="mn" required autocomplete="off">
                    <i class="uil uil-phone"></i>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-field">
                    <input type="date" placeholder="Birthday" name="bday" required autocomplete="off">
                    <i class="uil uil-gift"></i>
                  </div>
                </div>
              </div>

              <div class="input-field button">
                <input type="submit" value="Sign Up" name="signup">
              </div>
            </form>
            <div class="login-signup">
              <span class="text">
                <a href="#" class="text login-link">Signin now</a>
              </span>
            </div>
          </div>
          
        </div>
      </div>
    </div>

</div>
<script src="assets/js/custom.js"></script>
<!--End Body Content-->
    
<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/jquery.cookie.js"></script>
<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/js/vendor/wow.min.js"></script>
<script src="assets/js/vendor/masonry.js" type="text/javascript"></script>
<!-- Including Javascript -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/lazysizes.js"></script>
<script src="assets/js/main.js"></script>
<!-- Photoswipe Gallery -->
<script src="assets/js/vendor/photoswipe.min.js"></script>
<script src="toastr/toastr.min.js"></script>
<script src="assets/js/vendor/photoswipe-ui-default.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    <?php if (isset($_SESSION['warn'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error("<?php echo flash('warn'); ?>");

        <?php } ?>
  <?php if (isset($_SESSION['success'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success("<?php echo flash('success'); ?>");

    <?php } ?>
</script>
</html>