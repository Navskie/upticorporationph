<?php
    include '../dbms/conn.php';

    session_start();

    $mycode = $_SESSION['code'];
    $order_sql = "SELECT * FROM upti_transaction WHERE trans_seller = '$mycode' ORDER BY trans_poid DESC";
    $order_qry = mysqli_query($connect, $order_sql);
    $number =1;
    while ($order = mysqli_fetch_array($order_qry)) {
        $total = $order['trans_subtotal'];
        $status = $order['trans_status'];
?>
<tr>
    <td><?php echo $number; ?></td>
    <td class="text-center"><a class="btn-sm btn btn-secondary" href="./poid-list.php?id=<?php echo $order['id']; ?>"><?php echo $order['trans_poid']; ?></a></td>
    <td><?php echo $order['trans_country']; ?></td>
    <td><?php echo $order['trans_fname']; ?> <?php echo $order['trans_cname']; ?> <?php echo $order['trans_lname']; ?></td>
    <td><?php echo $order['trans_stamp']; ?></td>
    <td><?php echo $order['trans_mop']; ?></td>
    <td class="text-right"><?php echo number_format($total, '2', '.', ',') ?></td>
    <td class="text-center">
        <?php
            if ($status == 'Pending') {
        ?>
        <span class="badge badge-primary"><?php echo $status ?></span>
        <?php
            } elseif ($status == 'On-Transit') {
        ?>
        <span class="badge badge-info"><?php echo $status ?></span>
        <?php
            } elseif ($status == 'Canceled') {
        ?>
        <span class="badge badge-danger"><?php echo $status ?></span>
        <?php
            } elseif ($status == 'Delivered') {
        ?>
        <span class="badge badge-success"><?php echo $status ?></span>
        <?php
            } elseif ($status == 'Returned') {
        ?>
        <span class="badge badge-warning"><?php echo $status ?></span>
        <?php
            }
        ?>
    </td>
    <td class="text-center">
        <?php
            if ($status == 'Pending') {
        ?>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel<?php echo $order['id']; ?>">Cancel</button>
        <?php
            } else {
        ?>
        <span class="badge badge-warning">is not available</span>
        <?php
            }
        ?>
    </td>
</tr>
<?php
    include '../backend/order-cancel-modal.php';
    $number++;
    }
?>