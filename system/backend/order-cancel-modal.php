<?php
    // session_start();
    $code = $_SESSION['code'];
    $role = $_SESSION['role'];
    // $id = $order['id'];
    $stockist = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$code'");
    if (mysqli_num_rows($stockist) > 0 || $role == 'BRANCH') {
        $orderid = $id;
?>
    <div class="modal fade" id="cancel<?php echo $orderid; ?>">
<?php } else {  ?>
    <div class="modal fade" id="cancel<?php echo $order['id']; ?>">
<?php } ?>
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Cancel Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <label for="">Are you sure you want to cancel this order</label>
        <?php if (mysqli_num_rows($stockist) > 0 || $role == 'BRANCH') { ?>
        <form action="backend/order-cancel-process.php?id=<?php echo $orderid; ?>" method="post">
        <?php } else { ?>
        <form action="backend/order-cancel-process.php?id=<?php echo $order['id']; ?>" method="post">
        <?php } ?>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-danger float-right" name="category">Cancel Order</button>
        </form>
        </div>
        
    </div>
    </div>
</div>