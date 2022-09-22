<?php

    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['addship'])) {
        $ship = $_POST['ship'];

        $get_poid = "SELECT * FROM upti_transaction WHERE id = '$id'";
        $get_poid_qry = mysqli_query($connect, $get_poid);
        $get_poid_fetch = mysqli_fetch_array($get_poid_qry);

        $subtotal = $get_poid_fetch['trans_subtotal'];

        $new_subtotal = $subtotal + $ship;

        $trans_update = "UPDATE upti_transaction SET trans_subtotal = '$new_subtotal', trans_ship = '$ship' WHERE id = '$id'";
        $trans_update_qry = mysqli_query($connect, $trans_update);

        // echo "<script>window.location.href='./poid-list.php?id='.$id.';</script>";
        ?>
    <script>window.location.href = '../poid-list.php?id=<?php echo $id ?>';</script>
<?php
    }
?>
