<?php
    include '../dbms/conn.php';
    $id = $_GET['id'];

    $transact_sql = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $transact_qry = mysqli_query($connect, $transact_sql);
    $transact = mysqli_fetch_array($transact_qry);

    $mypoid = $transact['trans_poid'];

    $comment_sql = "SELECT * FROM upti_remarks WHERE remark_poid = '$mypoid'";
    $comment_qry = mysqli_query($connect, $comment_sql);
    $comment_num = mysqli_num_rows($comment_qry);
    if ($comment_num > 0) {
    while ($comment = mysqli_fetch_array($comment_qry)) {
?>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <b><?php echo $comment['remark_name'] ?></b> <br>
        <i><?php echo $comment['remark_stamp'] ?></i>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <?php echo $comment['remark_content'] ?>
    </div>
    <div class="col-12">
        <hr>
    </div>
<?php } ?>
<?php } else { ?>
    <div class="col-12">
        <i>No Comment</i>
    </div>
<?php } ?>