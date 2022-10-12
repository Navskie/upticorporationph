<?php include 'include/header.php'; ?>
<?php 
    $csid = $_SESSION['code'];
    $role = $_SESSION['role'];

    $notification_stmt = mysqli_query($connect, "SELECT COUNT(trans_ref) AS notif FROM upti_remarks INNER JOIN web_transaction ON upti_remarks.remark_poid = web_transaction.trans_ref WHERE trans_id = '$profile' AND remark_reseller = 'Unread'");
    $notification = mysqli_fetch_array($notification_stmt);

    $notif = $notification['notif'];
?>
<!--Body Content-->
<div id="page-content">     

    <!--Breadcrumb-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.php" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Profile</span>
        </div>
    </div>
    <!--End Breadcrumb-->

    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="form-group text-left">
                    <a href="profile.php">
                    <i class="uil uil-user-square"></i> Profile Information
                    </a>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="notification.php">
                    <i class="uil uil-bell"></i> Notification <span class="badge badge-danger rounded-circle float-right mr-3"><?php echo $notif ?></span>
                    </a>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="checkout-list.php">
                    <i class="uil uil-luggage-cart"></i> Checkout List
                    </a>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="logout.php">
                    <i class="uil uil-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            <div class="col-9">
                <?php if ($role == 'Customer') { ?>
                <div class="row">
                    <div class="col-12">
                        <h3>Personal Information</h3>
                    </div>
                    <?php
                        $customer_stmt = mysqli_query($connect, "SELECT * FROM upti_customer WHERE cs_uid = '$profile'");
                        $customer = mysqli_fetch_array($customer_stmt);
                    ?>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <span class="float-left">Name: &nbsp;&nbsp;</span>
                        <span class="float-center"><b><?php echo $customer['cs_fname'] ?> <?php echo $customer['cs_lname'] ?></b></span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <span class="float-left">Email: &nbsp;&nbsp;</span>
                        <span class="float-center"><b><?php echo $customer['cs_email'] ?></b></span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <span class="float-left">Mobile: &nbsp;&nbsp;</span>
                        <span class="float-center"><b><?php echo $customer['cs_mobile'] ?></b></span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <span class="float-left">Birthday: &nbsp;&nbsp;</span>
                        <span class="float-center"><b><?php echo $customer['cs_bday'] ?></b></span>
                    </div>
                    <div class="col-12">
                        <br>
                    </div>
                    <div class="col-12">
                        <button class="btn float-right" data-bs-toggle="modal" data-bs-target="#info<?php echo $customer['id'] ?>">UPDATE INFORMATION</button>
                    </div>
                    <?php include 'backend/profile-modal.php' ?>
                </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn text-light float-right" href="system/uptimain.php">Dashboard</a>
                        </div>
                </div>
                <?php } ?>
                <hr>
                <div class="cart style2">
                    <table>
                        <thead class="cart__row cart__header">
                            <tr>
                                <th class="text-center">#</th>
                                <th colspan="5" class="text-center">Address</th>
                                <th class="action text-center text-danger"><i class="uil uil-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $address_stmt = mysqli_query($connect, "SELECT * FROM web_address WHERE add_uid = '$profile'");
                                $number = 1;
                                while ($address = mysqli_fetch_array($address_stmt)) {
                            ?>
                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__meta small-- text-center cart-flex-item">
                                    <?php echo $number ?>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $address['add_house'] ?></span>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $address['add_barangay'] ?></span>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $address['add_city'] ?></span>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $address['add_state'] ?></span>
                                </td>
                                <td class="text-center small--hide cart-price">
                                    <div><span class="money"><?php echo $address['add_province'] ?></span></div>
                                </td>
                                <td class="text-center small--hide">
                                    <button class="btn btn--secondary cart__remove" title="Update Address" data-bs-toggle="modal" data-bs-target="#address<?php echo $address['id'] ?>"><i class="uil uil-edit"></i></button>
                                </td>
                            </tr>
                            <?php include 'backend/update-address-modal.php'; ?>
                            <?php $number++; } ?>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->
    
<?php include 'include/footer.php'; ?>
<script>
    <?php if (isset($_SESSION['success'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
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