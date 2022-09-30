<?php include 'include/header.php'; ?>

<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
        include 'include/preloader.php';
        include 'include/stockist-navbar.php';
        include 'include/stockist-bar.php'; 
  } else {  ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<!-- Pop Up Image -->
<?php } ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: steelblue">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
        </div><!-- /.row --> 
        <?php
            $Ucode = $_SESSION['code'];

            $information_sql = "SELECT * FROM upti_reseller INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_users.users_code = '$Ucode'";
            $information_qry = mysqli_query($connect, $information_sql);
            $information = mysqli_fetch_array($information_qry);

            $image = $information['users_img'];
            $name = $information['reseller_name'];
            $b_day = $information['reseller_bday'];
            $mobiles = $information['reseller_mobile'];
            $emails = $information['reseller_email'];
            $addresss = $information['reseller_address'];
            $user = $information['users_username'];
            $oldpassword = $information['users_password'];

        ?>
        <!-- START HERE -->
        <div class="row">
            <!-- First Column Start -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <!-- Customer Information Start -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <h5 class="text-info">Personal Information <?php $SCode = $_SESSION['code']; ?></h5>
                        <hr>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <img src="images/profile/<?php echo $information['users_img'] ?>" alt="" class="img-fluid border border-dark">
                            </div>
                            <div class="col-2"></div>
                            <div class="col-12 text-center">
                                Seller Code: <b class="text-primary"><?php echo $information['users_code'] ?></b>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <label>Full Name</label><br>
                        <span><i>→ <?php echo $information['users_name'] ?></i></span>
                        <br><br>
                        <label>Birthday</label><br>
                        <span><i>→ <?php echo $information['reseller_bday'] ?></i></span>
                        <br><br>
                        <label>Mobile Number</label><br>
                        <span><i>→ <?php echo $information['reseller_mobile'] ?></i></span>
                        <br><br>
                        <label>Complete Address</label><br>
                        <span><i>→ <?php echo $information['reseller_address'] ?></i></span>
                        <br><br>
                        <label>Email Address</label><br>
                        <span><i>→ <?php echo $information['reseller_email'] ?></i></span>
                    </div>
                </div>
                <!-- Customer Information End -->
            </div>
            <!-- First Column End -->

            <!-- Second Column Start -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- Customer Information Start -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <h5 class="text-info">Update Personal Information</h5>
                        <hr>
                        <?php
                            if (isset($_POST['update_info'])) {
                                $fullname = $_POST['fullname'];
                                $bday = $_POST['bday'];
                                $mobile = $_POST['mobile'];
                                $email = $_POST['email'];
                                $address = $_POST['address'];
                                $password = $_POST['password'];
                
                                if ($fullname == '') {
                                    $fullname = $name;
                                }
                                if ($bday == '') {
                                    $bday = $b_day;
                                }
                                if ($mobile == '') {
                                    $mobile = $mobiles; 
                                }
                                if ($email == '') {
                                    $email = $emails;
                                }
                                if ($address == '') {
                                    $address = $addresss;
                                }
                
                                if ($password == $oldpassword) {
                                    
                                    if ($reseller_email == $email) {
                                        $reseller_info_update = "UPDATE upti_reseller SET reseller_name = '$fullname', reseller_bday = '$bday', reseller_mobile = '$mobile', reseller_address = '$address', reseller_email = '$email' WHERE reseller_code = '$Ucode'";
                                        $reseller_info_qry = mysqli_query($connect, $reseller_info_update);
    
                                        $user_info_update = "UPDATE upti_users SET users_name = '$fullname' WHERE users_code = '$Ucode'";
                                        $user_info_qry = mysqli_query($connect, $user_info_update);
                                        
                                        echo "<script>alert('Personal Information has been updated successfully');window.location.href='information.php';</script>";
                                    } else {
                                        $check_email = "SELECT * FROM upti_reseller WHERE reseller_email = '$email'";
                                        $check_email_qry = mysqli_query($connect, $check_email);
                                        $check_email_num = mysqli_num_rows($check_email_qry);
                                        
                                        if ($check_email_num == 1) {
                                            echo '<div class="alert alert-danger rounded-0" role="alert">
                                            Email Already Exist, Please Try Again!
                                          </div>';
                                        } else {
                                            $reseller_info_update = "UPDATE upti_reseller SET reseller_name = '$fullname', reseller_bday = '$bday', reseller_mobile = '$mobile', reseller_address = '$address', reseller_email = '$email' WHERE reseller_code = '$Ucode'";
                                            $reseller_info_qry = mysqli_query($connect, $reseller_info_update);
        
                                            $user_info_update = "UPDATE upti_users SET users_name = '$fullname' WHERE users_code = '$Ucode'";
                                            $user_info_qry = mysqli_query($connect, $user_info_update);
                                            
                                            echo "<script>alert('Personal Information has been updated successfully');window.location.href='information.php';</script>";
                                        }
                                    }

                                    // echo "<script>window.location.href='information.php';</script>";

                                    // echo '<div class="alert alert-success rounded-0" role="alert">
                                    // Personal Information has been updated successfully!
                                //   </div>';
                                } else {
                                    echo '<div class="alert alert-danger rounded-0" role="alert">
                                    Incorrect Password, Please Try Again!
                                  </div>';
                                }
                            }
                            if ($emails == '' || $b_day == '') {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Note:</strong> Please update your Birthday and Email Address.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php } ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input type="text" class="form-control rounded-0" autocomplete="off" name="fullname">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Birthday</label>
                                        <input type="date" class="form-control rounded-0" autocomplete="off" name="bday">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Mobile Number</label>
                                        <input type="text" class="form-control rounded-0" autocomplete="off" name="mobile">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Complete Address</label>
                                        <input type="text" class="form-control rounded-0" autocomplete="off" name="address">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Email Address</label>
                                        <input type="email" class="form-control rounded-0" autocomplete="off" name="email">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for=""><b>NOTE:</b> <i class="text-danger">Retype Current Password</i></label>
                                        <input type="password" class="form-control rounded-0" autocomplete="off" required name="password">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <button class="btn btn-success rounded-0 float-right" name="update_info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Customer Information End -->

                <!-- Login Information Start -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <h5 class="text-info">Update Login Information</h5>
                        <hr>
                        <?php
                            if (isset($_POST['update_login'])) {
                                $username = $_POST['user'];
                                $npassword = $_POST['npass'];
                                $password = $_POST['pass'];
                                $img_name = $_FILES['file']['name'];
                                $img_size = $_FILES['file']['size'];
                                $img_tmp = $_FILES['file']['tmp_name'];

                                if ($username == '') {
                                    $username = $user;
                                }
                                if ($npassword == '') {
                                    $npassword = $oldpassword;
                                }



                                    if ($img_name == '') {
                                        if ($username == $user) {
                                            $update_login = "UPDATE upti_users SET users_username = '$username', users_password = '$npassword' WHERE users_code = '$Ucode'";
                                            $update_login_qry = mysqli_query($connect, $update_login);
    
                                            echo "<script>window.location.href='information.php';</script>";
                                        } else {
                                            $check_username = "SELECT * FROM upti_users WHERE users_username = '$username'";
                                            $check_username_qry = mysqli_query($connect, $check_username);
                                            $check_username_num = mysqli_num_rows($check_username_qry);
    
                                            if ($check_username_num == '1') {
                                                echo '<div class="alert alert-danger rounded-0" role="alert">
                                                Username already exist on the system, Please try again!
                                              </div>';
                                            } else {
                                                $update_login = "UPDATE upti_users SET users_username = '$username', users_password = '$npassword' WHERE users_code = '$Ucode'";
                                                $update_login_qry = mysqli_query($connect, $update_login);
    
                                                echo "<script>window.location.href='information.php';</script>";
                                            }
                                        }
                                    } else {
                                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

                                        $img_ex_lc = strtolower($img_ex);

                                        $allow_ex = array("jpg", "jpeg", "png");

                                        $new_name = uniqid("P", true).'.'.$img_ex_lc;
                                        $img_path_sa_buhay_niya = 'images/profile/'.$new_name;
                                        move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);
                                    
                                        if ($username == $user) {
                                            $update_login = "UPDATE upti_users SET users_img = '$new_name', users_username = '$username', users_password = '$npassword' WHERE users_code = '$Ucode'";
                                            $update_login_qry = mysqli_query($connect, $update_login);
    
                                            echo "<script>window.location.href='information.php';</script>";
                                        } else {
                                            $check_username = "SELECT * FROM upti_users WHERE users_username = '$username'";
                                            $check_username_qry = mysqli_query($connect, $check_username);
                                            $check_username_num = mysqli_num_rows($check_username_qry);
    
                                            if ($check_username_num == '1') {
                                                echo '<div class="alert alert-danger rounded-0" role="alert">
                                                Username already exist on the system, Please try again!
                                              </div>';
                                            } else {
                                                $update_login = "UPDATE upti_users SET users_img = '$new_name', users_username = '$username', users_password = '$npassword' WHERE users_code = '$Ucode'";
                                                $update_login_qry = mysqli_query($connect, $update_login);
    
                                                echo "<script>window.location.href='information.php';</script>";
                                            }
                                        }
                                    }
                                    

                            }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <label for="">Image Preview</label>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <img src="images/profile/default.png" alt="" class="img-fluid border border-dark" id="upload-img">
                                            </div>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <label for="">Profile Picture</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fileupload" name="file" id="fileupload">
                                            <label class="custom-file-label" for="b_input" style="border-radius: 0 !important">Click Here to Upload Receipt</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control rounded-0" autocomplete="off" name="user">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control rounded-0" autocomplete="off" name="npass">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>NOTE:</b> <i class="text-danger">Retype Current Password</i></label>
                                        <input type="password" class="form-control rounded-0" autocomplete="off" required name="pass">
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <button class="btn btn-success rounded-0 float-right" name="update_login">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login Information End -->
            </div>
            <!-- Second Column End -->
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<script src="js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
</script>
<?php include 'include/footer.php'; ?>