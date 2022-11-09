<?php include 'include/header.php'; ?>
<?php 
    $csid = $_SESSION['code'];

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
                <div class="cart style2">
                    <table>
                        <thead class="cart__row cart__header">
                            <tr>
                                <th class="text-center">Order Information</th>
                                <th class="text-center">Tracking #</th>
                                <th class="text-center">Date Order</th>
                                <th class="text-center">Order Status</th>
                                <th class="text-center">Subtotal</th>
                                <th class="action text-center text-danger"><i class="uil uil-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cart_stmt = mysqli_query($connect, "SELECT * FROM web_transaction WHERE trans_id = '$profile'");
                                while ($transaction = mysqli_fetch_array($cart_stmt)) {
                                    $status = $transaction['trans_status']; 
                            ?>
                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__meta small-- text-center cart-flex-item">
                                    <div class="list-view-item__title" style="font-size: 13px !important;">
                                        <a href="ref-details.php?ref=<?php echo $transaction['trans_ref'] ?>" target="_blank">Ref# <?php echo $transaction['trans_ref'] ?></a>
                                    </div>
                                    
                                    <div class="cart__meta-text">
                                        <?php echo $transaction['trans_address'] ?><br>
                                    </div>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $transaction['trans_tracking'] ?></span>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $transaction['trans_date'] ?></span>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item text-center">
                                    <?php if ($status == 'Pending') { ?>
                                        <span class="badge badge-dark"><i class="uil uil-envelope-download"></i> - Pending</span>
                                    <?php } elseif ($status == 'On Process') { ?>
                                        <span class="badge badge-primary"><i class="uil uil-sync"></i> - On Process</span>
                                    <?php } elseif ($status == 'In Transit') { ?>
                                        <span class="badge badge-info"><i class="uil uil-truck"></i> - In Transit</span>
                                    <?php } elseif ($status == 'Delivered') { ?>
                                        <span class="badge badge-success"><i class="uil uil-check-circle"></i> - Delivered</span>
                                    <?php } elseif ($status == 'RTS') { ?>
                                        <span class="badge badge-danger"><i class="uil uil-corner-up-left-alt"></i> - RTS</span>
                                    <?php } elseif ($status == 'Canceled') { ?>
                                        <span class="badge badge-danger"><i class="uil uil-times-circle"></i> - Canceled</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center small--hide cart-price">
                                    <?php
                                    $order_country = $transaction['trans_country'];

                                    $c_code2 = mysqli_query($connect, "SELECT * FROM upti_country_currency WHERE cc_country = '$order_country'");
                                    $cc_fetch2 = mysqli_fetch_array($c_code2);
                                    
                                    $country_code2 = $cc_fetch2['cc_sign'];
                                  ?>
                                    <div><span class="money"><?php echo $country_code2 ?> <?php echo $transaction['trans_subtotal'] ?></span></div>
                                </td>
                                <td class="text-center small--hide">
                                    <?php if ($status == 'Pending') { ?>
                                        <button class="btn btn--secondary cart__remove bg-danger text-light" title="Cancel Order" name="delete_item" data-bs-toggle="modal" data-bs-target="#cancel<?php echo $transaction['trans_ref'] ?>"><i class="uil uil-trash-alt"></i></button>
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