<?php include 'include/header.php'; ?>
<?php 
    $csid = $_SESSION['code'];

    $notification_stmt = mysqli_query($connect, "SELECT COUNT(trans_ref) AS notif FROM upti_remarks INNER JOIN web_transaction ON upti_remarks.remark_poid = web_transaction.trans_ref WHERE trans_id = '$csid' AND remark_reseller = 'Unread'");
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
                <div class="cart style2">
                    <table>
                        <thead class="cart__row cart__header">
                            <tr>
                                <th class="text-center">Order Information</th>
                                <th class="text-center">Remarks</th>
                                <th class="action text-center text-danger"><i class="uil uil-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cart_stmt = mysqli_query($connect, "SELECT upti_remarks.id, upti_remarks.remark_poid, upti_remarks.remark_stamp, upti_remarks.remark_content, upti_remarks.remark_csr FROM upti_remarks INNER JOIN web_transaction ON upti_remarks.remark_poid = web_transaction.trans_ref WHERE trans_id = '$profile' AND remark_reseller = 'Unread'");
                                while ($transaction = mysqli_fetch_array($cart_stmt)) {
                            ?>
                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__meta small-- text-center cart-flex-item">
                                    <div class="list-view-item__title" style="font-size: 13px !important;">
                                        Ref# <?php echo $transaction['remark_poid'] ?>
                                    </div>
                                    
                                    <div class="cart__meta-text">
                                        <?php echo $transaction['remark_stamp'] ?><br>
                                    </div>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $transaction['remark_content'] ?></span>
                                </td>
                                <td class="text-center small--hide">
                                    <?php if ($transaction['remark_csr'] == '') { ?>
                                        <form action="backend/read.php?id=<?php echo $transaction['id'] ?>" method="post">
                                            <button class="btn btn--secondary cart__remove bg-info text-light" title="Read Notification" name="read" data-bs-toggle="modal" data-bs-target="#cancel<?php echo $transaction['id'] ?>"><i class="uil uil-comment-search"></i></button>
                                        </form>
                                    <?php } else { ?>
                                        <button class="btn btn--secondary cart__remove" title="No Action"><i class="uil uil-n-a"></i></button>
                                    <?php } ?>
                                </form>
                                </td>
                            </tr>
                            <?php include 'backend/cancel-cs-modal.php'; ?>
                            <?php } ?>
                        </tbody>
                    </table>                    
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